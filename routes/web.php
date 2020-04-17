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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/blog', 'HomeController@blog');
Route::get('/blog/my', 'HomeController@blogsaya');
Route::get('blog/{id}', 'HomeController@detailblog')->name('detail');
Route::post('/blog/create', 'HomeController@createblog');
Route::get('/blog/update/{id}', 'HomeController@updateblog')->name('blogupdate');
Route::post('/blog/update/post/{id}', 'HomeController@postupdateblog');
Route::get('/blog/hapus/{id}', 'HomeController@hapusblog')->name('bloghapus');

Route::post('/tema', 'HomeController@pilihtema');
Route::post('/pesan/{portfolioid}/{authorid}', 'HomeController@prosespesan');

Route::get('/keranjang', 'HomeController@keranjang');
Route::get('/pesanan', 'HomeController@pesanan');
Route::get('/konfirmasipembayaran/{id}', 'HomeController@konfirmasipembayaran');

Route::post('/bayarnanti/{id}', 'HomeController@bayarnanti');