<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MandatoryRequest;
use App\Http\Requests\MemberRequest;
use App\Models\Mandatory;
use App\Models\Member;
use App\Models\MemberMandatory;
use App\Models\Position;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;
use Yajra\DataTables\Facades\DataTables;

class MandatoryController extends Controller
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
	
	    return view('admin.mandatory.index', compact(['filterValues']));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($type = null)
    {
        $positions = Position::toSelect();
        $positionsDirectors = Position::whereType(Position::TYPE_DIRECTORS)->get();
        $positionsFiscals = Position::whereType(Position::TYPE_FISCALS)->get();
        $members = Member::all();
     
        return view("admin.mandatory.create", compact(['positions', 'positionsDirectors', 'positionsFiscals', 'members']));
    }
    
	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function store(MandatoryRequest $request)
	{
		$response = $this->createResult();
	
		try
		{
		    $mandatory = new Mandatory();
            $mandatory->name = $request->name;
            $mandatory->date_start = $request->date_start;
            $mandatory->date_end = $request->date_end;
            $mandatory->save();
            
            $directors = json_decode($request->directors);
            $fiscals = json_decode($request->fiscals);
            
            // Directors
            foreach ($directors as $director)
            {
                $memberMandatory = new MemberMandatory();
                $memberMandatory->mandatory_id = $mandatory->id;
                $memberMandatory->member_id = $director->member_id;
                $memberMandatory->position_id = $director->position_id;
                $memberMandatory->save();
            }
            
            // Fiscals
            foreach ($fiscals as $fiscal)
            {
                $memberMandatory = new MemberMandatory();
                $memberMandatory->mandatory_id = $mandatory->id;
                $memberMandatory->member_id = $fiscal->member_id;
                $memberMandatory->position_id = $fiscal->position_id;
                $memberMandatory->save();
            }
            
			$response->success = true;
			$response->type = 'success';
			$response->time = 3000;
			$response->message = 'Mandato cadastrado com sucesso';
			$response->callback = 'redirect';
			$response->url = route('mandatory.index');
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
        $positions = Position::toSelect();
        $positionsDirectors = Position::whereType(Position::TYPE_DIRECTORS)->get();
        $positionsFiscals = Position::whereType(Position::TYPE_FISCALS)->get();
        $page = $showOnly ? 'show' : 'edit';
        
        $mandatory = Mandatory::findOrFail($id);
        
        $directors = $mandatory->getDirectors(false, true);
        $fiscals = $mandatory->getFiscals(false, true);
        
        $except = $mandatory->getMembersIds();
        $members = Member::query()->whereNotIn('id', $except);
        
        $data = [
            'positions',
            'positionsDirectors',
            'positionsFiscals',
            'members',
            'mandatory',
            'directors',
            'fiscals',
        ];
        
		return view("admin.mandatory.{$page}", compact($data));
	}
	
	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  int                      $id
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function update(MandatoryRequest $request, $id)
	{
		$response = $this->createResult();
		
        try
        {
            $mandatory = Mandatory::findOrFail($id);
            $mandatory->name = $request->name;
            $mandatory->date_start = $request->date_start;
            $mandatory->date_end = $request->date_end;
            $mandatory->save();
            
            $directors = json_decode($request->directors);
            $fiscals = json_decode($request->fiscals);
            
            $mandatory->releaseMemberMandatory();
            
            // Directors
            foreach ($directors as $director)
            {
                $memberMandatory = new MemberMandatory();
                $memberMandatory->mandatory_id = $mandatory->id;
                $memberMandatory->member_id = $director->member_id;
                $memberMandatory->position_id = $director->position_id;
                $memberMandatory->save();
            }
            
            // Fiscals
            foreach ($fiscals as $fiscal)
            {
                $memberMandatory = new MemberMandatory();
                $memberMandatory->mandatory_id = $mandatory->id;
                $memberMandatory->member_id = $fiscal->member_id;
                $memberMandatory->position_id = $fiscal->position_id;
                $memberMandatory->save();
            }
            
            $response->success = true;
            $response->type = 'success';
            $response->time = 3000;
            $response->title = 'Sucesso: ';
            $response->message = 'Mandato atualizado com sucesso';
            $response->callback = 'redirect';
            $response->url = route('mandatory.index');
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
	
		// try
		// {
		// 	$member = Member::findOrFail($id);
		// 	$member->delete();
        //
		// 	// Prepare to response
		// 	$response->success = true;
		// 	$response->type = 'success';
		// 	$response->message = 'Membro deletado com sucesso';
		// 	$response->title = 'Sucesso';
		// }
		// catch(\Error $error)
		// {
		// 	$response->message = Controller::DATABASE_ERROR;
		// 	$response->type = 'error';
		// 	Log::error($error->getMessage() . " | Linha: {$error->getLine()}");
		// }
	
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
			$mandatories = Mandatory::all();
			
			// Return to dataTables value.
			return DataTables::of($mandatories)
                ->editColumn('date_start', function(Mandatory $mandatory)
                {
                    return $mandatory->date_start->format('d/m/Y');
                })
                ->editColumn('date_end', function(Mandatory $mandatory)
                {
                    return $mandatory->date_end->format('d/m/Y');
                })
				->addColumn('action', function(Mandatory $mandatory)
				{
					$data = $mandatory;
					$havePermission = $this->confirmPermission(
						(object)[
							'both' => 'manter-mandatos',
						]
					);
					
					$actions = [
						'show' => route('mandatory.show', $mandatory->id),
						'edit' => route('mandatory.edit', $mandatory->id),
						'delete' => route('mandatory.destroy', $mandatory->id),
					];
					
					return view('layouts.datatables.actions', compact(['data', 'actions', 'havePermission']))->render();
				})
				->rawColumns(['action', 'diretors', 'fiscals'])
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
