<?php
/**
 * Created by PhpStorm.
 * User: hugominari
 * Date: 17/07/18
 * Time: 00:34
 */

namespace App;

/**
 * Class MyApp
 * @package App
 */
class Constants
{
	/**
	 * ADVANCED FILTER
	 */
	const FILTER_EQUAL                      = '1';
	const FILTER_EQUAL_SYMBOL               = '=';
	
	const FILTER_CONTAINS                   = '2';
	const FILTER_CONTAINS_SYMBOL            = 'like';
	
	const FILTER_NOT_EQUAL                  = '3';
	const FILTER_NOT_EQUAL_SYMBOL           = '<>';
	
	const FILTER_START_WITH                 = '4';
	const FILTER_START_WITH_SYMBOL          = 'like';
	
	const FILTER_END_WITH                   = '5';
	const FILTER_END_WITH_SYMBOL            = 'like';
	
	const FILTER_GREATER_THAN               = '6';
	const FILTER_GREATER_THAN_SYMBOL        = '>';
	
	const FILTER_GREATER_OR_EQUAL           = '7';
	const FILTER_GREATER_OR_EQUAL_SYMBOL    = '>=';
	
	const FILTER_LESS_THAN                  = '8';
	const FILTER_LESS_THAN_SYMBOL           = '<';
	
	const FILTER_LESS_OR_EQUAL              = '9';
	const FILTER_LESS_OR_EQUAL_SYMBOL       = '<=';
	
	const FILTER_DATE_GREATER_THAN          = '10';
	const FILTER_DATE_GREATER_THAN_SYMBOL   = '>=';
	
	const FILTER_DATE_LESS_THAN             = '11';
	const FILTER_DATE_LESS_THAN_SYMBOL      = '<=';
}
