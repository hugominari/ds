<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 04 Dec 2018 20:17:48 -0200.
 */

namespace App\Models\Base;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class PermissionUser
 *
 * @property int $permission_id
 * @property int $user_id
 * @property string $user_type
 * @property \App\Models\Permission $permission
 * @property \App\Models\User $user
 * @package App\Models\Base
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\PermissionUser newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\PermissionUser newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\PermissionUser query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\PermissionUser wherePermissionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\PermissionUser whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\PermissionUser whereUserType($value)
 * @mixin \Eloquent
 */
class PermissionUser extends Eloquent
{
	protected $table = 'permission_user';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'permission_id' => 'int',
		'user_id' => 'int'
	];

	public function permission()
	{
		return $this->belongsTo(\App\Models\Permission::class);
	}

	public function user()
	{
		return $this->belongsTo(\App\Models\User::class);
	}
}
