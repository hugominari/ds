<?php

namespace App\Models;

/**
 * App\Models\MemberMandatory
 *
 * @property int $id
 * @property int $member_id
 * @property int $position_id
 * @property \Illuminate\Support\Carbon|null $date_start
 * @property \Illuminate\Support\Carbon|null $date_end
 * @property-read \App\Models\Member $member
 * @property-read \App\Models\Position $position
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MemberMandatory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MemberMandatory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MemberMandatory query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MemberMandatory whereDateEnd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MemberMandatory whereDateStart($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MemberMandatory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MemberMandatory whereMemberId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MemberMandatory wherePositionId($value)
 * @mixin \Eloquent
 * @property int $mandatory_id
 * @property-read \App\Models\Mandatory $mandatory
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MemberMandatory whereMandatoryId($value)
 */
class MemberMandatory extends \App\Models\Base\MemberMandatory
{
	protected $fillable = [
		'member_id',
		'position_id',
		'date_start',
		'date_end'
	];
}
