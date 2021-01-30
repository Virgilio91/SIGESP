<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' =>['auth']], function(){

      /* ACL - Níveis de Acesso e Permissões */
      Route::resource('roles','RoleController');
     Route::get('/users/perfil/show/{id}', 'UserController@profileShow')->name('perfil.show');
      Route::post('/users/actualizar-perfil', 'UserController@profileUpdate')->name('perfil.update');
      Route::get('/users/perfil', 'UserController@profile')->name('perfil');
      Route::resource('users','UserController');
    //   Route::get('/profile/{id}/show', 'ProfileController@show');
    //   Route::get('/profile/{id}/edit', 'ProfileController@edit');
    //   Route::resource('profile', 'ProfileController');

    /* rotas da Gestão de Espécies */ 
  
    Route::post('especies/upload', 'EspecieController@imageUpload')->name('especie.upload');
    Route::resource('especies','EspecieController');
    Route::resource('acs','AcController');
    Route::resource('reinos','ReinoController');
    Route::resource('filos', 'FiloController');
    Route::resource('classes', 'ClasseController');
    Route::resource('ordem', 'OrdemController');
    Route::resource('familia', 'FamiliaController');
    Route::resource('genero', 'GeneroController');
    Route::resource('subfilos', 'SubfiloController');
    Route::resource('superclasses', 'SuperclasseController');
    Route::resource('subclasses', 'SubclasseController');
    Route::resource('infraclasses', 'InfraclasseController');
    Route::resource('superordens', 'SuperordemController');
    Route::resource('infraordens', 'InfraordemController');

});
