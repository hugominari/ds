<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CovenantRequest;
use App\Models\Covenant;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;
use Yajra\DataTables\Facades\DataTables;

class CovenantsController extends Controller
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
	
	    return view('admin.covenants.index', compact('filterValues'));
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
	    
        return view("admin.covenants.create");
    }

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function store(CovenantRequest $request)
	{
		$response = $this->createResult();
		
		try
		{
			$covenant = Covenant::create($request->all());
            
            //Save image profile
            $this->saveFile($request->image, "public/covenants/{$covenant->id}", 'image');
			
			$response->success = true;
			$response->type = 'success';
			$response->time = 3000;
			$response->message = 'Convênio cadastrado com sucesso';
			$response->callback = 'redirect';
			$response->url = route('covenants.index');
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
		$covenant = Covenant::findOrFail($id);
		$page = $showOnly ? 'show' : 'edit';

		return view("admin.covenants.{$page}", compact(['covenant']));
	}
	
	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  int                      $id
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function update(CovenantRequest $request, $id)
	{
		$response = $this->createResult();
		
		try
		{
			$covenant = Covenant::findOrFail($id);
			$covenant->update($request->all());
            
            //Save image profile
            $this->saveFile($request->image, "public/covenants/{$covenant->id}", 'image', false, true);
		
			$response->success = true;
			$response->type = 'success';
			$response->message = 'Convênio atualizado com sucesso!';
			$response->title = 'Sucesso:';
			$response->callback = 'redirect';
			$response->url = route('covenants.index');
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
			$covenant = Covenant::findOrFail($id);
			
			$covenant->delete();
			
			// Prepare to response
			$response->success = true;
			$response->type = 'success';
			$response->message = 'Convênio deletado com sucesso';
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
			$covenants = Covenant::all();
			
			// $users = FilterTrait::applyFilter($request, $users);
			
			// Return to dataTables value.
			return DataTables::of($covenants)
				->editColumn('image', function($data){
                    return "<img class='rounded-circle img-fluid width-48 heigth-48 mx-auto d-flex' src='{$data->image->url_sm}' alt='Image'>";
				})
                ->editColumn('name', function($data){
                    return mb_strtoupper($data->name);
                })
				->addColumn('action', function(Covenant $covenant)
				{
					$data = $covenant;
					$havePermission = $this->confirmPermission(
						(object)[
							'add' => 'cadastrar-convenio',
							'edit' => 'editar-convenio',
							'delete' => 'deletar-convenio'
						]
					);
					
					$actions = [
						'show' => route('covenants.show', $covenant->id),
						'edit' => route('covenants.edit', $covenant->id),
						'delete' => route('covenants.destroy', $covenant->id),
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
}
