<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Http\Requests\BasicRequest;
use App\Models\Call;
use App\Models\Feed;
use App\Models\MemberMandatory;
use App\Models\Position;
use App\Models\TypeCall;
use App\Models\Website;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Route;
use Yajra\DataTables\DataTables;

class BasicController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @param BasicRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(BasicRequest $request)
    {
        $response = $this->createResult();
        $model = $request->get('model');
        $type = $request->get('type');
        $id = $request->get('id');
        $name = $request->get('name');
        $row = null;
        
        if (!empty($model)) {
            switch ($model) {
                case 'websites':
                    $table = (empty($id))
                        ? new Website()
                        : Website::findOrFail(
                            $id
                        );
                    
                    $columns = ['name', 'url', 'type'];
                    break;
                case 'feeds':
                    $table = (empty($id)) ? new Feed() : Feed::findOrFail($id);
                    $columns = ['name', 'url'];
                    break;
                case 'positions':
                    $table = (empty($id)) ? new Position()
                        : Position::findOrFail($id);
                    $columns = ['name', 'type'];
                    break;
                case 'type_calls':
                    $table = (empty($id)) ? new TypeCall()
                        : TypeCall::findOrFail($id);
                    $columns = ['name'];
                    break;
            }
        }
        
        // Verify if exists item register
        if ($row) {
            $response->success = true;
            $response->message
                = "O item <strong>$name</strong> já está cadastrado.";
            $response->type = 'info';
            $response->title = 'Informação:';
            return Response::json($response);
        }
        
        if (isset($table) && isset($columns)) {
            if (empty($id)) {
                $response = $this->store($request, $table, $columns);
            } else {
                $response = $this->update($request, $table, $columns);
            }
        }
        
        return Response::json($response);
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param $request
     * @param $model
     * @param $columns
     *
     * @return object
     */
    protected function store($request, $model, $columns)
    {
        $response = $this->createResult();
        
        //Variables
        $name = $this->isDefined($request, 'name');
        $url = $this->isDefined($request, 'url');
        $type = $this->isDefined($request, 'type');
        
        //Name
        if ($name->have && in_array('name', $columns)) {
            $model->name = $name->value;
        }
        
        //Type
        if ($url->have && in_array('url', $columns)) {
            $model->url = $url->value;
        }
        
        //site
        if ($type->have && in_array('type', $columns)) {
            $model->type = $type->value;
        }
        
        
        try {
            $model->save();
            
            // Prepare to response.
            $response->success = true;
            $response->model = $model;
            $response->message = 'Registro armazenado com sucesso!';
            $response->type = 'success';
            $response->title = 'Sucesso:';
        } catch (\Error $error) {
            // Prepare to response.
            $response->title = 'Erro:';
            $response->message = 'Não foi possível armazenar no banco!';
            $response->type = 'error';
        }
        
        return $response;
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param Request $request
     * @param         $id
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function edit(Request $request, $id)
    {
        $response = $this->createResult();
        $model = $request->get('model');
        $data = [];
        
        if (!empty($model) && !empty($id)) {
            switch ($model) {
                case 'websites':
                    $table = Website::findOrFail($id);
                    $data['id'] = $table->id;
                    $data['name'] = $table->name;
                    $data['url'] = $table->url;
                    $data['type'] = $table->type;
                    break;
                case 'feeds':
                    $table = Feed::findOrFail($id);
                    $data['id'] = $table->id;
                    $data['name'] = $table->name;
                    $data['url'] = $table->url;
                    break;
                case 'positions':
                    $table = Position::findOrFail($id);
                    $data['id'] = $table->id;
                    $data['name'] = $table->name;
                    $data['type'] = $table->type;
                    break;
                case 'type_calls':
                    $table = TypeCall::findOrFail($id);
                    $data['id'] = $table->id;
                    $data['name'] = $table->name;
                    break;
            }
            
            if (!empty($table) && isset($data['id'])) {
                $response->success = true;
                $response->data = $data;
            } else {
                $response->title = 'Erro:';
                $response->message = Controller::DATABASE_ERROR;
                $response->type = 'error';
            }
        } else {
            $response->title = 'Erro:';
            $response->message = 'Faltando parametros na requisição!';
            $response->type = 'error';
        }
        
        return Response::json($response);
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    protected function update(Request $request, $model, $columns)
    {
        $response = $this->createResult();
        
        //Variables
        $name = $this->isDefined($request, 'name');
        $url = $this->isDefined($request, 'url');
        $type = $this->isDefined($request, 'type');
        $data = [];
        $inputs = [];
        
        //Name
        if ($name->have && in_array('name', $columns)) {
            $model->name = $name->value;
            $data['name'] = $name->value;
            $inputs['name'] = 'name';
        }
        
        //Site
        if ($url->have && in_array('url', $columns)) {
            $model->url = $url->value;
            $data['url'] = $url->value;
            $inputs['url'] = 'url';
        }
        
        //Description
        if ($type->have && in_array('type', $columns)) {
            $model->type = $type->value;
            $data['type'] = $type->value;
            $inputs['type'] = 'type';
        }
        
        
        try {
            $model->save();
            
            $response->success = true;
            $response->message = 'Registro atualizado com sucesso!';
            $response->type = 'success';
            $response->title = 'Sucesso:';
            $response->data = $data;
            $response->inputs = $inputs;
        } catch (\Error $error) {
            $response->title = 'Erro:';
            $response->message = 'Não foi possível atualizar o registro!';
            $response->type = 'error';
        }
        
        return Response::json($response);
    }
    
    /**
     * Delete register from database
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function destroy(Request $request)
    {
        $response = $this->createResult();
        
        $model = $request->model;
        $params = $request->route()->parameters();
        $countRecords = 0;
        
        \Log::debug($request->all());
        \Log::debug($params);
        
        if (is_array($params) && !empty($model) && isset($params['id'])) {
            //Define table
            switch ($model) {
                case 'websites':
                    $record = Website::findOrFail($params['id']);
                    break;
                case 'feeds':
                    $record = Feed::findOrFail($params['id']);
                    break;
                case 'positions':
                    $record = Position::findOrFail($params['id']);
                    
                    \Log::debug('asdasdasd');
                    if (!empty($record)) {
                        $countRecords = MemberMandatory::query()->where(
                            'position_id', '=', $record->id
                        )->count();
                    
                        \Log::debug($countRecords);
                    }
                    break;
                case 'type_calls':
                    $record = TypeCall::findOrFail($params['id']);
                    
                    if (!empty($record)) {
                        $countRecords = Call::query()->where(
                            'type_call_id', '=', $record->id
                        )->count();
                    }
                    break;
            }
            
            try {
                \Log::debug('record', ['' => $record]);
                if ((!empty($record) && $countRecords == 0)) {
                    
                    $record->delete();
                    
                    $response->success = true;
                    $response->title = 'Sucesso:';
                    $response->message
                        = 'O registro foi deletado do banco de dados!';
                    $response->type = 'success';
                } else {
                    $response->success = false;
                    $response->title = 'Opss! ';
                    $response->message
                        = 'Existe outras tabelas utilizando este registro, Não é possível deletá-lo.';
                    $response->type = 'warning';
                }
            } catch (QueryException $e) {
                $response->title = 'Erro:';
                $response->message = Controller::DATABASE_ERROR;
                $response->type = 'error';
                \Log::error($e);
            } catch (\Exception $e) {
                $response->title = 'Erro:';
                $response->message = Controller::DATABASE_ERROR;
                $response->type = 'error';
                \Log::error($e);
            }
        }
        
        return Response::json($response);
    }
    
    /**
     * Process dataTable ajax response.
     *
     * @param null $type
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function list($model = null)
    {
        $response = $this->createResult();
        
        try {
            if (!empty($model)) {
                switch ($model) {
                    case 'websites':
                        $builders = Website::all();
                        $permissions = (object)['both' => 'manter-websites'];
                        break;
                    case 'feeds':
                        $builders = Feed::all();
                        $permissions = (object)['both' => 'manter-feeds'];
                        break;
                    case 'positions':
                        $builders = Position::all();
                        $permissions = (object)['both' => 'manter-positions'];
                        break;
                    case 'type_calls':
                    default:
                        $builders = TypeCall::all();
                        $permissions = (object)['both' => 'manter-calls'];
                        break;
                }
                
                return DataTables::of($builders)->editColumn(
                    'type', function($data)
                {
                    return $data->type_text;
                }
                )->editColumn(
                    'url', function($data)
                {
                    return $data->url;
                }
                )->addColumn(
                    'members', function($data)
                {
                    if(isset($data->member_mandatories))
                        return $data->member_mandatories->count();
                    
                    return null;
                }
                )->addColumn(
                    'action', function($data) use ($permissions)
                {
                    $havePermission = $this->confirmPermission(
                        $permissions
                    );
                    $layoutActions = 'admin.layouts.datatables.actions';
                    $user = \Auth::user();
                    $actions = [
                        'delete' => route('basic.destroy', $data->id),
                        'edit'   => route('basic.edit', $data->id)
                    ];
                    
                    if (Route::getCurrentRoute()->getName() == 'basic.list') {
                        $layoutActions
                            = 'layouts.datatables.simple-actions';
                    }
                    
                    return view(
                        $layoutActions,
                        compact(['data', 'actions', 'havePermission'])
                    )->render();
                }
                )->rawColumns(
                    ['action', 'type', 'url']
                )->make(true);
            }
        } catch (QueryException $e) {
            $response->title = 'Erro:';
            $response->message = Controller::DATABASE_ERROR;
            $response->type = 'error';
            \Log::error($e);
        } catch (\Exception $e) {
            $response->title = 'Erro:';
            $response->message = Controller::DATABASE_ERROR;
            $response->type = 'error';
            \Log::error($e);
        }
        
        return Response::json($response);
    }
}

