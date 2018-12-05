<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 04 Dec 2018 20:17:48 -0200.
 */

namespace App\Models\Base;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class AddressSearch
 *
 * @property int $id
 * @property int $city_id
 * @property int $district_id
 * @property string $address
 * @property string $postal_code
 * @property string $latitude
 * @property string $longitude
 * @property int $ddd
 * @property \App\Models\City $city
 * @package App\Models\Base
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\AddressSearch newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\AddressSearch newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\AddressSearch query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\AddressSearch whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\AddressSearch whereCityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\AddressSearch whereDdd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\AddressSearch whereDistrictId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\AddressSearch whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\AddressSearch whereLatitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\AddressSearch whereLongitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\AddressSearch wherePostalCode($value)
 * @mixin \Eloquent
 */
class AddressSearch extends Eloquent
{
	protected $table = 'address_searchs';
	public $timestamps = false;

	protected $casts = [
		'city_id' => 'int',
		'district_id' => 'int',
		'ddd' => 'int'
	];

	public function city()
	{
		return $this->belongsTo(\App\Models\City::class);
	}
}
