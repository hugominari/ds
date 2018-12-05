<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 04 Dec 2018 20:17:48 -0200.
 */

namespace App\Models\Base;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Mandatory
 *
 * @property int $id
 * @property string $name
 * @property \Carbon\Carbon $date_start
 * @property \Carbon\Carbon $date_end
 * @property \Illuminate\Database\Eloquent\Collection $members
 * @package App\Models\Base
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\Mandatory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\Mandatory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\Mandatory query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\Mandatory whereDateEnd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\Mandatory whereDateStart($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\Mandatory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\Mandatory whereName($value)
 * @mixin \Eloquent
 */
class Mandatory extends Eloquent
{
	protected $table = 'mandatory';
	public $timestamps = false;

	protected $dates = [
		'date_start',
		'date_end'
	];

	public function members()
	{
		return $this->belongsToMany(\App\Models\Member::class, 'member_mandatory')
					->withPivot('id', 'position_id');
	}
}
