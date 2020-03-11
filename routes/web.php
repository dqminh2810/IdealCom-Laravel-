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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;


Route::view('/', 'welcome');
Route::get('/home', 'HomeController@index')->name('home');

// Module Formulaires : routes pour enregistrer les données
Route::post('formbuilder', '\Modules\Formulaires\Http\Controllers\AnswersController@store_front')->name('formbuilder.store_front');
Route::put('formbuilder/{answer}', '\Modules\Formulaires\Http\Controllers\AnswersController@update_front')->name('formbuilder.update_front');

Auth::routes();
// Module Users (Auth)
Route::get('admin/login','\Modules\Users\Http\Controllers\AuthController@showLoginForm')->name('admin.login')->middleware(['theme:metronic','guest']);
Route::post('admin/login','\Modules\Users\Http\Controllers\AuthController@login')->name('admin.login.check')->middleware(['theme:metronic','guest']);

Route::prefix(LaravelLocalization::setLocale())
    ->middleware([ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ])
    ->group(function(){


    Route::prefix('admin/')
	    ->middleware(['auth','permission:admin-dashboard','actif','theme:metronic'])
	    ->group(function () {


            //Route::get('{locale}','\Modules\Languages\Http\Controllers\LanguagesController@index');
            Route::view('/', 'metronic::admin.dashboard')->name('admin.dashboard');
            Route::view('dashboard', 'metronic::admin.dashboard')->name('admin.dashboard');

            // Logout
            Route::get('logout', function (){
                Auth::logout();
                return Redirect::route('admin.login');
            })->name('admin.logout');


            // Modules
            Route::resource('news', '\Modules\News\Http\Controllers\NewsController')->middleware('permission:admin-news');
            Route::resource('users', '\Modules\Users\Http\Controllers\UsersController')->middleware('permission:admin-users');
            Route::resource('modules', '\Modules\Core\Http\Controllers\ModulesController')->middleware('permission:admin-modules');
            Route::resource('roles', '\Modules\Roles\Http\Controllers\RolesController')->middleware('permission:admin-roles');
            Route::resource('permissions', '\Modules\Roles\Http\Controllers\PermissionsController')->middleware('permission:admin-permissions');
            Route::resource('pages', '\Modules\Pages\Http\Controllers\PagesController')->middleware('permission:admin-pages');
            Route::resource('documents', '\Modules\Medias\Http\Controllers\DocumentsController')->middleware('permission:admin-medias-documents');
            Route::resource('photos', '\Modules\Medias\Http\Controllers\PhotosController')->middleware('permission:admin-medias-photos');
            Route::resource('videos', '\Modules\Medias\Http\Controllers\VideosController')->middleware('permission:admin-medias-videos');
            Route::resource('cookies', '\Modules\Cookies\Http\Controllers\CookiesController')->middleware('permission:admin-cookies');
            Route::resource('formulaires', '\Modules\Formulaires\Http\Controllers\FormulairesController')->middleware('permission:admin-formulaires');
            Route::resource('domains', '\Modules\Domains\Http\Controllers\DomainsController')->middleware('permission:admin-domains');
            Route::resource('countries', '\Modules\Countries\Http\Controllers\CountriesController')->middleware('permission:admin-countries');
            Route::resource('agences', '\Modules\Agences\Http\Controllers\AgencesController')->middleware('permission:admin-agences');
            Route::resource('menus', '\Modules\Menus\Http\Controllers\MenusController')->middleware('permission:admin-menus');
            Route::resource('languages', '\Modules\Languages\Http\Controllers\LanguagesController')->middleware('permission:admin-languages');
            Route::resource('subscribers', '\Modules\Subscribers\Http\Controllers\SubscribersController');
            Route::resource('groups', '\Modules\Subscribers\Http\Controllers\GroupsController');

			Route::get('profils','\Modules\Users\Http\Controllers\ProfilsController@index')->name('profils.index');
			Route::put('profils/{user}','\Modules\Users\Http\Controllers\ProfilsController@update')->name('profils.update');



			// Module Formulaires : Fields
            Route::get('fields/{formulaire}','\Modules\Formulaires\Http\Controllers\FieldsController@show')->middleware('permission:admin-fields')->name('fields.show');
            Route::get('fields/create/{formulaire}','\Modules\Formulaires\Http\Controllers\FieldsController@create')->middleware('permission:admin-fields')->name('fields.create');
            Route::post('fields','\Modules\Formulaires\Http\Controllers\FieldsController@store')->middleware('permission:admin-fields')->name('fields.store');
            Route::get('fields/{field}/edit','\Modules\Formulaires\Http\Controllers\FieldsController@edit')->middleware('permission:admin-fields')->name('fields.edit');
            Route::put('fields/{field}','\Modules\Formulaires\Http\Controllers\FieldsController@update')->middleware('permission:admin-fields')->name('fields.update');
            Route::patch('fields/{field}','\Modules\Formulaires\Http\Controllers\FieldsController@update')->middleware('permission:admin-fields')->name('fields.update');
            Route::delete('fields/{field}','\Modules\Formulaires\Http\Controllers\FieldsController@destroy')->middleware('permission:admin-fields')->name('fields.delete');
            Route::put('fields/{field}/position/{position}','\Modules\Formulaires\Http\Controllers\FieldsController@updatePosition')->middleware('permission:admin-fields')->name('fields.update.position');

            // Module Formulaires : Choices
            Route::get('choices/{field}','\Modules\Formulaires\Http\Controllers\ChoicesController@show')->middleware('permission:admin-fields')->name('choices.show');
            Route::get('choices/create/{field}','\Modules\Formulaires\Http\Controllers\ChoicesController@create')->middleware('permission:admin-fields')->name('choices.create');
            Route::post('choices','\Modules\Formulaires\Http\Controllers\ChoicesController@store')->middleware('permission:admin-fields')->name('choices.store');
            Route::get('choices/{choice}/edit','\Modules\Formulaires\Http\Controllers\ChoicesController@edit')->middleware('permission:admin-fields')->name('choices.edit');
            Route::put('choices/{choice}','\Modules\Formulaires\Http\Controllers\ChoicesController@update')->middleware('permission:admin-fields')->name('choices.update');
            Route::patch('choices/{choice}','\Modules\Formulaires\Http\Controllers\ChoicesController@update')->middleware('permission:admin-fields')->name('choices.update');
            Route::delete('choices/{choice}','\Modules\Formulaires\Http\Controllers\ChoicesController@destroy')->middleware('permission:admin-fields')->name('choices.delete');

            // Module Formulaires : Answers
            Route::get('answers/{formulaire}','\Modules\Formulaires\Http\Controllers\AnswersController@show')->middleware('permission:admin-answers')->name('answers.show');
            Route::get('answers/create/{formulaire}','\Modules\Formulaires\Http\Controllers\AnswersController@create')->middleware('permission:admin-answers')->name('answers.create');
            Route::post('answers','\Modules\Formulaires\Http\Controllers\AnswersController@store')->middleware('permission:admin-answers')->name('answers.store');
            Route::get('answers/{answer}/edit','\Modules\Formulaires\Http\Controllers\AnswersController@edit')->middleware('permission:admin-answers')->name('answers.edit');
            Route::put('answers/{answer}','\Modules\Formulaires\Http\Controllers\AnswersController@update')->middleware('permission:admin-answers')->name('answers.update');
            Route::patch('answers/{answer}','\Modules\Formulaires\Http\Controllers\AnswersController@update')->middleware('permission:admin-answers')->name('answers.update');
            Route::delete('answers/{answer}','\Modules\Formulaires\Http\Controllers\AnswersController@destroy')->middleware('permission:admin-answers')->name('answers.delete');

            // Module Agence : Domains
            Route::post('agences/domains/{agence}','\Modules\Agences\Http\Controllers\AgencesController@addDomain')->middleware('permission:admin-agences')->name('agences.domains.add');
            Route::delete('agences/domains/{agence}/{domain}','\Modules\Agences\Http\Controllers\AgencesController@removeDomain')->middleware('permission:admin-agences')->name('agences.domains.remove');

            // Module Menus : MenuItems
            Route::get('menuitems/{menu}','\Modules\Menus\Http\Controllers\MenuItemsController@show')->middleware('permission:admin-menuitems')->name('menuitems.show');
            Route::get('menuitems/create/{menu}/{menuitems}','\Modules\Menus\Http\Controllers\MenuItemsController@create')->middleware('permission:admin-menuitems')->name('menuitems.create');
            Route::post('menuitems','\Modules\Menus\Http\Controllers\MenuItemsController@store')->middleware('permission:admin-menuitems')->name('menuitems.store');
            Route::get('menuitems/{menuitem}/edit','\Modules\Menus\Http\Controllers\MenuItemsController@edit')->middleware('permission:admin-menuitems')->name('menuitems.edit');
            Route::put('menuitems/{menuitem}','\Modules\Menus\Http\Controllers\MenuItemsController@update')->middleware('permission:admin-menuitems')->name('menuitems.update');
            Route::patch('menuitems/{menuitem}','\Modules\Menus\Http\Controllers\MenuItemsController@update')->middleware('permission:admin-menuitems')->name('menuitems.update');
            Route::delete('menuitems/{menuitem}','\Modules\Menus\Http\Controllers\MenuItemsController@destroy')->middleware('permission:admin-menuitems')->name('menuitems.delete');
            //Route::put('menuitems/{field}/position/{position}','\Modules\Menus\Http\Controllers\MenuItemsController@updatePosition')->middleware('permission:admin-menuitems')->name('menuitems.update.position');

            // Module Subscribers : Groups
            Route::post('subscribers/groups/{subscriber}','\Modules\Subscribers\Http\Controllers\SubscribersController@addGroup')->middleware('permission:admin-subscribers')->name('subscribers.groups.add');
            Route::delete('subscribers/groups/{group}/{subscriber}','\Modules\Subscribers\Http\Controllers\SubscribersController@removeGroup')->middleware('permission:admin-subscribers')->name('subscribers.groups.remove');

            Route::put('users/{user}/enable', '\Modules\Users\Http\Controllers\UsersController@enable')->name('users.enable')->middleware('permission:admin-users');
            Route::put('users/{user}/disable', '\Modules\Users\Http\Controllers\UsersController@disable')->name('users.disable')->middleware('permission:admin-users');

            Route::put('news/{news}/enable', '\Modules\News\Http\Controllers\NewsController@enable')->name('news.enable')->middleware('permission:admin-news');
            Route::put('news/{news}/disable', '\Modules\News\Http\Controllers\NewsController@disable')->name('news.disable')->middleware('permission:admin-news');

            Route::put('modules/{string}/enable', '\Modules\Core\Http\Controllers\ModulesController@enable')->name('modules.enable')->middleware('permission:admin-modules');
            Route::put('modules/{string}/disable', '\Modules\Core\Http\Controllers\ModulesController@disable')->name('modules.disable')->middleware('permission:admin-modules');

            Route::put('roles/{role}/enable', '\Modules\Roles\Http\Controllers\RolesController@enable')->name('roles.enable')->middleware('permission:admin-roles');
            Route::put('roles/{role}/disable', '\Modules\Roles\Http\Controllers\RolesController@disable')->name('roles.disable')->middleware('permission:admin-roles');

            Route::put('permissions/{permission}/enable', '\Modules\Roles\Http\Controllers\PermissionsController@enable')->name('permissions.enable')->middleware('permission:admin-permissions');
            Route::put('permissions/{permission}/disable', '\Modules\Roles\Http\Controllers\PermissionsController@disable')->name('permissions.disable')->middleware('permission:admin-permissions');

            Route::put('pages/{page}/enable', '\Modules\Pages\Http\Controllers\PagesController@enable')->name('pages.enable')->middleware('permission:admin-pages');
            Route::put('pages/{page}/disable', '\Modules\Pages\Http\Controllers\PagesController@disable')->name('pages.disable')->middleware('permission:admin-pages');

            Route::put('documents/{document}/enable', '\Modules\Medias\Http\Controllers\DocumentsController@enable')->name('documents.enable')->middleware('permission:admin-medias-documents');
            Route::put('documents/{document}/disable', '\Modules\Medias\Http\Controllers\DocumentsController@disable')->name('documents.disable')->middleware('permission:admin-medias-documents');

            Route::put('photos/{photo}/enable', '\Modules\Medias\Http\Controllers\PhotosController@enable')->name('photos.enable')->middleware('permission:admin-medias-photos');
            Route::put('photos/{photo}/disable', '\Modules\Medias\Http\Controllers\PhotosController@disable')->name('photos.disable')->middleware('permission:admin-medias-photos');
            Route::post('reload/photos','\Modules\Medias\Http\Controllers\PhotosController@loadAllImg')->name('photos.reload')->middleware('permission:admin-medias-photos');

            Route::put('videos/{video}/enable', '\Modules\Medias\Http\Controllers\VideosController@enable')->name('videos.enable')->middleware('permission:admin-medias-videos');
            Route::put('videos/{video}/disable', '\Modules\Medias\Http\Controllers\VideosController@disable')->name('videos.disable')->middleware('permission:admin-medias-videos');

            Route::put('cookies/{cookie}/enable', '\Modules\Cookies\Http\Controllers\CookiesController@enable')->name('cookies.enable')->middleware('permission:admin-cookies');
            Route::put('cookies/{cookie}/disable', '\Modules\Cookies\Http\Controllers\CookiesController@disable')->name('cookies.disable')->middleware('permission:admin-cookies');

            Route::put('formulaires/{formulaire}/enable', '\Modules\Formulaires\Http\Controllers\FormulairesController@enable')->name('formulaires.enable')->middleware('permission:admin-formulaires');
            Route::put('formulaires/{formulaire}/disable', '\Modules\Formulaires\Http\Controllers\FormulairesController@disable')->name('formulaires.disable')->middleware('permission:admin-formulaires');

            Route::put('fields/{field}/enable', '\Modules\Formulaires\Http\Controllers\FieldsController@enable')->name('fields.enable')->middleware('permission:admin-fields');
            Route::put('fields/{field}/disable', '\Modules\Formulaires\Http\Controllers\FieldsController@disable')->name('fields.disable')->middleware('permission:admin-fields');

            Route::put('fields/{field}/backoffice', '\Modules\Formulaires\Http\Controllers\FieldsController@backoffice')->name('fields.backoffice')->middleware('permission:admin-fields');
            Route::put('fields/{field}/frontoffice', '\Modules\Formulaires\Http\Controllers\FieldsController@frontoffice')->name('fields.frontoffice')->middleware('permission:admin-fields');

            Route::put('choices/{choice}/enable', '\Modules\Formulaires\Http\Controllers\ChoicesController@enable')->name('choices.enable')->middleware('permission:admin-fields');
            Route::put('choices/{choice}/disable', '\Modules\Formulaires\Http\Controllers\ChoicesController@disable')->name('choices.disable')->middleware('permission:admin-fields');

            Route::put('choices/{choice}/select', '\Modules\Formulaires\Http\Controllers\ChoicesController@select')->name('choices.select')->middleware('permission:admin-fields');
            Route::put('choices/{choice}/unselect', '\Modules\Formulaires\Http\Controllers\ChoicesController@unselect')->name('choices.unselect')->middleware('permission:admin-fields');

            Route::put('answers/{answer}/handled', '\Modules\Formulaires\Http\Controllers\AnswersController@handled')->name('answers.handled')->middleware('permission:admin-answers');
            Route::put('answers/{answer}/nohandled', '\Modules\Formulaires\Http\Controllers\AnswersController@noHandled')->name('answers.nohandled')->middleware('permission:admin-answers');
            Route::get('answers/{answer}/detail', '\Modules\Formulaires\Http\Controllers\AnswersController@detail')->name('answers.detail')->middleware('permission:admin-answers');


            Route::put('domains/{domain}/enable', '\Modules\Domains\Http\Controllers\DomainsController@enable')->name('domains.enable')->middleware('permission:admin-domains');
            Route::put('domains/{domain}/disable', '\Modules\Domains\Http\Controllers\DomainsController@disable')->name('domains.disable')->middleware('permission:admin-domains');

            Route::put('countries/{country}/enable', '\Modules\Countries\Http\Controllers\CountriesController@enable')->name('countries.enable')->middleware('permission:admin-countries');
            Route::put('countries/{country}/disable', '\Modules\Countries\Http\Controllers\CountriesController@disable')->name('countries.disable')->middleware('permission:admin-countries');

            Route::put('agences/{agence}/enable', '\Modules\Agences\Http\Controllers\AgencesController@enable')->name('agences.enable')->middleware('permission:admin-agences');
            Route::put('agences/{agence}/disable', '\Modules\Agences\Http\Controllers\AgencesController@disable')->name('agences.disable')->middleware('permission:admin-agences');

            Route::put('menus/{menu}/enable', '\Modules\Menus\Http\Controllers\MenusController@enable')->name('menus.enable')->middleware('permission:admin-menus');
            Route::put('menus/{menu}/disable', '\Modules\Menus\Http\Controllers\MenusController@disable')->name('menus.disable')->middleware('permission:admin-menus');

            Route::put('languages/{language}/enable', '\Modules\Languages\Http\Controllers\LanguagesController@enable')->name('languages.enable')->middleware('permission:admin-languages');
            Route::put('languages/{language}/disable', '\Modules\Languages\Http\Controllers\LanguagesController@disable')->name('languages.disable')->middleware('permission:admin-languages');

            Route::put('subscribers/{subscriber}/enable', '\Modules\Subscribers\Http\Controllers\SubscribersController@enable')->name('subscribers.enable');
            Route::put('subscribers/{subscriber}/disable', '\Modules\Subscribers\Http\Controllers\SubscribersController@disable')->name('subscribers.disable');

            Route::put('groups/{group}/enable', '\Modules\Subscribers\Http\Controllers\GroupsController@enable')->name('groups.enable');
            Route::put('groups/{group}/disable', '\Modules\Subscribers\Http\Controllers\GroupsController@disable')->name('groups.disable');



            // DataTables
            Route::get('datatables/news','\Modules\News\Http\Controllers\NewsController@getBasicData')->name('datatables.news')->middleware('permission:admin-news');
            Route::get('datatables/users','\Modules\Users\Http\Controllers\UsersController@getBasicData')->name('datatables.users')->middleware('permission:admin-users');
            Route::get('datatables/roles','\Modules\Roles\Http\Controllers\RolesController@getBasicData')->name('datatables.roles')->middleware('permission:admin-roles');
            Route::get('datatables/permissions','\Modules\Roles\Http\Controllers\PermissionsController@getBasicData')->name('datatables.permissions')->middleware('permission:admin-permissions');
            Route::get('datatables/pages','\Modules\Pages\Http\Controllers\PagesController@getBasicData')->name('datatables.pages')->middleware('permission:admin-pages');
            Route::get('datatables/documents','\Modules\Medias\Http\Controllers\DocumentsController@getBasicData')->name('datatables.documents')->middleware('permission:admin-medias-documents');
            Route::get('datatables/photos','\Modules\Medias\Http\Controllers\PhotosController@getBasicData')->name('datatables.photos')->middleware('permission:admin-medias-photos');
            Route::get('datatables/videos','\Modules\Medias\Http\Controllers\VideosController@getBasicData')->name('datatables.videos')->middleware('permission:admin-medias-videos');
            Route::get('datatables/cookies','\Modules\Cookies\Http\Controllers\CookiesController@getBasicData')->name('datatables.cookies')->middleware('permission:admin-cookies');
            Route::get('datatables/formulaires','\Modules\Formulaires\Http\Controllers\FormulairesController@getBasicData')->name('datatables.formulaires')->middleware('permission:admin-formulaires');
            Route::get('datatables/fields/{formulaire}','\Modules\Formulaires\Http\Controllers\FieldsController@getBasicData')->name('datatables.fields')->middleware('permission:admin-fields');
            Route::get('datatables/choices/{field}','\Modules\Formulaires\Http\Controllers\ChoicesController@getBasicData')->name('datatables.choices')->middleware('permission:admin-fields');
            Route::get('datatables/answers/{formulaire}','\Modules\Formulaires\Http\Controllers\AnswersController@getBasicData')->name('datatables.answers')->middleware('permission:admin-answers');
            Route::get('datatables/answers/nothandled/{formulaire}','\Modules\Formulaires\Http\Controllers\AnswersController@getDataNotHandled')->name('datatables.answers.nothandled')->middleware('permission:admin-answers');
            Route::get('datatables/domains','\Modules\Domains\Http\Controllers\DomainsController@getBasicData')->name('datatables.domains')->middleware('permission:admin-domains');
            Route::get('datatables/countries','\Modules\Countries\Http\Controllers\CountriesController@getBasicData')->name('datatables.countries')->middleware('permission:admin-countries');
            Route::get('datatables/agences','\Modules\Agences\Http\Controllers\AgencesController@getBasicData')->name('datatables.agences')->middleware('permission:admin-agences');
            Route::get('datatables/domains/agences/{agence}','\Modules\Domains\Http\Controllers\DomainsController@getDatatableAgence')->name('datatables.domains.agences')->middleware('permission:admin-agences');
            Route::get('datatables/menus','\Modules\Menus\Http\Controllers\MenusController@getBasicData')->name('datatables.menus')->middleware('permission:admin-menus');
            Route::get('datatables/languages','\Modules\Languages\Http\Controllers\LanguagesController@getBasicData')->name('datatables.languages')->middleware('permission:admin-languages');
            Route::get('datatables/subscribers','\Modules\Subscribers\Http\Controllers\SubscribersController@getBasicData')->name('datatables.subscribers');
            Route::get('datatables/groups','\Modules\Subscribers\Http\Controllers\GroupsController@getBasicData')->name('datatables.groups');
            Route::get('datatables/groups/subscribers/{subscriber}','\Modules\Subscribers\Http\Controllers\GroupsController@getDatatableSubscriber')->name('datatables.groups.subscribers')->middleware('permission:admin-subscribers');
            Route::get('datatables/menuitems/{menu}','\Modules\Menus\Http\Controllers\MenuItemsController@getBasicData')->name('datatables.menuitems')->middleware('permission:admin-menuitems');


        });
    });

