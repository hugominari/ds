<?php

namespace App\Models;

/**
 * App\Models\PermissionUser
 *
 * @property int $permission_id
 * @property int $user_id
 * @property string $user_type
 * @property-read \App\Models\Permission $permission
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PermissionUser newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PermissionUser newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PermissionUser query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PermissionUser wherePermissionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PermissionUser whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PermissionUser whereUserType($value)
 * @mixin \Eloquent
 */
class PermissionUser extends \App\Models\Base\PermissionUser
{

}
