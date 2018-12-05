<?php
namespace App\Http\Controllers\DefaultTraits;

use App\Constants;
use Illuminate\Http\Request;

trait FilterTrait
{
	/**
	 * @param $filter
	 * @return object
	 *
	 */
	public static function convertFilter($filter)
	{
		switch($filter)
		{
			case Constants::FILTER_CONTAINS:
				$operator = 'like';
				$pre = '%';
				$pos = '%';
				break;
			case Constants::FILTER_NOT_EQUAL:
				$operator = '<>';
				break;
			case Constants::FILTER_START_WITH:
				$operator = 'like';
				$pos = '%';
				break;
			case Constants::FILTER_END_WITH:
				$operator = 'like';
				$pre = '%';
				break;
			case Constants::FILTER_GREATER_THAN:
				$operator = '>';
				break;
			case Constants::FILTER_GREATER_OR_EQUAL:
			case Constants::FILTER_DATE_GREATER_THAN:
				$operator = '>=';
				break;
			case Constants::FILTER_LESS_THAN:
				$operator = '<';
				break;
			case Constants::FILTER_LESS_OR_EQUAL:
			case Constants::FILTER_DATE_LESS_THAN:
				$operator = '<=';
				break;
			default:
				$operator = '=';
				break;
		}
		
		return (object)[
			'operator' => $operator,
			'pos' => isset($pos) ? $pos : '',
			'pre' => isset($pre) ? $pre : '',
		];
	}
	
	/**
	 * @param Request $request
	 * @param         $model
	 * @return mixed
	 */
	public static function applyFilter(Request $request, $model)
	{
		if($request->has('filter') && !empty($request->filter))
		{
			$filters = $request->filter;

			foreach($filters as $filter)
			{
				$filter = (object)$filter;
				$operators = self::convertFilter($filter->operator);
				$value = $operators->pre . $filter->value . $operators->pos;
				$useJoin = isset($filter->relation) && !empty($filter->relation);
				$modOrPlus = $filter->plus;
				
				if($useJoin)
				{
					$joinTable = $filter->fk_table;
					$methodJoin = $filter->relation;
					$joinColumn = $filter->fk_columns;

					$model->whereHas($joinTable, function($query) use($operators, $value, $modOrPlus, $methodJoin, $joinColumn){
						
						if($modOrPlus == 'or')
							$query->orWhere($joinColumn, $operators->operator, $value);
						else
							$query->where($joinColumn, $operators->operator, $value);
						
						return $query;
					});
				}
				else
				{
					if($modOrPlus == 'or')
						$model->orWhere($filter->column, $operators->operator, $value);
					else
						$model->where($filter->column, $operators->operator, $value);
				}
			}
		}
		
		return $model;
	}
}