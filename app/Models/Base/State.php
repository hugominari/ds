<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 04 Dec 2018 20:17:49 -0200.
 */

namespace App\Models\Base;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class State
 *
 * @property int $id
 * @property string $name
 * @property string $initials
 * @property \Illuminate\Database\Eloquent\Collection $cities
 * @package App\Models\Base
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\State newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\State newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\State query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\State whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\State whereInitials($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\State whereName($value)
 * @mixin \Eloquent
 */
class State extends Eloquent
{
	public $timestamps = false;

	public function cities()
	{
		return $this->hasMany(\App\Models\City::class);
	}
}
