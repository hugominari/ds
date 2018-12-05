<?php

namespace App\Models;

/**
 * App\Models\AddressSearch
 *
 * @property int $id
 * @property int $city_id
 * @property int|null $district_id
 * @property string|null $address
 * @property string|null $postal_code
 * @property string|null $latitude
 * @property string|null $longitude
 * @property int|null $ddd
 * @property-read \App\Models\City $city
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AddressSearch newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AddressSearch newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AddressSearch query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AddressSearch whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AddressSearch whereCityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AddressSearch whereDdd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AddressSearch whereDistrictId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AddressSearch whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AddressSearch whereLatitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AddressSearch whereLongitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AddressSearch wherePostalCode($value)
 * @mixin \Eloquent
 */
class AddressSearch extends \App\Models\Base\AddressSearch
{
	protected $fillable = [
		'city_id',
		'district_id',
		'address',
		'postal_code',
		'latitude',
		'longitude',
		'ddd'
	];
}
