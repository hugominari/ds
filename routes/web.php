<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Models\Position;
use App\Models\Website;

Auth::routes();

Route::namespace('Front')->group(
    function()
    {
        Route::get('/', 'IndexController@index')->name('index');
        Route::get('regimento-interno', 'IndexController@internalRules')->name(
            'internal.rules'
        );
        Route::get('historia', 'IndexController@history')->name('history');
        Route::get('convenios', 'AgreementsController@index')->name(
            'agreements'
        );
        Route::get('contato', 'ContactController@index')->name('contacts');
        Route::get('membros/diretoria', 'MembersController@index')->name(
            'members.directors'
        );
        Route::get('membros/conselho-fiscal', 'MembersController@fiscals')
            ->name('members.fiscals');
        Route::get('publicacoes', 'PostsController@index')->name('posts');
        Route::get('publicacao/{id}', 'PostsController@show')->name(
            'show.post'
        );
        Route::get('eventos', 'EventsController@index')->name('events');
        Route::get('eventos/{id}', 'EventsController@show')->name(
            'show.event'
        );
        Route::get('cultura-e-lazer', 'CultureController@index')->name(
            'cultures'
        );
    }
);

/*
 * Functions to ajax Frontend/Backend
 */
Route::group(
    ['prefix' => 'default'], function()
{
    Route::get('/get-address', 'DefaultController@getAddress')->name(
        'default.getAddress'
    );
    Route::get('/get-cities', 'DefaultController@getCities')->name(
        'default.get-cities'
    );
    Route::post('/upload-file', 'DefaultController@uploadFiles')->name(
        'default.uploadFile'
    );
    Route::post('/save-file', 'DefaultController@saveFiles')->name(
        'default.saveFile'
    );
    Route::delete('/delete-file', 'DefaultController@deleteFiles')->name(
        'default.deleteFile'
    );
    Route::get('/download-file/{filename}', 'DefaultController@downloadFiles')
        ->name('default.downloadFile');
    
    Route::post('/send-contact', 'Admin\ContactsController@store')
        ->name('send.contact');
}
);


/*
 * Admin Routes
 */
