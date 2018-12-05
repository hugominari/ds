<?php

namespace App\Models;

use App\Http\Controllers\DefaultController;
use Laratrust\Traits\LaratrustRoleTrait;

/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $username
 * @property string $password
 * @property \Illuminate\Support\Carbon|null $last_login
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Call[] $calls
 * @property-read string $image
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\History[] $histories
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Permission[] $permissions
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Role[] $roles
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereLastLogin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereUsername($value)
 * @mixin \Eloquent
 */
class User extends \App\Models\Base\User
{
	protected $hidden = [
		'password',
		'remember_token'
	];

	protected $fillable = [
		'name',
		'username',
		'password',
		'last_login',
		'remember_token'
	];
	
	/**
	 * Append some virtual columns at retrive
	 * @var array
	 */
	protected $appends = array(
		'image',
	);
	
	/**
	 * Function to set image append
	 * @return string
	 * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
	 */
	public function getImageAttribute()
	{
		$default = new DefaultController();
		return $default->getFile("public/users/{$this->id}", 'profile.jpg');
	}
    
    /**
     * Return a role of user
     * @return object
     */
    public function getRole()
    {
        $roleUser = RoleUser::query()->where('user_id','=', $this->id)->first();
        
        return (object)[
            'id' => !empty($roleUser) ? $roleUser->role->id : null,
            'name' => !empty($roleUser) ? $roleUser->role->display_name : null,
        ];
    }
    
    /**
     * @param null $permissionName
     *
     * @return bool
     */
    public function havePermission($permissionName = null)
    {
        $permission = Permission::whereName($permissionName)->first();
        
        if(!empty($permission))
        {
            $havePerm = PermissionUser::wherePermissionId($permission->id)
                ->where('user_id', $this->id)->first();
            
            return !empty($havePerm);
        }
    
        return false;
    }
	
}
