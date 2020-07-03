<?php

use App\Inherer;
use Illuminate\Mail\Mailable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
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

Route::get('/', 'PublicController@welcomePage')->name('public.index');
Route::get('/dataprotection', 'PublicController@dataProtection')->name('public.dataprotection');
Route::get('/tr/{lang}', 'PublicController@lang')->name('public.lang');

Route::get('lang/{locale}', 'LocalisationController@lang');
Route::get('/home/', ['as' => 'home', 'uses' => 'HomeController@dashboard']);

Auth::routes();

Route::group(['middleware' => 'auth'], function () {

    //Route::get('/', ['as'=>'home', 'uses'=>'HomeController@index']);

    //Route::resource('home', 'HomeController');

    Route::resource('asset', 'AssetController');

    Route::resource('user', 'UserController');

    Route::resource('liability', 'LiabilityController');

    Route::resource('inherer', 'InhererController');

    Route::resource('partner', 'PartnerController');

    Route::get('newuser', ['as' => 'user.new', 'uses' => 'UserController@newuser']);

    Route::get('newuser1', ['as' => 'user.new1', 'uses' => 'UserController@newuser1']);

    Route::get('newuser2', ['as' => 'user.new2', 'uses' => 'UserController@newuser2']);

    Route::get('newuser3', ['as' => 'user.new3', 'uses' => 'UserController@newuser3']);

    Route::post('asset/addcontract/{id}', ['as' => 'document.add', 'uses' => 'AssetController@addcontract']);

    Route::put('asset/changecontract/{id}', ['as' => 'document.change', 'uses' => 'AssetController@changecontract']);

    Route::put('currencyupdate', ['as' => 'currencyupdate', 'uses' => 'AdminController@currencyupdate']);

    Route::put('updatenewuser/{id}', ['as' => 'updatenewuser', 'uses' => 'UserController@updatenewuser']);

    Route::post('updatenewuser1/', ['as' => 'updatenewuser1', 'uses' => 'UserController@updatenewuser1']);

    Route::post('updatenewuser2/', ['as' => 'updatenewuser2', 'uses' => 'UserController@updatenewuser2']);

    Route::delete('asset/deletecontract/{id}', ['uses' => 'AssetController@deletecontract']);

    Route::delete('asset/deletephoto/{id}', ['uses' => 'AssetController@deletephoto']);

    Route::delete('partner/deletephoto/{id}', ['uses' => 'PartnerController@deletephoto']);

    Route::delete('asset/deletedocument/{id}', ['uses' => 'AssetController@deletedocument']);

    Route::delete('liability/deletecontract/{id}', ['uses' => 'LiabilityController@deletecontract']);

    Route::get('inherer/create', ['as' => 'inherer.add', 'uses' => 'InhererController@create']);

    Route::get('partner/create', ['as' => 'partner.add', 'uses' => 'PartnerController@create']);

    Route::get('admin/currency', ['as' => 'admin.currency', 'uses' => 'AdminController@currency']);

    Route::get('admin/dashboard', ['as' => 'admin.dashboard', 'uses' => 'AdminController@dashboard']);

    Route::get('inhererget/', ['as' => 'inherer.get', 'uses' => 'InhererController@get']);

    Route::get('inherergetdata/', ['as' => 'inherer.getdata', 'uses' => 'InhererController@getdata']);

    Route::put('updatepasscode/', ['as' => 'updatepasscode', 'uses' => 'InhererController@updatepasscode']);

    Route::get('/changepassword', ['as' => 'changepassword', 'uses' => 'HomeController@showChangePasswordForm']);

    Route::post('/changepassword', 'HomeController@changePassword')->name('changepassword.post');
});

// Route::get('scheduler', function () {
//  \Illuminate\Support\Facades\Artisan::call('schedule:run');
// });



// Route::get('/email', function () {


//  $data = [
//      'title' => 'Welcome to White.app',
//      'content' => 'er spannungsgeladene Mix aus stetiger Kommerzialisierung und Laisser-faire-Prinzip in unmittelbarer Nachbarschaft macht die steigende Attraktivität des Donaukanals aus. Als die Lokale wegen der Coronavirus-Krise noch geschlossen waren, gab es hier – bei deutlich höherer Abstandsdisziplin – spontane Treffen, Drinks und Musikboxen wurden selbst mitgebracht. Aber auch nach der Gastro-Öffnung bleiben bei schönem Wetter Kai-Mauer und Grünflächen nächtens gut besucht.

// Der mitunter daherwabernde olfaktorische Hinweis auf dringend erledigte Notdurften macht aber auch ein Problem offensichtlich: Am Donaukanal gibt es für die an warmen Tagen und Nächten mittlerweile große Menge an Besuchern viel zu wenige (öffentliche) Toiletten. Zwar können auch jene der Lokale besucht werden, doch nicht bei allen'
//  ];

//  Mail::send('email.test', $data, function ($message) {

//      $message->to('manuelmahlerhutter@gmail.com', 'Manuel')->subject('hallo');



//      return ('okay');

//      return view('welcome');
//  });
// });
