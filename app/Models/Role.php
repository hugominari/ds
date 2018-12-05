<?php

namespace App\Models;

/**
 * App\Models\Role
 *
 * @property int $id
 * @property string $name
 * @property string $display_name
 * @property string|null $description
 * @property mixed|null $created_at
 * @property mixed|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Permission[] $permissions
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $users
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Role newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Role newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Role query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Role whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Role whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Role whereDisplayName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Role whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Role whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Role whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Role extends \App\Models\Base\Role
{
	protected $fillable = [
		'name',
		'display_name',
		'description'
	];
	
	protected $casts = [
		'created_at' => 'datetime:d/m/Y H:i:s',
		'updated_at' => 'datetime:d/m/Y H:i:s',
	];
	
	const ROLE_ROOT                 =  1;
	const ROLE_ROOT_TXT             =  'root';

	const ROLE_ADMIN                =  2;
	const ROLE_ADMIN_TXT            =  'administrador';

	const ROLE_USER                 =  3;
	const ROLE_USER_TXT             =  'usuario';
}
