<?php
namespace App\Http\Controllers\DefaultTraits;

use App\Http\Controllers\Controller;
use App\Models\AddressSearch;
use App\Models\City;
use App\Models\District;
use App\Models\State;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

trait AddressTrait
{
	/**
	 * @param Request $request
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function getAddress(Request $request)
	{
		$response = $this->createResult();
		
		try
		{
			if($request->has('cep'))
			{
				$cep = $request->cep;
				$cepNum = getOnlyNumbers($request->cep);
				
				$addressSearch = AddressSearch::query()
					->where('postal_code','=', $cep)
					->orWhere('postal_code','=', $cepNum)
					->first();
				
				// Get data.
				$city       = City::query()->find($addressSearch->city_id);
				$state      = State::query()->find($city->state_id);
				$district   = District::query()->find($addressSearch->district_id);
				
				// Prepare response
				$response->city     = $city;
				$response->state    = $state;
				$response->district = $district;
				$response->address  = $addressSearch;
				$response->success  = true;
			}
		}
		catch(QueryException $error)
		{
			$response->title = 'Erro:';
			$response->message = Controller::DATABASE_ERROR;
			$response->type = 'error';
			\Log::error($error);
		}
		catch(\Exception $error)
		{
			$response->title = 'Erro:';
			$response->message = Controller::GENERAL_ERROR;
			$response->type = 'error';
			\Log::error($error);
		}
		
		return Response::json($response);
	}
	
	/**
	 * @param Request $request
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function getCities(Request $request)
	{
		$response = $this->createResult();
		
		try
		{
			$results = [];
			$state_id = $request->state;
			$cities = City::query()->where('state_id','=',$state_id)->orderBy('name')->get();
			
			foreach($cities as $city)
				$results[] = array(
					'id' => $city->id,
					'text'  => $city->name,
				);
			
			$response->cities = $results;
			$response->sucess = true;
		}
		catch(QueryException $error)
		{
			$response->title = 'Erro:';
			$response->message = Controller::DATABASE_ERROR;
			$response->type = 'error';
			\Log::error($error);
		}
		catch(\Exception $error)
		{
			$response->title = 'Erro:';
			$response->message = Controller::GENERAL_ERROR;
			$response->type = 'error';
			\Log::error($error);
		}
		
		return Response::json($response);
	}
}