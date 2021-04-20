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

Route::get('/admin', function() {
    return redirect(route('login'));
});

Route::get('/', function() {
    return redirect(route('user'));
});

Route::get('/user', 'User\HomeController@index')->name('user');
Route::get('/loginuser', 'Auth\LoginUserController@form')->name('loginuser');

//Pendaki Area
Route::prefix('pendaki')->group(function()
{
  Route::get('/loginuser', 'Auth\LoginUserController@form')->name('loginuser');
  Route::post('/loginuser', 'Auth\LoginUserController@login')->name('pendaki.login.submit');
  Route::get('/dashboard', 'User\HomeController@dashboard')->name('pendaki.dashboard');

  Route::get('/anggota', 'User\UserController@anggota')->name('pendaki.anggota');
  Route::get('/pendaftaran', 'User\UserController@index')->name('pendaki.pendaftaran');
  Route::get('/status', 'User\UserController@statuspendakian')->name('pendaki.status');
  Route::get('/riwayat', 'User\UserController@riwayat')->name('pendaki.riwayat');

  Route::get('/create/anggota', 'User\UserController@tambahanggota')->name('pendaki.anggota.create');
  Route::get('/edit/anggota', 'User\UserController@anggota')->name('pendaki.anggota.edit');
  Route::post('/store/anggota', 'User\UserController@simpananggota')->name('pendaki.anggota.store');
  Route::delete('/hapus/anggota/{id}', 'User\UserController@hapusanggota')->name('pendaki.anggota.delete');

  Route::get('/create/pendaftaran', 'User\UserController@pendaftaran')->name('pendaki.pendaftaran.create');
  Route::post('/store/pendaftaran', 'User\UserController@simpanpendaftaran')->name('pendaki.pendaftaran.store');

  Route::get('/create/fasilitas/{id}', 'User\UserController@tambahfasilitas')->name('pendaki.fasilitas.create');
  Route::post('/store/fasilitas', 'User\UserController@simpanfasilitas')->name('pendaki.fasilitas.store');
  Route::get('/cetak_pdf/{id}', 'User\UserController@cetak_pdf')->name('pendaki.cetak_pdf');


});





Auth::routes(['register' => false]);

