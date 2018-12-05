<?php
	
namespace App\Http\Controllers;

use App\Http\Controllers\DefaultTraits\AddressTrait;
use App\Http\Controllers\DefaultTraits\FilesTrait;
use App\Http\Controllers\DefaultTraits\FilterTrait;
use App\Models\City;
use App\Models\Role;
use App\Models\State;

class DefaultController extends Controller
{
	use AddressTrait, FilesTrait, FilterTrait;
	
	/**
	 * Get all activities to populate select
	 * @return array
	 */
	public static function getRolesToSelect($withUser = false)
	{
		$ids = [
			Role::ROLE_ADMIN,
			Role::ROLE_USER
		];
		
		if($withUser)
		{
			array_push($ids, Role::ROLE_USER);
			array_push($ids, Role::ROLE_ADMIN);
		}
		
		$roles = Role::whereIn('id', $ids)->select('id', 'display_name')->get();
		$result = ['' => ''];
		
		foreach($roles as $role)
			$result += [$role->id => humanize($role->display_name)];
		
		return $result;
	}
	
	/**
	 * Get all states in array to populate select
	 * @return array
	 */
	public static function getStatesToSelect()
	{
		$states = State::all('id', 'name');
		$result = ['' => ''];
		
		foreach($states as $state)
			$result += [$state->id => humanize($state->name)];
		
		return $result;
	}
	
	/**
	 * Get all cities to populate select
	 * @return array
	 */
	public static function getCitiesToSelect($stateId = null)
	{
		if(!empty($stateId))
		{
			$cities = City::query()->select('id', 'name')->where('state_id', '=', $stateId)->get();
		}
		else
		{
			$cities = City::all();
		}
		
		$result = ['' => ''];
		
		foreach($cities as $city)
			$result += [$city->id => humanize($city->name)];
		
		return $result;
	}
	
	/**
	 * Get boolean to populate select
	 * @return array
	 */
	public static function getBooleanToSelect()
	{
		return [
			'' => '',
			'0' => 'Não',
			'1' => 'Sim',
		];
	}
}

