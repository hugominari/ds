<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MemberRequest;
use App\Models\Member;
use App\Models\Position;
use App\Models\Role;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;
use Yajra\DataTables\Facades\DataTables;

class MembersController extends Controller
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
		'username' => [
			'type' => 'text',
			'column' => 'username',
			'label' => 'Username',
		],
		'created_at' => [
			'type' => 'date',
			'column' => 'created_at',
			'label' => 'Criado em',
		],
		'status' => [
			'type' => 'select',
			'column' => 'status',
			'label' => 'Status',
			'options' => [
				[
					'value' => 1,
					'label' => 'Ativo',
				],
				[
					'value' => 0,
					'label' => 'Inativo',
				]
			]
		],
		'profile' => [
			'type' => 'select',
			'column' => 'user_id',
			'label' => 'Perfil',
			
			'typeSelect' => 'join',
			'fk_column' => 'role_id',
			'fk_table' => 'role_user',
			'options' => [
				[
					'value' => Role::ROLE_ADMIN,
					'label' => 'Administrador',
				],
				[
					'value' => Role::ROLE_USER,
					'label' => 'Fornecedor',
				]
			]
		]
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
	    $filterValues = $this->filterValues;
	
	    return view('admin.members.index', compact('filterValues'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.members.create");
    }

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function store(MemberRequest $request)
	{
		$response = $this->createResult();
		
		try
		{
			$member = Member::create($request->all());
		
			//Save image profile
			$this->saveFile($request->image, "public/members/{$member->id}", 'image');
			
			$response->success = true;
			$response->type = 'success';
			$response->time = 3000;
			$response->message = 'Membro cadastrado com sucesso';
			$response->callback = 'redirect';
			$response->url = route('members.show', ['id' => $member->id]);
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
		return self::edit($id,true);
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
		$member = Member::findOrFail($id);
		$birthDate = !empty($member->birth_date) ? $member->birth_date->format('d/m/Y') : '';
        $positions = Position::toSelect();
		$page = $showOnly ? 'show' : 'edit';
		
		$data = [
			'member',
			'birthDate',
			'positions',
		];
		
		return view("admin.members.{$page}", compact($data));
	}
	
	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  int                      $id
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function update(MemberRequest $request, $id)
	{
		$response = $this->createResult();
		
		try
		{
			$member = Member::findOrFail($id);
            $member->update($request->all());
			
			//Save image profie
			$this->saveFile($request->image, "public/members/{$member->id}", 'image');
			
			$response->success = true;
			$response->type = 'success';
			$response->message = 'Membro atualizado com sucesso';
			$response->title = 'Sucesso:';
			$response->callback = 'redirect';
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
			$member = Member::findOrFail($id);
			$member->delete();
			
			// Prepare to response
			$response->success = true;
			$response->type = 'success';
			$response->message = 'Membro deletado com sucesso';
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
	public function list(Request $request, $type = null)
	{
		$response = $this->createResult();
		
		try
		{
			$members = Member::query()
				->select('id', 'name', 'email', 'phone', 'birth_date');
			
			// $members = FilterTrait::applyFilter($request, $members);
			
			// Return to dataTables value.
			return DataTables::of($members)
				->editColumn('image', function(Member $member)
				{
					return "<img class='rounded-circle img-fluid width-48 heigth-48 mx-auto d-flex' src='{$member->image->url_sm}' alt='Image'>";
				})
				->editColumn('birth_date', function(Member $member)
				{
				    if(!empty($member->birth_date))
					    return $member->birth_date->format('d/m/Y');
				})
				->addColumn('action', function(Member $member)
				{
					$data = $member;
					$havePermission = $this->confirmPermission(
						(object)[
							'add' => 'cadastrar-membro',
							'edit' => 'editar-membro',
							'delete' => 'deletar-membro'
						]
					);
					
					$actions = [
						'show' => route('members.show', $member->id),
						'edit' => route('members.edit', $member->id),
						'delete' => route('members.destroy', $member->id),
					];
					
					return view('layouts.datatables.actions', compact(['data', 'actions', 'havePermission']))->render();
				})
				->rawColumns(['image', 'action', 'status'])
				->make(true);
		}
		catch(\Error $error)
		{
			$response->message = Controller::DATABASE_ERROR;
			$response->type = 'error';
			Log::error($error);
		}
		catch(\Exception $e)
		{
			$response->message = Controller::DATABASE_ERROR;
			$response->type = 'error';
			Log::error($e);
		}
		
		return Response::json($response);
	}
}
