<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 04 Dec 2018 20:17:48 -0200.
 */

namespace App\Models\Base;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Member
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $phone
 * @property string $cpf
 * @property \Carbon\Carbon $birth_date
 * @property \Illuminate\Database\Eloquent\Collection $mandatories
 * @package App\Models\Base
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\Member newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\Member newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\Member query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\Member whereBirthDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\Member whereCpf($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\Member whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\Member whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\Member whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\Member wherePhone($value)
 * @mixin \Eloquent
 */
class Member extends Eloquent
{
	public $timestamps = false;

	protected $dates = [
		'birth_date'
	];

	public function mandatories()
	{
		return $this->belongsToMany(\App\Models\Mandatory::class, 'member_mandatory')
					->withPivot('id', 'position_id');
	}
}
