<?php

namespace App\Http\ViewComposers;

use App\Http\Controllers\Controller;
use App\Models\Provider;
use App\Models\Role;
use App\Models\Social;
use App\Models\TypeCall;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View as ViewTemplate;
use JavaScript;

class GlobalComposer extends Controller
{
    
    
    /**
     * @param View $view
     *
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function compose(View $view)
    {
        $route = request()->route();
        $action = !empty($route) ? $route->getActionName() : '';
        
        JavaScript::put([
            'isIndex'    => str_contains($action, '@index'),
             'baseUrl'    => url('/'),
             'basePublic' => str_replace('/public', '', url('/')) . '/storage/app/',
        ]);
        
        $socials = Social::all();
        $userLogged = new \stdClass();
        
        if (Auth::check()) {
            $user = Auth::user();
            
            //Set some informations from logged user
            
            $userLogged->user = $user;
            $userLogged->id = $user->id;
            $userLogged->username = $user->username;
            $userLogged->name = $user->name;
            $userLogged->lastLogin = !empty($user->last_login)
                ? $user->last_login->format('d/m/Y H:i:s') : '';
            $userLogged->image = $user->image;
            
            $role = (!empty($user) && !empty($user->roles)) ? $user->roles->first() : null;
    
            $typeAttendances = TypeCall::toSelect();
            
            //Set values to js
            JavaScript::put([
                'currentUser' => $user,
                'currentRole' => $role,
                'userId' => $user->id,
                'roleId' => !empty($role) ? $role->id : '',
            ]);
            
            $routeName = ($route) ? $route->getActionMethod() : null;
            
            //Disable all inputs on show methods
            if ($routeName == 'show') {
                JavaScript::put(
                    ['readOnly' => true,]
                );
            }
            
            if($routeName == 'edit')
            {
                JavaScript::put(
                    ['editing' => true,]
                );
            }
        }
        
        ViewTemplate::share(compact(['userLogged', 'socials', 'typeAttendances']));
    }
}