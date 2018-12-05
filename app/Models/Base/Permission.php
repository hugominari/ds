<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 04 Dec 2018 20:17:48 -0200.
 */

namespace App\Models\Base;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Permission
 *
 * @property int $id
 * @property string $name
 * @property string $display_name
 * @property string $description
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Illuminate\Database\Eloquent\Collection $roles
 * @property \Illuminate\Database\Eloquent\Collection $users
 * @package App\Models\Base
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\Permission newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\Permission newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\Permission query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\Permission whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\Permission whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\Permission whereDisplayName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\Permission whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\Permission whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Base\Permission whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Permission extends Eloquent
{
	public function roles()
	{
		return $this->belongsToMany(\App\Models\Role::class);
	}

	public function users()
	{
		return $this->belongsToMany(\App\Models\User::class)
					->withPivot('user_type');
	}
}
