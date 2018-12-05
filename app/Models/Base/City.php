<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 04 Dec 2018 20:17:48 -0200.
 */

namespace App\Models\Base;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class City
 *
 * @property int $id
 * @property int $state_id
 * @property string $name
 * @property string $slug
 * @property \App\Models\State $state
 * @property \Illuminate\Database\Eloquent\Collection $address_searches
 * @property \Illuminate\Database\Eloquent\Collection $addresses
 * @property \Illuminate\Database\Eloquent\Collection $districts
 * @package App\Models\Base
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\City newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\City newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\City query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\City whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\City whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\City whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\City whereStateId($value)
 * @mixin \Eloquent
 */
class City extends Eloquent
{
	public $timestamps = false;

	protected $casts = [
		'state_id' => 'int'
	];

	public function state()
	{
		return $this->belongsTo(\App\Models\State::class);
	}

	public function address_searches()
	{
		return $this->hasMany(\App\Models\AddressSearch::class);
	}

	public function addresses()
	{
		return $this->hasMany(\App\Models\Address::class);
	}

	public function districts()
	{
		return $this->hasMany(\App\Models\District::class);
	}
}
