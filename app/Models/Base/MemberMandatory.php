<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 04 Dec 2018 20:17:48 -0200.
 */

namespace App\Models\Base;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class MemberMandatory
 *
 * @property int $id
 * @property int $mandatory_id
 * @property int $member_id
 * @property int $position_id
 * @property \App\Models\Mandatory $mandatory
 * @property \App\Models\Member $member
 * @property \App\Models\Position $position
 * @package App\Models\Base
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\MemberMandatory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\MemberMandatory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\MemberMandatory query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\MemberMandatory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\MemberMandatory whereMandatoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\MemberMandatory whereMemberId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\MemberMandatory wherePositionId($value)
 * @mixin \Eloquent
 */
class MemberMandatory extends Eloquent
{
	protected $table = 'member_mandatory';
	public $timestamps = false;

	protected $casts = [
		'mandatory_id' => 'int',
		'member_id' => 'int',
		'position_id' => 'int'
	];

	public function mandatory()
	{
		return $this->belongsTo(\App\Models\Mandatory::class);
	}

	public function member()
	{
		return $this->belongsTo(\App\Models\Member::class);
	}

	public function position()
	{
		return $this->belongsTo(\App\Models\Position::class);
	}
}
