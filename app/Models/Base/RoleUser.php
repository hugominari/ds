<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 04 Dec 2018 20:17:49 -0200.
 */

namespace App\Models\Base;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class RoleUser
 *
 * @property int $role_id
 * @property int $user_id
 * @property string $user_type
 * @property \App\Models\Role $role
 * @property \App\Models\User $user
 * @package App\Models\Base
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\RoleUser newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\RoleUser newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\RoleUser query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\RoleUser whereRoleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\RoleUser whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\RoleUser whereUserType($value)
 * @mixin \Eloquent
 */
class RoleUser extends Eloquent
{
	protected $table = 'role_user';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'role_id' => 'int',
		'user_id' => 'int'
	];

	public function role()
	{
		return $this->belongsTo(\App\Models\Role::class);
	}

	public function user()
	{
		return $this->belongsTo(\App\Models\User::class);
	}
}
