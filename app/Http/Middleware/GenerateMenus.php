<?php

namespace App\Http\Middleware;

use App\User;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class GenerateMenus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
    	$permissionsUser = [];
    	
    	if(Auth::check())
    	{
		    $id = Auth::user()->id;
		    $user = User::whereId($id)
			    ->with(['permissions' => function($q) use($id){
				    $q->select('permissions.name')
					    ->where('user_id', '=', $id);
			    }])
			    ->first();
		
		    foreach($user->permissions as $item)
		    {
		        array_push($permissionsUser, $item['name']);
		    }
		    
		    // dd($permissionsUser);
	    }
	    
	    \Menu::make('MyNavBar', function($menu)
	    {
		    //Dashboard
		    $menu
			    ->add('Dashboard', ['route' => 'dashboard', 'class' => 'treeview'])
			    ->prepend('<i class="fa fa-dashboard"></i><span>')
			    ->append('</span><span class="pull-right-container"> </span>');
		    //User
		    $menu
			    ->add('Usuarios', ['url' => 'javascript:;', 'class' => 'treeview'])
			    ->prepend('<i class="fa fa-user"></i><span>')
			    ->append('</span><span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span>')
			    ->data('permission', ['visualizar-usuario','cadastrar-usuario','deletar-usuario']);
		
		    $menu->usuarios
			    ->add('Ver todos', ['route' => 'users.index'])
			    ->append('<span class="pull-right-container"></span>')
			    ->data('permission', 'visualizar-usuario');
		
		    $menu->usuarios
			    ->add('Deletados', ['route' => ['users.index', 'status' => 'deleted']])
			    ->append('<span class="pull-right-container"></span>')
			    ->data('permission', 'visualizar-usuario');
		
		    $menu->usuarios
			    ->add('Novo', ['route' => 'users.create'])
			    ->append('<span class="pull-right-container"></span>')
			    ->data('permission', 'cadastrar-usuario');
		    
		    // // Logs
		    // $menu
			 //    ->add('Logs', ['route' => 'admin.logs'])
			 //    ->prepend('<i class="fa fa-exclamation-triangle"></i><span>')
			 //    ->append('</span><span class="pull-right-container"></span>')
			 //    ->data('permission', 'manter-log');
		
	    })->filter(function($item) use($permissionsUser)
	    {
		    //Set variables
		    $permission = $item->data('permission');
		    
		    //
		    if(!empty($permission))
		    {
				if(is_array($permission))
				{
					if(array_intersect($permission, $permissionsUser))
						return true;
				}
				else
				{
					if(in_array($permission, $permissionsUser))
						return true;
				}
				
			    if(in_array($permission, $permissionsUser))
			        return true;
			    
			    return false;
		    }
		    
		    return true;
		    
	    });
	    
	    return $next($request);
    }
}
