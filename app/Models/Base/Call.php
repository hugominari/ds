<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 04 Dec 2018 20:17:48 -0200.
 */

namespace App\Models\Base;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Call
 *
 * @property int $id
 * @property int $type_call_id
 * @property int $user_id
 * @property string $name
 * @property string $cpf
 * @property string $description
 * @property int $status
 * @property \Carbon\Carbon $date
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \App\Models\TypeCall $type_call
 * @property \App\Models\User $user
 * @package App\Models\Base
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\Call newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\Call newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\Call query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\Call whereCpf($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\Call whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\Call whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\Call whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\Call whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\Call whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\Call whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\Call whereTypeCallId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\Call whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\Call whereUserId($value)
 * @mixin \Eloquent
 */
class Call extends Eloquent
{
	protected $casts = [
		'type_call_id' => 'int',
		'user_id' => 'int',
		'status' => 'int'
	];

	protected $dates = [
		'date'
	];

	public function type_call()
	{
		return $this->belongsTo(\App\Models\TypeCall::class);
	}

	public function user()
	{
		return $this->belongsTo(\App\Models\User::class);
	}
}
