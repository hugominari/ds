<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 04 Dec 2018 20:17:48 -0200.
 */

namespace App\Models\Base;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class District
 *
 * @property int $id
 * @property int $city_id
 * @property string $name
 * @property string $slug
 * @property \App\Models\City $city
 * @package App\Models\Base
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\District newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\District newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\District query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\District whereCityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\District whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\District whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\District whereSlug($value)
 * @mixin \Eloquent
 */
class District extends Eloquent
{
	public $timestamps = false;

	protected $casts = [
		'city_id' => 'int'
	];

	public function city()
	{
		return $this->belongsTo(\App\Models\City::class);
	}
}
