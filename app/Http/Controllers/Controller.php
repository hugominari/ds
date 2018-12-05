<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
	
	/**
	 * Define contants
	 */
	const DATABASE_ERROR = 'Ocorreu um erro no banco de dados. Tente novamente mais tarde!';
	const GENERAL_ERROR = 'Ocorreu um erro inesperado. Tente novamente mais tarde!';
	
	/**
	 * Controller constructor.
	 */
	public function __construct()
	{
	
	}
	
	/**
	 * Creates an object used to return a response in JSON format. The object
	 * contains the following properties: success, message, type e result.
	 * @return object
	 */
	protected function createResult()
	{
		return (object)array(
			'success' => false,
			'message' => null,
			'type' => '',
			'result' => null
		);
	}
    
    /**
     * Checks whether the variable exists and has a set value.
     * @param stdClass $object Object to verify value.
     * @param type $index Name the value inside the object to retrieve.
     * @return stdClass Return an object with properties: value, have.
     */
    protected function isDefined($object = null, $index = null)
    {
        $value = (isset($object->$index) && !empty($object->$index)) ? $object->$index : null;
        $have = !empty($value);
        
        if(is_array($value))
            $value = array_filter($value);
        
        $result = new \stdClass();
        $result->value = (is_array($value) || is_object($value)) ? (object)$value : $value;
        $result->have = $have;
        
        return $result;
    }
	
	/**
	 * Verify users permissions for edit or delete any record of controllers.
	 * @param stdClass $permissions Permissions needed for active edit/delete buttons
	 * @param stdClass $user (optional) If null, get the logged user.
	 * @return stdClass With edit/delete boolean.
	 */
	protected function confirmPermission($permissions = null, $user = null)
	{
		$loggedUser = !empty($user) ? $user : Auth::user();
		$loggedUser = !empty($loggedUser) ? User::find($loggedUser->id) : '';
		$result = (object)[
			'add' => false,
			'edit' => false,
			'delete' => false,
			'show'  => false,
			'both' => false
		];
		
		if(!empty($loggedUser))
		{
			//Confirm powers
			if(!empty($permissions))
			{
				if(empty($permissions->both))
				{
					//If user can add
					if(!empty($permissions->add))
						$result->add = $loggedUser->havePermission($permissions->add);
					
					//If user can edit
					if(!empty($permissions->edit))
						$result->edit = $loggedUser->havePermission($permissions->edit);
					
					//If user can delete
					if(!empty($permissions->delete))
						$result->delete = $loggedUser->havePermission($permissions->delete);
					
					//If user can show
					if(!empty($permissions->show))
						$result->show = $loggedUser->havePermission($permissions->show);
					
					//If user can both
					if(!empty($permissions->both))
						$result->both = $loggedUser->havePermission($permissions->both);
				}
				else
				{
                    if($loggedUser->havePermission($permissions->both))
                    {
                        $result->add = true;
                        $result->edit = true;
                        $result->delete = true;
                        $result->both = true;
                    }
				}
			}
		}
		
		return $result;
	}
	
	/**
	 * Save a file to temp folder.
	 *
	 * @param Request $request
	 * @return \Illuminate\Http\JsonResponse
	 * @author Hugo Minari Diniz
	 */
	public function uploadFile(Request $request)
	{
		$response = $this->createResult();
		
		try
		{
			if($request->hasFile('file'))
			{
				//Define variables
				$file = $request->file('file');
				$archive = $file->store('public/temp');
				
				//Get image info
				$filename = explode('/', $archive);
				$filename = end($filename);
				$json = $this->getFile('public/temp', $filename);
				
				//Response
				$response->success = true;
				$response->filename = $archive;
				$response->mime = $json->mime;
				$response->size = $json->size;
				$response->url = $json->url;
			}
			else
			{
				$response->title = 'Erro:';
				$response->message = 'Arquivo inválido';
				$response->type = 'error';
			}
		}
		catch(\Exception $error)
		{
			$response->title = 'Erro:';
			$response->message = Controller::GENERAL_ERROR;
			$response->type = 'error';
			// Log::error($error);
		}
		
		return Response::json($response);
	}
	
	/**
	 * Get file from folder
	 *
	 * @param null $folder
	 * @param null $filename
	 * @param bool $removeBase64
	 * @param bool $strict
	 * @return array|object
	 * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
	 */
	public function getFile($folder = null, $filename = null, $removeBase64 = false, $strict = false)
	{
		$result = [];
		
		if(!empty($folder) && !empty($filename))
		{
            $ext = strrchr( $filename, '.' );
            $alloweds = ['jpg', 'jpeg', 'gif', 'png', 'bmp', '.jpg', '.jpeg', '.gif', '.png', '.bmp', '.pdf', 'pdf'];
            $haveExtension = str_contains($ext, $alloweds);
            
            if(!$haveExtension)
            {
                if(!str_contains($filename, '.jpg'))
                    $filename .= '.jpg';
            }
            
            //Path required
            $path = "{$folder}/{$filename}";
            
            //If not exists, define default
            if(!Storage::exists($path) && !$strict)
            {
                $filenameWithoutExt = preg_replace('/\\.[^.\\s]{3,4}$/', '', $filename);
                $files = (array)self::findFile($folder, $filenameWithoutExt, false, '/^((?!thumb).)*$/');

                //Find any file in folder
                if(!empty($files[0]) && !empty($files[0]->filename))
                {
                    $firstFile = $files{0}->filename;
                    $path = "{$folder}/{$firstFile}";
                }
                else
                {
                    $zeroPath = strtok($folder, '/') . '/' . strtok('/');
                    $path = "{$zeroPath}/0/$filename";
                }
            }
            
			//If exist the default file
			if(Storage::exists($path))
			{
				//Get informations
				$mime = Storage::mimeType($path);
				$lastModified = Storage::lastModified($path);
				$date = "?{$lastModified}";
				
				//Set the result
				$result = [
					'filename' => $filename,
					'size' => Storage::size($path),
					'date' => $lastModified,
					'mime' => $mime,
					'url' => url('/') . Storage::url($path) . $date,
					'path' => $path
				];
				
				//If file is image
				if(str_contains($mime, 'image/'))
				{
                    $extension_pos = strrpos($path, '.');
                    // $extension_pos = pathinfo(storage_path() . $path, PATHINFO_EXTENSION);
					//Verify thumbs
					$thumbSm = substr($path, 0, $extension_pos) . '-thumb-sm' . substr($path, $extension_pos);
					$thumbLg = substr($path, 0, $extension_pos) . '-thumb-lg' . substr($path, $extension_pos);
					
					$result += [
						'url_sm' => url('/') . Storage::url($thumbSm) . $date,
						'url_lg' => url('/') . Storage::url($thumbLg) . $date
					];
					
					if(!$removeBase64)
					{
						$result += ['base64' => "data:{$mime};base64," . base64_encode(Storage::get($path))];
						
						if(Storage::exists($thumbSm))
						{
							$result += [
								'base64_lg' => "data:{$mime};base64," . base64_encode(Storage::get($thumbLg)),
								'base64_sm' => "data:{$mime};base64," . base64_encode(Storage::get($thumbSm))
							];
						}
					}
				}
				
				$result = (object)$result;
			}
		}
		
		return $result;
	}
	
	/**
	 * Find files from specific folder
	 *
	 * @param null $folder
	 * @param null $filename
	 * @return array
	 */
	public function findFile($folder = null, $filename = null, $count = false, $regex = null)
	{
		$result = [];
		$folder = storage_path("app/{$folder}");
		
		if(!empty($folder) && !empty($filename))
		{
			$path = "{$folder}/{$filename}";
			$matchingFile = File::glob($path);
			$qtd = 0;
			
			// if(!empty($matchingFile))
			if(is_array($matchingFile) || is_object($matchingFile))
			{
				foreach($matchingFile as $item)
				{
					if(empty($regex) || preg_match($regex, $item))
					{
						$path  = explode('app/', $item);
						$path  = end($path);
						$zeroPath = substr($path, 0, strrpos( $path, '/'));
						$file = explode('/' , $path);
						++$qtd;
						
						$result[] = (object)[
							'path' => $zeroPath,
							'filename' => end($file),
						];
					}
				}
				
				$result = (object)$result;
				
				if($count)
					$result = $qtd;
			}
		}
		
		return $result;
	}
	
	/**
	 * Delete file from temp folder.
	 *
	 * @param Request $request
	 * @return \Illuminate\Http\JsonResponse
	 * @author Hugo Minari Diniz
	 */
	public function deleteFile(Request $request)
	{
		$response = $this->createResult();
		
		try
		{
			if(Storage::exists($request->path))
			{
				$mime = Storage::mimeType($request->path);
				
				//Delete file
				if(!str_contains($request->path, '/0/'))
					Storage::disk('local')->delete($request->path);
				
				//If file is an image
				if(str_contains($mime, 'image/') && !str_contains($request->path, 'temp/'))
				{
					//Remove thumbs too
					$extension_pos = strrpos($request->path, '.');
					$thumbSm = substr($request->path, 0, $extension_pos) . '-thumb-sm' . substr($request->path, $extension_pos);
					$thumbLg = substr($request->path, 0, $extension_pos) . '-thumb-lg' . substr($request->path, $extension_pos);
					
					if(isset($request->extra))
					{
						$extra = substr($request->path, 0, $extension_pos) . $request->extra . substr($request->path, $extension_pos);
						Storage::disk('local')->delete($extra);
					}
					
					// Storage disk
					Storage::disk('local')->delete($thumbSm);
					Storage::disk('local')->delete($thumbLg);
				}
			}
			
			$response->success = true;
		}
		catch(\Exception $error)
		{
			Log::error($error);
		}
		
		return Response::json($response);
	}
	
	/**
	 * If the option $isBase64 is true, then the file will be stored in temp folder first.
	 * Save file into final path, this method move a temp file for target folder.
	 *
	 * @param null $originalPath
	 * @param null $targetPath
	 * @param null $newName
	 * @param bool $isBase64
	 * @param bool $replace
	 * @return bool
	 */
	public function saveFile($originalPath = null, $targetPath = null, $newName = null, $isBase64 = false, $replace = true)
	{
		$isDefined = (!$isBase64) ? Storage::exists($originalPath) : (!empty($originalPath));
		$rand = substr(uniqid('', true), -5);
		
		// If image or base64 exists
		if($isDefined)
		{
			// When base64 save into temp folder
			if($isBase64)
			{
				//Set paths
				$uniqueId = uniqid();
				$tempPath = "temp/{$uniqueId}.jpg";
				$tempStoragePath = storage_path("app/{$tempPath}");
				
				//Save image
				Image::make($originalPath)->save("{$tempStoragePath}");
				
				//Set new path
				$originalPath = $tempPath;
			}
			
			// Get informations of image from temp folder
			$mime = Storage::mimeType($originalPath);
            $ext = pathinfo(storage_path() . $originalPath, PATHINFO_EXTENSION);
			$targetFullPath = "{$targetPath}/{$newName}.{$ext}";

			// If file is an image
			if(str_contains($mime, 'image/'))
			{
                // If file exists remove or change new name
                if(Storage::exists($targetFullPath))
                {
                    if($replace)
                    {
                        $newName = "{$newName}_original";
                        Storage::delete($targetFullPath);
                    }
                    else
                    {
                        $newName = "{$newName}-{$rand}_original";
                        $targetFullPath = "{$targetPath}/{$newName}.jpg";
                    }
                }
                
                // Define the paths
				$fullPath = Storage::path($targetFullPath);
				$newName = str_replace('_original', '', $newName);
				
				$newImagePath = Storage::path("{$targetPath}/{$newName}.jpg");
				$newImageThumbSPath = Storage::path("{$targetPath}/{$newName}-thumb-sm.jpg");
				$newImageThumbMPath = Storage::path("{$targetPath}/{$newName}-thumb-lg.jpg");
				
                // Move the file from temp to final folder
                Storage::move($originalPath, $targetFullPath);
                $hasBeenSaved = true;
                
				// Convert image
				Image::make($fullPath)->encode('jpg')->save($newImagePath);
				
				//Create thumb in public folders only
				if(str_contains($targetPath, 'public/'))
				{
					//Create thumb small
					Image::make($fullPath)
						->resize(200, null, function($constraint){
							$constraint->aspectRatio();
							$constraint->upsize();
						})
						->save($newImageThumbSPath);
					
					//Create thumb large
					Image::make($fullPath)
						->resize(540, null, function($constraint){
							$constraint->aspectRatio();
							$constraint->upsize();
						})
						->save($newImageThumbMPath);
					
					// prevent possible upsizing
					Image::make($fullPath)
						->resize(1080, null, function($constraint){
							$constraint->aspectRatio();
							$constraint->upsize();
						})
						->save($newImagePath);
				}
                
                Storage::delete($fullPath);
			}
            
            // Move the file from temp to final folder
            if(!isset($hasBeenSaved))
            {
                Storage::move($originalPath, $targetFullPath);
                Storage::delete($originalPath);
            }

			return true;
		}
		
		return false;
	}
	
	/**
	 * Get file from folder
	 * @param null $folder
	 * @param null $filename
	 * @return array|object
	 * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
	 */
	public function duplicateFile($folder = null, $filename = null, $newName = null, $size = 'original')
	{
		$response = $this->createResult();
		
		if(!empty($folder) && !empty($filename) && !empty($newName))
		{
			$filename .= (!str_contains($filename, '.jpg')) ? '.jpg' : '';
			$original = "{$folder}/{$filename}";
			$copy = "{$folder}/{$newName}";
			
			//If exist the default file
			if(Storage::exists($original))
			{
				if($size !== 'original')
				{
					$originalFile = $this->getFile($folder, $filename);
					$storagePath = storage_path("app/{$folder}/{$newName}");
					$width = is_array($size) ? $size['x'] : 1;
					$height = is_array($size) ? $size['y'] : 1;
					$quality = is_array($size) ? $size['q'] : 96;
					
					if(is_object($originalFile))
					{
						Image::make($originalFile->base64)
							->resize($width, $height)
							->encode('jpg', $quality)
							->save($storagePath);
					}
				}
				else
				{
					Storage::copy($original, $copy);
				}
				
				$response->success = true;
			}
		}
		
		return Response::json($response);
	}
	
	/**
	 * @param null $filename
	 * @return \Illuminate\Http\Response|\Symfony\Component\HttpFoundation\BinaryFileResponse
	 * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
	 */
	public function downloadFile($filename = null)
	{
		$fullpath = str_replace('-', '/', $filename);
		$filename = substr($fullpath, strrpos($fullpath, '/') + 1);
		$path = str_replace("/{$filename}", '', $fullpath);
		$file_path = storage_path() . "/app/" . $fullpath;
		$file = $this->getFile($path, $filename);
		
		if(!empty($file))
		{
			$headers = array(
				'Content-Type' => $file->mime,
				'Content-Disposition' => 'attachment; filename=' . $filename,
			);
			
			return Response::download($file_path, $filename, $headers);
		}
		
		return Response::view('errors.file-not-found', [], 404);
	}
	
}
