<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 04 Dec 2018 20:17:48 -0200.
 */

namespace App\Models\Base;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Address
 *
 * @property int $id
 * @property int $city_id
 * @property int $event_id
 * @property string $district
 * @property string $postal_code
 * @property string $latitude
 * @property string $longitude
 * @property string $address
 * @property string $complement
 * @property string $number
 * @property \App\Models\City $city
 * @property \App\Models\Event $event
 * @package App\Models\Base
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\Address newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\Address newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\Address query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\Address whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\Address whereCityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\Address whereComplement($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\Address whereDistrict($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\Address whereEventId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\Address whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\Address whereLatitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\Address whereLongitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\Address whereNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\Address wherePostalCode($value)
 * @mixin \Eloquent
 */
class Address extends Eloquent
{
	public $timestamps = false;

	protected $casts = [
		'city_id' => 'int',
		'event_id' => 'int'
	];

	public function city()
	{
		return $this->belongsTo(\App\Models\City::class);
	}

	public function event()
	{
		return $this->belongsTo(\App\Models\Event::class);
	}
}
