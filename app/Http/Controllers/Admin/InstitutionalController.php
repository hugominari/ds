<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\HistoryRequest;
use App\Http\Requests\RulesRequest;
use App\Models\PageDescription;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;

class InstitutionalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index_rules()
    {
        $rule = PageDescription::query()
            ->where('sector', '=', PageDescription::SECTOR_INTERNAL_RULES)
            ->first();
        
	    return view('admin.institutional.index_rules', compact('rule'));
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index_history()
    {
        $history = PageDescription::query()
            ->where('sector', '=', PageDescription::SECTOR_OUR_HISTORY)
            ->first();
        
        return view('admin.institutional.index_history', compact('history'));
    }
    
	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function saveRules(RulesRequest $request)
	{
		$response = $this->createResult();
		
		try
		{
		    $typeRule = PageDescription::SECTOR_INTERNAL_RULES;
			$hasRule = PageDescription::query()
                ->where('sector', '=', $typeRule)
                ->first();
			
			//
			$pageRule = empty($hasRule) ? new PageDescription() : $hasRule;
            $pageRule->text = $request->text;
            $pageRule->sector = $typeRule;
            $pageRule->save();
            
            //Save image profile
            $this->saveFile($request->file, "public/institutional/{$typeRule}", 'regimento-interno-sindireceita-df');
            
			$response->success = true;
			$response->type = 'success';
			$response->time = 3000;
			$response->message = 'Regimento interno atualizado com sucesso';
			$response->callback = 'redirect';
			$response->url = route('admin.internal-rules');
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
    public function saveHistory(HistoryRequest $request)
    {
        $response = $this->createResult();
        
        try
        {
            $typeHistory = PageDescription::SECTOR_OUR_HISTORY;
            $hasHistory = PageDescription::query()
                ->where('sector', '=', $typeHistory)
                ->first();
            
            $pageHistory = empty($hasHistory) ? new PageDescription() : $hasHistory;
            $pageHistory->text = $request->text;
            $pageHistory->sector = $typeHistory;
            $pageHistory->save();
            
            $response->success = true;
            $response->type = 'success';
            $response->time = 3000;
            $response->message = 'Nossa Historia atualizada com sucesso';
            $response->callback = 'redirect';
            $response->url = route('admin.history');
        }
        catch(\Error $error)
        {
            $response->message = Controller::DATABASE_ERROR;
            $response->type = 'error';
            Log::error($error->getMessage() . " | Linha: {$error->getLine()}");
        }
        
        return Response::json($response);
    }
}
