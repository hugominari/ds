<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\PermissionUser;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
use Yajra\DataTables\Facades\DataTables;

class UsersController extends Controller
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
    public function index()
    {
	    $filterValues = $this->filterValues;
	
	    return view('admin.users.index', compact('filterValues'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	$profilesObj = Role::query()
            ->where('name', '<>', 'root')
            ->get();
    
        $profiles = ['' => ''];
        foreach ($profilesObj as $prof) {
            $profiles += [$prof->id => $prof->display_name];
    	}
    	
        return view("admin.users.create", compact(['permissions', 'profiles']));
    }

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function store(UserRequest $request)
	{
		$response = $this->createResult();
		
		try
		{
			$user = \App\User::create($request->all());
			$user->attachRole($request->profile);
			$user->attachPermissions($request->permissions);
			$this->saveFile($request->image, "public/users/{$user->id}", 'profile');
			
			$response->success = true;
			$response->type = 'success';
			$response->time = 3000;
			$response->message = 'O usuario foi cadastrado com sucesso';
			$response->callback = 'redirect';
			$response->url = route('users.index');
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
	 * Load page to my profile.
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function myProfile()
	{
		\JavaScript::put([
			'roleId' => Auth::user()->getRole()->id,
			'userId' => Auth::user()->id,
			'showOnly' => true
		]);
		return view('admin.users.my-profile');
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
		$currentUser = Auth::user();
		
		if(!empty($currentUser) && $id == $currentUser->id)
			return redirect(route('users.my-profile'));
        
        $profilesObj = Role::query()
            ->where('name', '<>', 'root')
            ->get();
        
        $profiles = ['' => ''];
        foreach ($profilesObj as $prof) {
            $profiles += [$prof->id => $prof->display_name];
        }
        
		$user = User::withTrashed()->findOrFail($id);
		$role = $user->getRole();
		$page = $showOnly ? 'show' : 'edit';
		
		$data = [
			'profiles',
			'user',
			'role',
		];
		
		return view("admin.users.{$page}", compact($data));
	}
	
	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  int                      $id
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function update(UserRequest $request, $id)
	{
		$response = $this->createResult();
		
		try
		{
			$user = \App\User::findOrFail($id);
			
			$user->update($request->all());
            $this->saveFile($request->image, "public/users/{$user->id}", 'profile', '', true);
			
			//Update roles and permissions
			if(Auth::user()->id != $id)
			{
                $user->syncRoles([$request->profile]);
                $user->syncPermissions($request->permissions);
			}
			
			$response->success = true;
			$response->type = 'success';
			$response->message = 'Usuario atualizado com sucesso!';
			$response->title = 'Sucesso:';
			$response->callback = 'redirect';
            $response->url = route('users.index');
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
			$user = User::findOrFail($id);
			$user->delete();
			
			// Prepare to response
			$response->success = true;
			$response->type = 'success';
			$response->message = 'Usuario deletado com sucesso';
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
	 * Load to permissions for role.
	 * @param Request $request - Id to role for select permissions.
	 * @return \Illuminate\Http\JsonResponse .
	 */
	public function loadPermissionRole(Request $request)
	{
		$response = $this->createResult();
		
		Log::debug('', ['' => $request->all()]);
		
		try
		{
			$roleId = $request->role_id;
			$userId = $request->user_id;
			$permissions = Role::findOrFail($roleId)->permissions;
			$data = [];
			
			if(empty($userId))
			{
				foreach($permissions as $key => $permission)
				{
					if(!str_contains($permission->name, 'manter-log'))
					{
						$data[$key]['id'] = $permission->id;
						$data[$key]['name'] = $permission->display_name;
						$data[$key]['selected'] = PermissionUser::query()->where('user_id', '=', $userId)->where('permission_id', '=', $permission->id)->count();
					}
					
				}
			}
			else
			{
				
				$permissionsUser = PermissionUser::whereUserId($userId)->select('permission_id')->get()->toArray();
				
				$dataPermission = array();
				
				foreach($permissionsUser as $permissionUser)
					$dataPermission[] = $permissionUser['permission_id'];
				
				foreach($permissions as $key => $permission)
				{
					if(!str_contains($permission->name, 'manter-log'))
					{
						$data[$key]['id'] = $permission->id;
						$data[$key]['name'] = $permission->display_name;
						
						if(in_array($permission->id, $dataPermission))
							$data[$key]['selected'] = true;
						else
							$data[$key]['selected'] = false;
					}
				}
			}
			
			// Prepare to response.
			$response->permissions = $data;
			$response->success = true;
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
		$self = Auth::user();
		
		try
		{
			$users = User::withTrashed()
                ->select('id', 'name', 'username', 'created_at')
				->when(!empty($self), function($query) use($self){
					return $query->where('id', '<>', $self->id);
				})
				->orderBy('created_at', 'desc');
			
			// $users = FilterTrait::applyFilter($request, $users);
			
			// Return to dataTables value.
			return DataTables::of($users)
				->editColumn('image', function(User $user)
				{
					return "<img class='rounded-circle img-fluid width-48 heigth-48 mx-auto d-flex' src='{$user->image->url_sm}' alt='Image'>";
				})
				->editColumn('created_at', function(User $user)
				{
					return $user->created_at->format('d/m/Y');
				})
				->addColumn('action', function(User $user)
				{
					$data = $user;
					$havePermission = $this->confirmPermission(
						(object)[
							'add' => 'cadastrar-usuario',
							'edit' => 'editar-usuario',
							'delete' => 'deletar-usuario'
						]
					);
					
					$actions = [
						'show' => route('users.show', $user->id),
						'edit' => route('users.edit', $user->id),
						'delete' => route('users.destroy', $user->id),
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
