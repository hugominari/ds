<?php
namespace App\Http\Controllers\DefaultTraits;

use Illuminate\Http\Request;

trait FilesTrait
{
	/**
	 * Save a file to temp folder.
	 *
	 * @param Request $request
	 * @return \Illuminate\Http\JsonResponse
	 * @author Hugo Minari Diniz
	 */
	public function uploadFiles(Request $request)
	{
		return $this->uploadFile($request);
	}
	
	/**
	 * @param null $filename
	 * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
	 * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
	 */
	public function downloadFiles($filename = null)
	{
		return $this->downloadFile($filename);
	}
	
	/**
	 * Delete a file from temp folder.
	 *
	 * @param Request $request
	 * @return \Illuminate\Http\JsonResponse
	 * @author Hugo Minari Diniz
	 */
	public function deleteFiles(Request $request)
	{
		return $this->deleteFile($request);
	}
	
	/**
	 * @param null $originalPath
	 * @param null $targetPath
	 * @param null $newName
	 * @param bool $replace
	 * @return bool
	 */
	public function saveFiles($originalPath = null, $targetPath = null, $newName = null, $replace = true)
	{
		if(!empty($originalPath) && !empty($targetPath) && !empty($newName))
			return $this->saveFile($originalPath, $targetPath, $newName, $replace);
		else
			return false;
	}
	
	/**
	 * @param null $originalPath
	 * @param null $targetPath
	 * @param null $newName
	 * @param bool $replace
	 * @return bool
	 */
	public function duplicateFiles(Request $request)
	{
		$originalPath = isset($request->path) ? $request->path : '';
		$filename = isset($request->filename) ? $request->filename : '';
		$copyName = isset($request->newname) ? $request->newname : '';
		$size = isset($request->size) ? $request->size : null;
		
		if(!empty($originalPath) && !empty($filename) && !empty($copyName))
			return $this->duplicateFile($originalPath, $filename, $copyName, $size);
		else
			return false;
	}
	
}