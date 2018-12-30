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

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/tes', function(){
    $data = App\Buku::all();
    $datax = $data->toArray();

    session('name', 'Adaw Kuro');

    foreach(session()->all() as $ses){
        echo $ses;
    }
});

Route::group(['prefix' => 'home'], function () {  
    // Buku    
    Route::get('/buku/datatables', 'BukuController@dataTables')->name('buku.datatables');
    Route::resource('/buku', 'BukuController');    
    
    // Pasok
    Route::get('/pasok/datatables', 'PasokController@dataTables')->name('pasok.datatables');
    Route::resource('/pasok', 'PasokController');

    // Distributor
    Route::get('/distributor/datatables', 'DistributorController@dataTables')->name('distributor.datatables');
    Route::resource('/distributor', 'DistributorController');
    
    // Kasir
    Route::get('/kasir/datatables', 'KasirController@dataTables')->name('kasir.datatables');
    Route::resource('/kasir', 'KasirController');
    
    // Penjualan
    Route::get('/penjualan/datatables', 'PenjualanController@dataTables')->name('penjualan.datatables');
    Route::resource('/penjualan', 'PenjualanController');

    // Kasir
    Route::get('/cart/datatables', 'CartController@dataTables')->name('cart.datatables');
    Route::delete('/cart/clearAll', 'CartController@clearAll')->name('cart.clearAll');
    Route::resource('/cart', 'CartController');
});

// Account
Route::get('account/password', 'Auth\AccountController@password')->name('account.password');
Route::post('account/password', 'Auth\AccountController@passwordUpdate')->name('account.password.update');
Route::resource('account', 'Auth\AccountController');

// Me
Route::get('/me', function() {
    $title = "It's me Jack !!";
    $aim = 'About';
    return view('me', compact('title', 'aim'));
})->name('me');




