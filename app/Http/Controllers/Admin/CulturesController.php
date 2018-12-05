<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\NewsRequest;
use App\Models\Event;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;
use Yajra\DataTables\Facades\DataTables;

class CulturesController extends Controller
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
    public function index($type = null)
    {
    	// $user = Auth::user();
	    // $isAdmin = $user->hasRole([Role::ROLE_SUPER_ADMIN, Role::ROLE_PROVIDERS]);
	    $view =  !empty($type) ? 'cultures' : 'events';
	    $filterValues = $this->filterValues;
	    
	
	    return view('admin.cultures.index', compact('filterValues'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
	    $types = self::getTypes();
        $view =  !empty($type) ? 'cultures' : 'events';
	    
        return view("admin.cultures.create", compact('types'));
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
			$culture = Event::create($request->all());
			
			//Save image
			if(!empty($request->image))
				$this->saveFile($request->image, "public/cultures/{$culture->id}", 'image');
			
			$response->success = true;
			$response->type = 'success';
			$response->time = 3000;
			$response->message = 'Noticia cadastrada com sucesso';
			$response->callback = 'redirect';
			$response->url = route('cultures.index');
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
		$culture = Event::findOrFail($id);
		
		$types = self::getTypes();
		$page = $showOnly ? 'show' : 'edit';
		
		return view("admin.cultures.{$page}", compact(['types', 'cultures']));
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
			$culture = Event::findOrFail($id);
			$culture->update($request->all());

			//Save image
			if(!empty($request->image))
				$this->saveFile($request->image, "public/post/{$culture->id}", 'image', false, true);
		
			$response->success = true;
			$response->type = 'success';
			$response->message = 'Noticia atualizada com sucesso!';
			$response->title = 'Sucesso:';
			$response->callback = 'redirect';
			$response->url = route('cultures.index');
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
			$culture = Event::findOrFail($id);
			$culture->delete();
			
			// Prepare to response
			$response->success = true;
			$response->type = 'success';
			$response->message = 'Noticia deletada com sucesso';
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
			$cultures = Event::all();
			
			// $users = FilterTrait::applyFilter($request, $users);
			
			// Return to dataTables value.
			return DataTables::of($cultures)
				->editColumn('image', function(Event $culture)
				{
					return "<img class='rounded-circle img-fluid width-48 heigth-48 mx-auto d-flex' src='{$culture->image->url_sm}' alt='Image'>";
				})
				->editColumn('type', function(Event $culture)
				{
					return $culture->getType($culture->type)->text;
				})
				->addColumn('action', function(Event $culture)
				{
					$data = $culture;
					$havePermission = $this->confirmPermission(
						(object)[
							'add' => 'cadastrar-culturas',
							'edit' => 'editar-culturas',
							'delete' => 'deletar-culturas'
						]
					);
					
					$actions = [
						'show' => route('cultures.show', $culture->id),
						'edit' => route('cultures.edit', $culture->id),
						'delete' => route('cultures.destroy', $culture->id),
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
			2 => 'Convocação',
			3 => 'Noticia',
			4 => 'Edital',
		];
	}

}
