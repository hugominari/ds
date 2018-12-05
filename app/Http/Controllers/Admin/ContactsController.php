<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;
use Yajra\DataTables\Facades\DataTables;

class ContactsController extends Controller
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
	
	    return view('admin.contacts.index', compact('filterValues'));
    }

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function store(ContactRequest $request)
	{
		$response = $this->createResult();
		
		try
		{
			$contact = Contact::create($request->all());
			
			$response->success = true;
			$response->type = 'success';
			$response->message = 'Sua mensagem foi enviada com sucesso!';
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
        $contact = Contact::findOrFail($id);
        
        $status = $contact->status;
        
        if($status == Contact::STATUS_NEW)
        {
            $contact->status = Contact::STATUS_READED;
            $contact->save();
        }
        
        $data = [
            'contact',
        ];
        
        return view("admin.contacts.show", compact($data));
	}
	
	/**
	 * List All users.
	 */
	public function list(Request $request)
	{
		$response = $this->createResult();
		
		try
		{
			$contacts = Contact::all();
			
			// $users = FilterTrait::applyFilter($request, $users);
			
			// Return to dataTables value.
			return DataTables::of($contacts)
                ->editColumn('status', function(Contact $contact)
                {
                    $status = ($contact->status == 1) ? 'far fa-circle' : 'fas fa-check-circle';
                    return '<i class="' . $status . '"></i>';
                })
                ->editColumn('subject', function(Contact $contact)
                {
                    return str_limit($contact->subject, $limit = 50, $end = '...') ;
                })
                ->editColumn('created_at', function(Contact $contact)
                {
                    return $contact->created_at->format('d/m/Y');
                })
				->addColumn('action', function(Contact $contact)
				{
					$actions = route('contacts.show', $contact->id);
					
					return '<button type="button" class="btn btn-info float-right" href="' . $actions . '">
                                <i class="fa fa-eye pr-2"></i> Ver
                            </button>';
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
