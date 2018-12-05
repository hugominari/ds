<?php

namespace App\Models;

/**
 * App\Models\PermissionRole
 *
 * @property int $permission_id
 * @property int $role_id
 * @property-read \App\Models\Permission $permission
 * @property-read \App\Models\Role $role
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PermissionRole newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PermissionRole newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PermissionRole query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PermissionRole wherePermissionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PermissionRole whereRoleId($value)
 * @mixin \Eloquent
 */
class PermissionRole extends \App\Models\Base\PermissionRole
{

}