Route::group(
    ['middleware' => ['auth']], function()
{
    /*===========================================
     * Admin
     */
    Route::prefix('admin')->namespace('Admin')->group(
        function()
        {
            // Dashboard
            Route::get('/', 'DashboardController@index')->name('dashboard');
            
            //Basics
            Route::group(
                ['prefix' => 'basic'], function()
            {
                Route::match(
                    ['PUT', 'POST'], '/create', 'BasicController@create'
                )->name('basic.create');
                Route::post('/edit/{id}', 'BasicController@edit')->name(
                    'basic.edit'
                );
                Route::get('/list/{model}', 'BasicController@list')->name(
                    'basic.list'
                );
                Route::delete('/destroy/{id}', 'BasicController@destroy')->name(
                    'basic.destroy'
                );
                Route::get(
                    '/{model}', function($model)
                {
                    $types = null;
                    $valuesCorrects = ['websites', 'feeds', 'type_calls',
                                       'positions'];
                    
                    if ($model == 'websites') {
                        $types = Website::getTypes();
                    } elseif ($model == 'positions') {
                        $types = Position::getTypes();
                    }
                    
                    if (in_array($model, $valuesCorrects)) {
                        return view(
                            "admin.basic.{$model}", compact(['model', 'types'])
                        );
                    }
                    
                    abort(404);
                }
                );
            }
            );
            
            //News
            Route::group(
                ['prefix' => 'posts'], function()
            {
                Route::get('list', 'PostsController@list')->name('posts.list');
                Route::get('/', 'PostsController@index')->name('posts.index');
                Route::get('create', 'PostsController@create')->name(
                    'posts.create'
                );
                Route::get('{id}', 'PostsController@show')->name('posts.show');
                Route::get('/{id}/edit', 'PostsController@edit')->name(
                    'posts.edit'
                );
                Route::post('store', 'PostsController@store')->name(
                    'posts.store'
                );
                Route::match(['put', 'path'], '{id?}', 'PostsController@update')
                    ->name('posts.update');
                Route::delete('{id}', 'PostsController@destroy')->name(
                    'posts.destroy'
                );
            }
            );
            
            //Socials
            Route::group(
                ['prefix' => 'socials'], function()
            {
                Route::get('/list', 'SocialsController@list')->name(
                    'socials.list'
                );
                Route::get('/', 'SocialsController@index')->name(
                    'socials.index'
                );
                Route::get('create', 'SocialsController@create')->name(
                    'socials.create'
                );
                Route::get('{id}', 'SocialsController@show')->name(
                    'socials.show'
                );
                Route::get('/{id}/edit', 'SocialsController@edit')->name(
                    'socials.edit'
                );
                Route::post('store', 'SocialsController@store')->name(
                    'socials.store'
                );
                Route::match(
                    ['put', 'path'], '{id?}', 'SocialsController@update'
                )->name('socials.update');
                Route::delete('{id}', 'SocialsController@destroy')->name(
                    'socials.destroy'
                );
            }
            );
            
            //Users
            Route::group(
                ['prefix' => 'users'], function()
            {
                Route::any('/list', 'UsersController@list')->name('users.list');
                Route::get('/', 'UsersController@index')->name('users.index');
                Route::get('create', 'UsersController@create')->name(
                    'users.create'
                );
                Route::get('{id}', 'UsersController@show')->name('users.show');
                Route::get('{id}/edit', 'UsersController@edit')->name(
                    'users.edit'
                );
                Route::post('store', 'UsersController@store')->name(
                    'users.store'
                );
                Route::match(['put', 'path'], 'update/{id}', 'UsersController@update')
                    ->name('users.update');
                Route::delete('{id}', 'UsersController@destroy')->name(
                    'users.destroy'
                );
                
                //Customs
                Route::get('meu-perfil', 'UsersController@myProfile')->name(
                    'users.my-profile'
                );
                Route::post(
                    'resetar-senha', 'UsersController@sendResetPassword'
                )->name('users.resetPassword');
                Route::post('get-profiles', 'UsersController@getProfiles')
                    ->name('users.profiles');
                Route::post(
                    'load-permission-role', 'UsersController@loadPermissionRole'
                )->name('users.load-permissions');
            }
            );
    
            //News
            Route::group(
                ['prefix' => 'institutional'], function()
            {
                Route::get('/internal_rules', 'InstitutionalController@index_rules')->name('admin.internal-rules');
                Route::get('/history', 'InstitutionalController@index_history')->name('admin.history');
                
                Route::post('/internal_rules/save', 'InstitutionalController@saveRules')->name('rules.save');
                Route::post('/history/save', 'InstitutionalController@saveHistory')->name('history.save');
            }
            );
    
            //News
            Route::group(
                ['prefix' => 'contacts'], function()
            {
                Route::any('/list', 'ContactsController@list')->name('contacts.list');
                Route::get('/', 'ContactsController@index')->name('contacts.index');
                Route::get('{id}', 'ContactsController@show')->name('contacts.show');
            }
            );
            
            //Users Custom Routes
            Route::group(
                ['prefix' => 'members'], function()
            {
                Route::get('list/{status?}', 'MembersController@list')
                    ->name('members.list');
        
                Route::get('index', 'MembersController@index')->name(
                    'members.index'
                );
                Route::get('create', 'MembersController@create')->name(
                    'members.create'
                );
                Route::get('{id}', 'MembersController@show')->name(
                    'members.show'
                );
                Route::get('{id}/edit', 'MembersController@edit')->name(
                    'members.edit'
                );
        
                Route::post('store', 'MembersController@store')->name(
                    'members.store'
                );
                Route::match(
                    ['put', 'path'], '{id?}', 'MembersController@update'
                )->name('members.update');
                Route::delete('{id}', 'MembersController@destroy')->name(
                    'members.destroy'
                );
        
            }
            );
            
            //Users Custom Routes
            Route::group(
                ['prefix' => 'mandatory'], function()
            {
                Route::get('index', 'MandatoryController@index')->name(
                    'mandatory.index'
                );
                Route::get('create', 'MandatoryController@create')->name(
                    'mandatory.create'
                );
                Route::get('{id}', 'MandatoryController@show')->name(
                    'mandatory.show'
                );
                Route::get('{id}/edit', 'MandatoryController@edit')->name(
                    'mandatory.edit'
                );
                
                Route::post('store', 'MandatoryController@store')->name(
                    'mandatory.store'
                );
                Route::match(
                    ['put', 'path'], '{id?}', 'MandatoryController@update'
                )->name('mandatory.update');
                Route::delete('{id}', 'MandatoryController@destroy')->name(
                    'mandatory.destroy'
                );
                
                Route::get('list', 'MandatoryController@list')
                    ->name('mandatory.list');
            }
            );
    
            // Sites
            Route::group(
                ['prefix' => 'covenants'], function()
            {
                Route::get('list/{type?}', 'CovenantsController@list')->name(
                    'covenants.list'
                );
                
                Route::get('index/{type?}', 'CovenantsController@index')->name(
                    'covenants.index'
                );
                Route::get('create', 'CovenantsController@create')->name(
                    'covenants.create'
                );
                Route::get('{id}', 'CovenantsController@show')->name('covenants.show');
                Route::get('{id}/edit', 'CovenantsController@edit')->name(
                    'covenants.edit'
                );
        
                Route::post('store', 'CovenantsController@store')->name(
                    'covenants.store'
                );
                Route::match(['put', 'path'], '{id?}', 'CovenantsController@update')
                    ->name('covenants.update');
                Route::delete('{id}', 'CovenantsController@destroy')->name(
                    'covenants.destroy'
                );
        
            }
            );
    
            // Sites
            Route::group(
                ['prefix' => 'events'], function()
            {
                Route::get('list', 'EventsController@list')->name(
                    'events.list'
                );
        
                Route::get('index', 'EventsController@index')->name(
                    'events.index'
                );
                Route::get('create', 'EventsController@create')->name(
                    'events.create'
                );
                Route::get('{id}', 'EventsController@show')->name('events.show');
                Route::get('{id}/edit', 'EventsController@edit')->name(
                    'events.edit'
                );
        
                Route::post('store', 'EventsController@store')->name(
                    'events.store'
                );
                Route::match(['put', 'path'], '{id?}', 'EventsController@update')
                    ->name('events.update');
                Route::delete('{id}', 'EventsController@destroy')->name(
                    'events.destroy'
                );
        
            }
            );
    
            // Sites
            Route::group(
                ['prefix' => 'cultures'], function()
            {
                Route::get('list', 'EventsController@list')->name(
                    'cultures.list'
                );
        
                Route::get('index', 'EventsController@index')->name(
                    'cultures.index'
                );
                Route::get('create', 'EventsController@create')->name(
                    'cultures.create'
                );
                Route::get('{id}', 'EventsController@show')->name('cultures.show');
                Route::get('{id}/edit', 'EventsController@edit')->name(
                    'cultures.edit'
                );
        
                Route::post('store', 'EventsController@store')->name(
                    'cultures.store'
                );
                Route::match(['put', 'path'], '{id?}', 'EventsController@update')
                    ->name('cultures.update');
                Route::delete('{id}', 'EventsController@destroy')->name(
                    'cultures.destroy'
                );
        
            }
            );
    
            // Sites
            Route::group(
                ['prefix' => 'attendance'], function()
            {
                Route::get('list', 'AttendanceController@list')->name(
                    'attendance.list'
                );
        
                Route::get('index', 'AttendanceController@index')->name(
                    'attendance.index'
                );

                Route::get('{id}', 'AttendanceController@show')->name('attendance.show');

        
                Route::post('store', 'AttendanceController@store')->name(
                    'attendance.store'
                );

                Route::delete('{id}', 'AttendanceController@destroy')->name(
                    'attendance.destroy'
                );
            }
            );
        }
    );
}
);