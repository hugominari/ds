<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SocialRequest;
use App\Http\Requests\UserRequest;
use App\Models\Role;
use App\Models\Social;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;
use Yajra\DataTables\Facades\DataTables;

class SocialsController extends Controller
{
	/**
	 * Array to Filter DataTables Values.
	 * @var array
	 */
	private $filterValues = [
		'name' => [
			'type' => 'text',
			'column' => 'name',
			'label' => 'Nome'
		],
		'url' => [
			'type' => 'text',
			'column' => 'url',
			'label' => 'Site',
		],
	];
	
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     // $this->middleware('auth');
    // }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	// $user = Auth::user();
	    // $isAdmin = $user->hasRole([Role::ROLE_SUPER_ADMIN, Role::ROLE_PROVIDERS]);
	    // $view =  $isAdmin ? 'admin' : 'index';
	    $filterValues = $this->filterValues;
	
	    return view('admin.socials.index', compact('filterValues'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	// $user = Auth::user();
	    // $isAdmin = $user->hasRole([Role::ROLE_SUPER_ADMIN, Role::ROLE_PROVIDERS]);
	    // $view =  $isAdmin ? 'admin' : 'index';]
	    $socials = self::getSocialIcons();
	    
        return view("admin.socials.create", compact('socials'));
    }

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function store(SocialRequest $request)
	{
		$response = $this->createResult();
		
		try
		{
			$social = Social::create($request->all());
			
			$response->success = true;
			$response->type = 'success';
			$response->time = 3000;
			$response->message = 'Rede social cadastrada com sucesso';
			$response->callback = 'redirect';
			$response->url = route('socials.index');
		}
		catch(\Error $error)
		{
			$response->message = Controller::DATABASE_ERROR;
			$response->type = 'error';
			Log::error($error->getMessage() . " | Linha: {$error->getLine()}");
		}
		
		return Response::json($response);
	}
	
	/**
	 * Display the specified resource.
	 *
	 * @param $id
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
	 */
	public function show($id)
	{
		return self::edit($id, true);
	}
	
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param $id
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
	 */
	public function edit($id, $showOnly = false)
	{
		$social = Social::findOrFail($id);
		$socials = self::getSocialIcons();
		$page = $showOnly ? 'show' : 'edit';

		return view("admin.socials.{$page}", compact(['social', 'socials']));
	}
	
	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  int                      $id
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function update(SocialRequest $request, $id)
	{
		$response = $this->createResult();
		
		try
		{
			$social = Social::findOrFail($id);
			$social->update($request->all());
		
			$response->success = true;
			$response->type = 'success';
			$response->message = 'Rede social atualizada com sucesso!';
			$response->title = 'Sucesso:';
			$response->callback = 'redirect';
			$response->url = route('socials.index');
			$response->time = 3000;
		}
		catch(\Error $error)
		{
			$response->message = Controller::DATABASE_ERROR;
			$response->type = 'error';
			Log::error($error->getMessage() . " | Linha: {$error->getLine()}");
		}
		
		return Response::json($response);
	}
	
	/**
	 * @param Request $request
	 * @param         $id
	 * @return \Illuminate\Http\JsonResponse
	 * @throws \Exception
	 */
	public function destroy(Request $request, $id)
	{
		$response = $this->createResult();
		
		try
		{
			$social = Social::findOrFail($id);
			
			$social->delete();
			
			// Prepare to response
			$response->success = true;
			$response->type = 'success';
			$response->message = 'Rede social deletada com sucesso';
			$response->title = 'Sucesso';
		}
		catch(\Error $error)
		{
			$response->message = Controller::DATABASE_ERROR;
			$response->type = 'error';
			Log::error($error->getMessage() . " | Linha: {$error->getLine()}");
		}
		
		return Response::json($response);
	}
	
	
	/**
	 * List All users.
	 */
	public function list(Request $request)
	{
		$response = $this->createResult();
		
		try
		{
			$social = Social::all();
			
			// $users = FilterTrait::applyFilter($request, $users);
			
			// Return to dataTables value.
			return DataTables::of($social)
				->editColumn('icon', function($data){
				    return "<i class=\"fab fa-{$data->icon} font-36\"></i>";
				})
				->addColumn('action', function(Social $social)
				{
					$data = $social;
					$havePermission = $this->confirmPermission(
						(object)[
							'add' => 'cadastrar-socials',
							'edit' => 'editar-socials',
							'delete' => 'deletar-socials'
						]
					);
					
					$actions = [
						'show' => route('socials.show', $social->id),
						'edit' => route('socials.edit', $social->id),
						'delete' => route('socials.destroy', $social->id),
					];
					
					return view('layouts.datatables.actions', compact(['data', 'actions', 'havePermission']))->render();
				})
				->rawColumns(['icon', 'action'])
				->make(true);
		}
		catch(\Error $error)
		{
			$response->message = Controller::DATABASE_ERROR;
			$response->type = 'error';
			Log::error($error->getMessage() . " | Linha: {$error->getLine()}");
		}
		catch(\Exception $e)
		{
			$response->message = Controller::DATABASE_ERROR;
			$response->type = 'error';
			Log::error($e->getMessage() . " | Linha: {$e->getLine()}");
		}
		
		return Response::json($response);
	}
	
	
	
	public function getSocialIcons()
	{
		return [
			'' => 'Selecione',
			'facebook' => 'facebook',
			'flickr' => 'flickr',
			'google-plus' => 'google-plus',
			'instagram' => 'instagram',
			'linkedin' => 'linkedin',
			'pinterest' => 'pinterest',
			'skype' => 'skype',
			'telegram' => 'telegram',
			'tumblr' => 'tumblr',
			'twitter' => 'twitter',
			'vimeo' => 'vimeo',
			'whatsapp' => 'whatsapp',
			'youtube' => 'youtube',
		];
	}
}
