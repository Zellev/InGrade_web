<?php

use App\Http\Controllers\SiswaController;
use App\Http\Controllers\DashboardController;
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
    return view('home');
});

Route :: get ('/login','AuthController@login')->name('login');
Route :: post ('/postlogin','AuthController@postlogin');
Route :: get('/logout', 'AuthController@logout');
Route :: post ('/send','PesanController@');

Route :: group(['middleware' => ['auth','CheckRole:admin']],function(){
    //Route :: get ('/admin/{admin}/profile', 'AdminController@profile'); 
    Route :: get ('/matpel','MatpelController@index');
    Route :: get('/matpel/{mapel}/edit', 'MatpelController@edit');
    Route :: post('/matpel/{mapel}/update', 'MatpelController@update');
    Route :: post('/siswa/create','SiswaController@create');
    Route :: get('/siswa/{siswa}/edit', 'SiswaController@edit');
    Route :: post('/siswa/{siswa}/update', 'SiswaController@update');
    Route :: get ('/siswa/{siswa}/hapus', 'SiswaController@hapus');
    Route :: get ('/siswa/{siswa}/profile', 'SiswaController@profile'); 
    Route :: post ('/siswa/{siswa}/addnilai', 'SiswaController@addnilai'); 
    Route :: get ('/siswa/{siswa}/{idmapel}/deletenilai', 'SiswaController@deletenilai'); 
    Route :: get('/siswa/exportexcel/', 'SiswaController@exportExcel');
    Route :: get('/siswa/exportpdf/', 'SiswaController@exportPdf');
    Route :: get ('/guru','GuruController@index');
    Route :: post('/guru/create','GuruController@create');
    Route :: get('/guru/{guru}/edit', 'GuruController@edit');
    Route :: post('/guru/{guru}/update', 'GuruController@update');
    Route :: get ('/guru/{guru}/hapus', 'GuruController@hapus');
    Route :: get('/guru/{guru}/profile', 'GuruController@profile');
});

Route :: group(['middleware' => ['auth','CheckRole:admin,siswa,guru']],function(){
    Route :: get ('/dashboard',[DashboardController::class, 'index']);    
    Route :: get('/siswa/{siswa}/edit', 'SiswaController@edit');
    Route :: post('/siswa/{siswa}/update', 'SiswaController@update');
    Route :: get ('/siswa/{siswa}/profile', 'SiswaController@profile');
    Route :: get('/siswa/{siswa}/profile_ku', 'SiswaController@profile_ku');
    Route :: post ('/siswa/{siswa}/gantiPass', 'SiswaController@gantiPass');
    Route :: post ('/guru/{guru}/gantiPass', 'GuruController@gantiPass'); 
});

Route :: group(['middleware' => ['auth','CheckRole:admin,guru']],function(){
    Route :: get('/guru/{guru}/profile', 'GuruController@profile');
    Route :: get('/guru/{guru}/profile_ku', 'GuruController@profile_ku');
    Route :: get('/guru/{guru}/edit', 'GuruController@edit');
    Route :: post('/guru/{guru}/update', 'GuruController@update');
    Route :: get ('/siswa','SiswaController@index');
    Route :: post ('/siswa/{siswa}/addnilai', 'SiswaController@addnilai');
    Route :: get ('/siswa/{siswa}/{idmapel}/deletenilai', 'SiswaController@deletenilai');
    Route :: get('/siswa/exportexcel/', 'SiswaController@exportExcel');
    Route :: get('/siswa/exportpdf/', 'SiswaController@exportPdf');
});