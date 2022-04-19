<?php

use App\Http\Livewire;

//use App\Http\Livewire\Admin\Main;
//use App\Http\Livewire\Admin\users;
use App\Models\AuthLogs;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
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

Route::get('/admin', function () {
    $media = \App\Models\Passports::first()->addMedia(asset('storage'))->toMediaCollection();
    dd($media);
//    $addressType = \App\Models\AddressType::create([
//        'name' => 'Address -1 type'
//    ]);
//
//    $addressType->logs()->create([
//        'log_type_id'=>3,
//        'guard_id'=>1,
//        'auth_id'=>2,
//    ]);
//    $a = \App\Models\Divisions::find(1);
//    dd($a->addresses());

    $passport = new \App\Models\Passports();


    $passport->user_id = '1';
    $passport->passport_number = "F12312312";
    $passport->given_name = "Amir";
    $passport->sur_name = "Hussain";
    $passport->date_of_birth = "2021/12/14";
    $passport->issue_date = "2022/01/03";
    $passport->expiry_date = "2022/02/22";
    $passport->countries_id = "246";
    $passport->regions_id = "1013";
    $passport->file = "1013";
    $passport->save();


//    $a->addresses()->create([
//
//        'address_type_id' => 1,
//        'address_line1' => 'fsdfsdf',
//        'address_line2' => 'gfdgregdsfg',
//        'postal_code' => 1234,
//        'zip_code' => 1234,
//        'countries_id' => 8,
//        'regions_id' => 36,
//        'created_at' => \Carbon\Carbon::now(),
//        'updated_at' => \Carbon\Carbon::now(),
//    ]);
//    dd($a->logs);
    return view('welcome');
});

//Auth::routes();


Route::group([

], function () {
    Route::group([
        'middleware' => ['checkguard', 'auth:admin', 'twofactor', 'role:Super Admin|Admin', 'XssSanitizer'],
//        'namespace'=>'\App\Http\Livewire\Admin',

    ], function () {
//        Route::get('/admin', Main::class)->name('admin.main');
//        Route::get('/admin/main', Main::class)->name('admin.main');
//        Route::get('/admin/error-forbidden', ErrorForbidden::class)->name('admin.error-forbidden');
        Route::get('/admin/dashboard', Livewire\Admin\Dashboard::class)->name('admin.dashboard');
        Route::get('/admin/admins', Livewire\Admin\Admins::class)->name('admin.admins');
        Route::get('/admin/users', Livewire\Admin\Users::class)->name('admin.users');
        Route::get('/admin/roles', Livewire\Admin\Roles::class)->name('admin.roles');
        Route::get('/admin/permissions', Livewire\Admin\Permissions::class)->name('admin.permissions');
        Route::get('/admin/profile', Livewire\Admin\Profile::class)->name('admin.profile');
        Route::get('/admin/countries', Livewire\Admin\Countries::class)->name('admin.countries');
        Route::get('/admin/regions', Livewire\Admin\Regions::class)->name('admin.regions');
        Route::get('/admin/companies', Livewire\Admin\Companies::class)->name('admin.companies');
        Route::get('/admin/models',Livewire\Admin\Models::class)->name('admin.models');
        Route::get('/admin/statuses',Livewire\Admin\Statuses::class)->name('admin.statuses');

        Route::get('/admin/menu/folders', Livewire\Admin\Menu\Folders::class)->name('admin.menu.folders');
        Route::get('/admin/menu/categories', Livewire\Admin\Menu\Categories::class)->name('admin.menu.categories');
        Route::get('/admin/menu/links', Livewire\Admin\Menu\Links::class)->name('admin.menu.links');

        Route::get('/admin/contact/addresses', Livewire\Admin\Contact\Addresses::class)->name('admin.contact.addresses');
        Route::get('/admin/contact/address-type', Livewire\Admin\Contact\AddressType::class)->name('admin.contact.address-types');
        Route::get('/admin/contact/phone-type', Livewire\Admin\Contact\PhoneType::class)->name('admin.contact.phone-types');

        Route::get('/admin/processes',Livewire\Admin\Progress\Processes::class)->name('admin.progress.processes');
        Route::get('/admin/steps',Livewire\Admin\Progress\Steps::class)->name('admin.progress.steps');


        Route::get('/admin/temp', Livewire\Admin\Temp::class)->name('admin.temp');


    });
});


//Route::group([
//
//],function(){
//    Route::group([
//        'middleware'=>['checkguard','auth:admin','twofactor','role:Super Admin|Admin','XssSanitizer'],
//        'namespace'=>'\App\Http\Livewire\Admin\Menu',
//
//    ],function(){
//        Route::get('/admin/menu/folders', Folders::class)->name('admin.menu.folders');
//        Route::get('/admin/menu/categories', Categories::class)->name('admin.menu.categories');
//        Route::get('/admin/menu/links', links::class)->name('admin.menu.links');
//    });
//});


//Route::group([
//
//],function(){
//    Route::group([
//        'middleware'=>['auth:admin','twofactor','role:Super Admin|Admin'],
//        'namespace'=>'\App\Http\Livewire',
//
//    ],function(){
//        Route::get('error-forbidden', Forbidden::class)->name('error-forbidden');
//    });
//});


Route::group(['middleware' => ['checkguard', 'auth:admin', 'checktwofactor', 'role:Admin', 'XssSanitizer']], function () {
    Route::get('/admin/verifytwofactor', \App\Http\Livewire\Admin\VerifyTwoFactor::class)->name('admin.verifytwofactor');
    Route::get('/admin/sendtwofactor', \App\Http\Livewire\Admin\SendTwoFactor::class)->name('admin.sendtwofactor');
//    Route::get('/admin/logout', \App\Http\Livewire\Admin\logout::class)->name('admin.logout');
});

//Route::group(['middleware' => ['auth:admin','twofactor','role:Admin']], function () {
//    Route::get('/admin', \App\Http\Livewire\Admin\Main::class)->name('admin.main');
//    Route::get('/admin/main', \App\Http\Livewire\Admin\Main::class)->name('admin.main');
//    Route::get('/admin/dashboard', \App\Http\Livewire\Admin\Dashboard::class)->name('admin.dashboard');
//    Route::get('/admin/users', \App\Http\Livewire\Admin\Users::class)->name('admin.users');
//    Route::get('/admin/verifytwofactor', 'verifytwofactor')->name('admin.verifytwofactor');
//});

Route::group(['middleware' => ['checkguard', 'auth:admin', 'XssSanitizer']], function () {
    Route::get('/admin/logout', \App\Http\Livewire\Admin\logout::class)->name('admin.logout');
});


Route::group([

], function () {
    Route::group([
        'middleware' => 'guest:admin',
        'namespace' => '\App\Http\Livewire\Admin',
    ], function () {

        Route::get('/admin/login', 'login')->name('admin.login');
        Route::get('/admin/register', 'register')->name('admin.register');

    });
});


Route::group([

], function () {

    Route::group([

        'middleware' => [
            'checkguard',
            'auth:admin',
            'twofactor',
            'role:Super Admin|Admin',
//            'permission:view-dashboard'
        ],
        'namespace' => '\App\Http\Livewire\components',

    ], function () {
        Route::get('error', Error::class)->name('error');

    });
});

Route::fallback(function () {
    $currentURL = Request::url();
    return back()->with(['url' => $currentURL, 'error' => "404"]);
//    return redirect()->route('error')->with(['error'=>'404']);
});
