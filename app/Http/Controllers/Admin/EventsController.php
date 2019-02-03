<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\EventRequest;
use App\Models\Event;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;
use Yajra\DataTables\Facades\DataTables;

class EventsController extends Controller
{
    /**
     * Array to Filter DataTables Values.
     *
     * @var array
     */
    private $filterValues
        = ['name' => ['type' => 'text', 'column' => 'name', 'label' => 'Nome'],
           'url'  => ['type'  => 'text', 'column' => 'url',
                      'label' => 'Site',],];
    
    protected $folder;
    protected $messageAdd;
    protected $messageEdit;
    protected $messageDel;
    
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $route = \request()->route()->uri;
        $isCulture = str_contains($route, 'culture');
        $complement = $isCulture ? 'de Cultura e Lazer ' : '';
        
        $this->folder = $isCulture ? 'cultures' : 'events';
        $this->messageAdd = "Evento {$complement}cadastrado com sucesso!";
        $this->messageEdit = "Evento {$complement}atualizado com sucesso!";
        $this->messageDel = "Evento {$complement}deletado com sucesso!";
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $filterValues = $this->filterValues;
        
        return view("admin.{$this->folder}.index", compact('filterValues'));
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($type = null)
    {
        return view("admin.{$this->folder}.create");
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(EventRequest $request)
    {
        $response = $this->createResult();
        
        try {
            if ($this->folder == 'cultures') {
                $request->merge(['type' => Event::TYPE_CULTURES]);
            }
            
            $event = Event::create($request->all());
            $path = "public/{$this->folder}/{$event->id}";
            
            //Save image
            if (!empty($request->image)) {
                $this->saveFile(
                    $request->image, $path,
                    'image'
                );
            }
    
            //Save album
            if (!empty($request->album)) {
                foreach ($request->album as $key => $album)
                {
                    $this->saveFile(
                        $album, "{$path}/album",
                        "album_photo_{$key}"
                    );
                }
            }
            
            $response->success = true;
            $response->type = 'success';
            $response->time = 3000;
            $response->message = $this->messageAdd;
            $response->callback = 'redirect';
            $response->url = route("{$this->folder}.index");
        } catch (\Error $error) {
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
     *
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
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function edit($id, $showOnly = false)
    {
        $event = Event::findOrFail($id);
        $page = $showOnly ? 'show' : 'edit';
        $albumPhotos = $event->getAlbum();
        
        return view("admin.{$this->folder}.{$page}", compact('event', 'albumPhotos'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int                      $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(EventRequest $request, $id)
    {
        $response = $this->createResult();
        
        try {
            $event = Event::findOrFail($id);
            $event->update($request->all());
            $path = "public/{$this->folder}/{$event->id}";
            
            //Save image
            if (!empty($request->image)) {
                $this->saveFile(
                    $request->image, $path,
                    'image', false, true
                );
            }
    
            //Save album
            if (!empty($request->album)) {
                foreach ($request->album as $key => $album)
                {
                    $this->saveFile(
                        $album, "{$path}/album",
                        "album_photo_{$key}", false, true
                    );
                }
            }
            
            $response->success = true;
            $response->type = 'success';
            $response->message = $this->messageEdit;
            $response->title = 'Sucesso:';
            $response->callback = 'redirect';
            $response->url = route("{$this->folder}.index");
            $response->time = 3000;
        } catch (\Error $error) {
            $response->message = Controller::DATABASE_ERROR;
            $response->type = 'error';
            Log::error($error->getMessage() . " | Linha: {$error->getLine()}");
        }
        
        return Response::json($response);
    }
    
    /**
     * @param Request $request
     * @param         $id
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(Request $request, $id)
    {
        $response = $this->createResult();
        
        try {
            $event = Event::findOrFail($id);
            $event->delete();
            
            // Prepare to response
            $response->success = true;
            $response->type = 'success';
            $response->message = $this->messageDel;
            $response->title = 'Sucesso';
        } catch (\Error $error) {
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
        
        try {
            $isCulture = ($this->folder == 'cultures');
            $events = Event::query()->when(
                    $isCulture, function($query)
                {
                    return $query->where('type', '=', Event::TYPE_CULTURES);
                }
                )->when(
                    !$isCulture, function($query)
                {
                    return $query->where('type', '=', Event::TYPE_EVENT);
                }
                );
            
            // Return to dataTables value.
            return DataTables::of($events)->editColumn(
                    'date', function(Event $event)
                {
                    return $event->date->format('d/m/Y H:i:s');
                }
                )->editColumn(
                    'image', function(Event $event)
                {
                    return "<img class='rounded-circle img-fluid width-48 heigth-48 mx-auto d-flex' src='{$event->image->url_sm}' alt='Image'>";
                }
                )->addColumn(
                    'action', function(Event $event)
                {
                    $data = $event;
                    $havePermission = $this->confirmPermission(
                        (object)['add'    => 'cadastrar-eventos',
                                 'edit'   => 'editar-eventos',
                                 'delete' => 'deletar-eventos']
                    );
    
                    $model = $event->isCulture() ? 'cultures' : 'events';
                    
                    $actions = ['show'   => route("{$model}.show", $event->id),
                                'edit'   => route("{$model}.edit", $event->id),
                                'delete' => route(
                                    "{$model}.destroy", $event->id
                                ),];
                    
                    return view(
                        'layouts.datatables.actions',
                        compact(['data', 'actions', 'havePermission'])
                    )->render();
                }
                )->rawColumns(['image', 'action'])->make(true);
        } catch (\Error $error) {
            $response->message = Controller::DATABASE_ERROR;
            $response->type = 'error';
            Log::error($error->getMessage() . " | Linha: {$error->getLine()}");
        } catch (\Exception $e) {
            $response->message = Controller::DATABASE_ERROR;
            $response->type = 'error';
            Log::error($e->getMessage() . " | Linha: {$e->getLine()}");
        }
        
        return Response::json($response);
    }
    
}
