<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 04 Dec 2018 20:17:49 -0200.
 */

namespace App\Models\Base;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Position
 *
 * @property int $id
 * @property string $name
 * @property int $type
 * @property \Illuminate\Database\Eloquent\Collection $member_mandatories
 * @package App\Models\Base
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\Position newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\Position newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\Position query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\Position whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\Position whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\Position whereType($value)
 * @mixin \Eloquent
 */
class Position extends Eloquent
{
	public $timestamps = false;

	protected $casts = [
		'type' => 'int'
	];

	public function member_mandatories()
	{
		return $this->hasMany(\App\Models\MemberMandatory::class);
	}
}
