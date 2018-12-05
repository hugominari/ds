<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\NewsRequest;
use App\Http\Requests\SocialRequest;
use App\Http\Requests\UserRequest;
use App\Models\Post;
use App\Models\Role;
use App\Models\Social;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;
use Yajra\DataTables\Facades\DataTables;

class PostsController extends Controller
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
	
	    return view('admin.posts.index', compact('filterValues'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
	    $types = self::getTypes();
	    
        return view("admin.posts.create", compact('types'));
    }

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function store(NewsRequest $request)
	{
		$response = $this->createResult();
		
		try
		{
			$post = Post::create($request->all());
			
			//Save image
			if(!empty($request->image))
				$this->saveFile($request->image, "public/posts/{$post->id}", 'image');
			
			$response->success = true;
			$response->type = 'success';
			$response->time = 3000;
			$response->message = 'Publicação cadastrada com sucesso';
			$response->callback = 'redirect';
			$response->url = route('posts.index');
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
		$post = Post::findOrFail($id);
		$types = self::getTypes();
		$page = $showOnly ? 'show' : 'edit';
		
		return view("admin.posts.{$page}", compact(['types', 'post']));
	}
	
	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  int                      $id
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function update(NewsRequest $request, $id)
	{
		$response = $this->createResult();
		
		try
		{
			$post = Post::findOrFail($id);
			$post->update($request->all());

			//Save image
			if(!empty($request->image))
				$this->saveFile($request->image, "public/posts/{$post->id}", 'image', false, true);
		
			$response->success = true;
			$response->type = 'success';
			$response->message = 'Publicação atualizada com sucesso!';
			$response->title = 'Sucesso:';
			$response->callback = 'redirect';
			$response->url = route('posts.index');
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
			$post = Post::findOrFail($id);
			$post->delete();
			
			// Prepare to response
			$response->success = true;
			$response->type = 'success';
			$response->message = 'Publicação deletada com sucesso';
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
			$posts = Post::all();
			
			// $users = FilterTrait::applyFilter($request, $users);
			
			// Return to dataTables value.
			return DataTables::of($posts)
				->editColumn('image', function(Post $post)
				{
					return "<img class='rounded-circle img-fluid width-48 heigth-48 mx-auto d-flex' src='{$post->image->url_sm}' alt='Image'>";
				})
				->editColumn('type', function(Post $post)
				{
					return $post->getType($post->type)->text;
				})
				->addColumn('action', function(Post $post)
				{
					$data = $post;
					$havePermission = $this->confirmPermission(
						(object)[
							'add' => 'cadastrar-posts',
							'edit' => 'editar-posts',
							'delete' => 'deletar-posts'
						]
					);
					
					$actions = [
						'show' => route('posts.show', $post->id),
						'edit' => route('posts.edit', $post->id),
						'delete' => route('posts.destroy', $post->id),
					];
					
					return view('layouts.datatables.actions', compact(['data', 'actions', 'havePermission']))->render();
				})
				->rawColumns(['image', 'action'])
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
	
	
	public function getTypes()
	{
		return [
			'' => 'Selecione',
			1 => 'Boletim',
			5 => 'Comunicado',
			2 => 'Convocação',
			4 => 'Edital',
			3 => 'Noticia',
		];
	}

}
