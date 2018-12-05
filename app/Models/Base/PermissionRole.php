<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 04 Dec 2018 20:17:48 -0200.
 */

namespace App\Models\Base;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class PermissionRole
 *
 * @property int $permission_id
 * @property int $role_id
 * @property \App\Models\Permission $permission
 * @property \App\Models\Role $role
 * @package App\Models\Base
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\PermissionRole newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\PermissionRole newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\PermissionRole query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\PermissionRole wherePermissionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\PermissionRole whereRoleId($value)
 * @mixin \Eloquent
 */
class PermissionRole extends Eloquent
{
	protected $table = 'permission_role';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'permission_id' => 'int',
		'role_id' => 'int'
	];

	public function permission()
	{
		return $this->belongsTo(\App\Models\Permission::class);
	}

	public function role()
	{
		return $this->belongsTo(\App\Models\Role::class);
	}
}
