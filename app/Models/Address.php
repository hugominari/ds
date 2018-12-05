<?php

namespace App\Models;

/**
 * App\Models\Address
 *
 * @property int $id
 * @property int $city_id
 * @property int $event_id
 * @property string|null $district
 * @property string|null $postal_code
 * @property string|null $latitude
 * @property string|null $longitude
 * @property string $address
 * @property string|null $complement
 * @property string|null $number
 * @property-read \App\Models\City $city
 * @property-read \App\Models\Event $event
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Address newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Address newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Address query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Address whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Address whereCityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Address whereComplement($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Address whereDistrict($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Address whereEventId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Address whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Address whereLatitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Address whereLongitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Address whereNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Address wherePostalCode($value)
 * @mixin \Eloquent
 */
class Address extends \App\Models\Base\Address
{
	protected $fillable = [
		'city_id',
		'event_id',
		'district',
		'postal_code',
		'latitude',
		'longitude',
		'address',
		'complement',
		'number'
	];
}
