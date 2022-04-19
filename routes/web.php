<?php

use Illuminate\Support\Facades\Auth;
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
    return view('welcome');
});

//Auth::routes();


Route::group([

], function () {
    Route::group([
        'middleware' => ['checkguard', 'guest:web', 'XssSanitizer'],
        'namespace' => '\App\Http\Livewire',
    ], function () {

        Route::get('/login', 'login')->name('login');
        Route::get('/register', 'register')->name('register');

    });
});


Route::group(['middleware' => ['checkguard', 'auth:web', 'XssSanitizer']], function () {
    Route::get('/logout', \App\Http\Livewire\logout::class)->name('logout');
});


//Route::group([
//    'middleware' => ['checkguard','auth:web','twofactor','role:Guest|Manager','XssSanitizer']
//], function () {
//
//});


Route::group([

], function () {
    Route::group([
        'middleware' => ['checkguard', 'auth:web', 'twofactor', 'role:User|Manager', 'XssSanitizer'],
        'namespace' => '\App\Http\Livewire',

    ], function () {
        Route::get('/verifytwofactor', VerifyTwoFactor::class)->name('verifytwofactor');
        Route::get('/sendtwofactor', SendTwoFactor::class)->name('sendtwofactor');
        Route::get('dashboard', Dashboard::class)->name('user.dashboard');
        Route::get('/profile/', Profile::class)->name('user.profile');
        Route::get('/passports/', Passports::class)->name('user.passports');
        Route::get('/educations', Educations::class)->name('user.educations');
        Route::get('/education-types', EducationTypes::class)->name('user.education-types');
        Route::get('/statuses',Statuses::class)->name('user.statuses');
        Route::get('/applications',Applications::class)->name('user.applications');
    });
});

//MANAGER ROLES
Route::group([

], function () {
    Route::group([
        'middleware' => ['checkguard', 'auth:web', 'twofactor', 'role:Manager', 'XssSanitizer'],
        'namespace' => '\App\Http\Livewire',

    ], function () {
        Route::get('/universities', Universities::class)->name('user.universities');
        Route::get('/services', Services::class)->name('user.services');
        Route::get('/service-requirements', ServiceRequirements::class)->name('user.service-requirements');
    });
});


Route::group([

], function () {

    Route::group([

        'middleware' => ['checkguard', 'auth:web', 'twofactor', 'role:User|Manager', 'XssSanitizer'],
        'namespace' => '\App\Http\Livewire\errors',

    ], function () {
        Route::get('forbidden', Forbidden::class)->name('forbidden');

    });
});


