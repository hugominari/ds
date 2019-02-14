<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AttendanceRequest;
use App\Http\Requests\ContactRequest;
use App\Models\Call;
use App\Models\Contact;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;
use Yajra\DataTables\Facades\DataTables;

class AttendanceController extends Controller
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
		'cpf' => [
			'type' => 'text',
			'column' => 'cpf',
			'label' => 'CPF',
		],
	];

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
	
	    return view('admin.attendances.index', compact('filterValues'));
    }

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function store(AttendanceRequest $request)
	{
		$response = $this->createResult();
		
		try
		{
		    $currentUser = \Auth::user();
		    
			$attendance = new Call();
			$attendance->type_call_id = $request->type_call_id;
			$attendance->user_id = $currentUser->id;
			$attendance->name = $request->name;
			$attendance->cpf = getOnlyNumbers($request->cpf);
			$attendance->description = $request->description;
			$attendance->date = $request->date;
			$attendance->save();
			
            $response->success = true;
			$response->type = 'success';
			$response->message = 'Atendimento registrado com sucesso!';
            $response->title = 'Sucesso:';
            $response->callback = 'redirect';
            $response->url = route('attendance.index');
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
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function update(AttendanceRequest $request, $id)
	{
		$response = $this->createResult();
		
		try
		{
            $attendance = Call::findOrFail($id);
		    $currentUser = \Auth::user();
		    
		    if($attendance->user_id == $currentUser->id)
            {
                $attendance->type_call_id = $request->type_call_id;
                $attendance->user_id = $currentUser->id;
                $attendance->name = $request->name;
                $attendance->cpf = getOnlyNumbers($request->cpf);
                $attendance->description = $request->description;
                $attendance->date = $request->date;
                $attendance->save();
    
                $response->success = true;
                $response->type = 'success';
                $response->message = 'Atendimento atualizado com sucesso!';
                $response->title = 'Sucesso:';
                $response->callback = 'redirect';
                $response->url = route('attendance.index');
                $response->time = 3000;
            }
            else
            {
                $response->message = 'Você pode editar somente seus atendimentos!';
                $response->type = 'error';
            }
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
        $attendance = Call::findOrFail($id);

        $data = [
            'attendance',
        ];
        
        return view("admin.attendances.show", compact($data));
	}
	
	/**
	 * Display the specified resource.
	 *
	 * @param $id
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
	 */
	public function edit($id)
	{
        $attendance = Call::findOrFail($id);

        $data = [
            'attendance',
        ];
        
        return view("admin.attendances.edit", compact($data));
	}
	
	/**
	 * List All users.
	 */
	public function list(Request $request)
	{
		$response = $this->createResult();
		
		try
		{
		    $currentUser = \Auth::user();
			$attendances = Call::whereUserId($currentUser->id);
			
			// $users = FilterTrait::applyFilter($request, $users);
			
			// Return to dataTables value.
			return DataTables::of($attendances)
                ->editColumn('type_call', function(Call $attendance)
                {
                    return $attendance->type_call->name;
                })
                ->editColumn('date', function(Call $attendance)
                {
                    return $attendance->date->format('d/m/Y H:i:s');
                })
				->addColumn('action', function(Call $attendance)
				{
					// $actions = route('attendance.show', $attendance->id);
					//
					// return '<button type="button" class="btn btn-info float-right" href="' . $actions . '">
                     //            <i class="fa fa-eye pr-2"></i> Ver
                     //        </button>';
                    //
                    
                    
                    $data = $attendance;
                    $havePermission = $this->confirmPermission(
                        (object)[
                            'add' => 'manter-atendimentos',
                            'edit' => 'manter-atendimentos',
                        ]
                    );
                    
                    $actions = [
                        'show' => route('attendance.show', $attendance->id),
                        'edit' => route('attendance.edit', $attendance->id),
                        'delete' => route('attendance.destroy', $attendance->id),
                    ];
                    
                    return view('layouts.datatables.actions', compact(['data', 'actions', 'havePermission']))->render();
					
				})
				->rawColumns(['icon', 'status', 'action'])
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