Route::group(['middleware' => 'auth'], function(){
    
    //settings
    Route::group(['middleware' => ['role:admin']], function() {
        Route::resource('setting', 'SettingController');        
    });

    
    
    Route::group(['middleware' => ['permission:manajemen users|manajemen roles']], function() {
        Route::get('/roles/search','RoleController@search')->name('roles.search');
        Route::resource('users', 'UserController');
        Route::resource('roles', 'RoleController');
        // Route::resource('setting', 'SettingController');        
    });

    // Produk
    Route::group(['middleware' => ['permission:manajemen produk']], function() {
        Route::get('/produk/search','ProdukController@search')->name('produk.search');
        Route::get('/produk/pdf','ProdukController@reportPdf')->name('produk.pdf');
        Route::get('/produk/export/', 'ProdukController@export')->name('produk.export');
        Route::post('/produk/import/', 'ProdukController@import')->name('produk.import');
        Route::resource('produk', 'ProdukController');        
    });

    // Gunung
    Route::group(['middleware' => ['permission:manajemen produk']], function() {
        Route::get('/gunung/search','Admin\GunungController@search')->name('gunung.search');
        Route::get('/gunung/pdf','Admin\GunungController@reportPdf')->name('gunung.pdf');
        Route::get('/gunung/export/', 'Admin\GunungController@export')->name('gunung.export');
        Route::post('/gunung/import/', 'Admin\GunungController@import')->name('gunung.import');
        Route::resource('gunung', 'Admin\GunungController');        
    });

    // Jalur
    Route::group(['middleware' => ['permission:manajemen produk']], function() {
        Route::get('/jalur/search','Admin\JalurController@search')->name('jalur.search');
        Route::get('/jalur/pdf','Admin\JalurController@reportPdf')->name('jalur.pdf');
        Route::get('/jalur/export/', 'Admin\JalurController@export')->name('jalur.export');
        Route::post('/jalur/import/', 'Admin\JalurController@import')->name('jalur.import');
        Route::resource('jalur', 'Admin\JalurController');        
    });

    // Pos
    Route::group(['middleware' => ['permission:manajemen produk']], function() {
        Route::get('/pos/search','Admin\PosController@search')->name('pos.search');
        Route::get('/pos/pdf','Admin\PosController@reportPdf')->name('pos.pdf');
        Route::get('/pos/export/', 'Admin\PosController@export')->name('pos.export');
        Route::post('/pos/import/', 'Admin\PosController@import')->name('pos.import');
        Route::resource('pos', 'Admin\PosController');        
    });

    // Fasilitas
    Route::group(['middleware' => ['permission:manajemen produk']], function() {
        Route::get('/fasilitas/search','Admin\FasilitasController@search')->name('fasilitas.search');
        Route::get('/fasilitas/pdf','Admin\FasilitasController@reportPdf')->name('fasilitas.pdf');
        Route::get('/fasilitas/export/', 'Admin\FasilitasController@export')->name('fasilitas.export');
        Route::post('/fasilitas/import/', 'Admin\FasilitasController@import')->name('fasilitas.import');
        Route::resource('fasilitas', 'Admin\FasilitasController');        
    });

    // Pendaki
    Route::group(['middleware' => ['permission:manajemen produk']], function() {
        Route::get('/pendaki/search','Admin\PendakiController@search')->name('pendaki.search');
        Route::get('/pendaki/pdf','Admin\PendakiController@reportPdf')->name('pendaki.pdf');
        Route::get('/pendaki/export/', 'Admin\PendakiController@export')->name('pendaki.export');
        Route::post('/pendaki/import/', 'Admin\PendakiController@import')->name('pendaki.import');
        Route::resource('pendaki', 'Admin\PendakiController');        
    });


  // Permohonan Pendakian
    Route::group(['middleware' => ['permission:manajemen produk']], function() {
        Route::get('/request','Admin\PendakianController@index')->name('request.index');
        Route::get('/statuspendakian','Admin\PendakianController@statuspendakian')->name('statuspendakian.index');
        Route::get('/statuspendakian/edit/{id}','Admin\PendakianController@statuspendakianedit')->name('statuspendakian.edit');
        Route::get('/pendaftaran','Admin\PendakianController@pendaftaran')->name('pendaftaran.index');
        Route::get('/daftarbaru','Admin\PendakianController@formpendaftaran1')->name('formpendaftaran');
        Route::get('/member','Admin\PendakianController@formpendaftaran2')->name('formpendaftaran2');
        Route::post('/postdaftar','Admin\PendakianController@postdaftar')->name('postdaftar');

        Route::get('/tambahanggota','Admin\PendakianController@tambahanggota')->name('pendakian.tambahanggota');
        Route::post('/postanggota','Admin\PendakianController@postanggota')->name('post.tambahanggota');

        Route::get('/laporan','Admin\LaporanController@laporan')->name('laporan.index');
        Route::get('/cetak_pdf/{id}', 'Admin\LaporanController@cetak_pdf')->name('cetak_pdf');
        Route::get('/permohonan', 'Admin\PendakianController@permohonan')->name('permohonan');
        Route::get('/terima/{id}', 'Admin\PendakianController@terima')->name('terima');
        Route::get('/tolak/{id}', 'Admin\PendakianController@tolak')->name('tolak');

        //Naik Turun
        Route::get('/naik/{id}', 'Admin\PendakianController@naik')->name('naik');
        Route::get('/turun/{id}', 'Admin\PendakianController@turun')->name('turun');


    });

    // Kategori
    Route::group(['middleware' => ['permission:manajemen kategori']], function() {         
        Route::resource('kategori', 'KategoriController');         
    });
    
    //profile
    Route::resource('/profile', 'ProfileController');

    Route::get('/home', 'HomeController@index')->name('home');



});

