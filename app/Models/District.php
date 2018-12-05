<?php

namespace App\Models;

/**
 * App\Models\District
 *
 * @property int $id
 * @property int $city_id
 * @property string $name
 * @property string $slug
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\District newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\District newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\District query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\District whereCityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\District whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\District whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\District whereSlug($value)
 * @mixin \Eloquent
 * @property-read \App\Models\City $city
 */
class District extends \App\Models\Base\District
{
	protected $fillable = [
		'city_id',
		'name',
		'slug'
	];
}
