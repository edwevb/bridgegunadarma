<?php

use Illuminate\Support\Facades\Route;

//Route home
route::get('/', 'PagesController@home')->name('home');
route::get('/moreAtlet', 'PagesController@moreAtlet')->name('moreAtlet');
route::get('/detailAtlet/{atlet}', 'PagesController@detailAtlet')->name('detailAtlet');
route::get('/morePrestasi', 'PagesController@morePrestasi')->name('morePrestasi');
route::get('/detailPrestasi/{prestasi}', 'PagesController@detailPrestasi')->name('detailPrestasi');
route::get('/moreEvent', 'PagesController@moreEvent')->name('moreEvent');
route::get('/detailEvent/{event}', 'PagesController@detailEvent')->name('detailEvent');

//Admin
route::group(['middleware' => ['auth','CheckRole:1']],function()
{
	//Atlet
	route::get('/atlet/exportPdf','AtletController@exportPDF');
	route::resource('/atlet', 'AtletController',['except' => ['create']]);
	route::post('/atlet/{atlet}/addPrestasi', 'AtletController@addPrestasi');
	route::get('/atlet/{atlet}/{prestasi}/removePrestasi','AtletController@removePrestasi');
	route::post('/atlet/{atlet}/addHistory', 'AtletController@addHistory');
	route::get('/atlet/{atlet}/{prestasi}/removeHistory','AtletController@removeHistory');

	//Prestasi
	route::resource('/prestasi', 'PrestasiController',['except' => ['create']]);
	route::post('/prestasi/{prestasi}/addAtlet', 'PrestasiController@addAtlet');
	route::get('/prestasi/{prestasi}/{atlet}/removeAtlet', 'PrestasiController@removeAtlet');
	//Materi
	route::resource('/materi', 'MateriController',['except' => ['create']]);
	route::get('/materi/{materi}/download','MateriController@download');

	//Event
	route::resource('/event','EventController',['except' => ['create']]);

	//History
	route::resource('/history','HistoryController',['except' => ['create']]);
	route::post('/history/{history}/addAtlet', 'HistoryController@addAtlet');
	route::get('/history/{history}/{atlet}/removeAtlet', 'HistoryController@removeAtlet');
	route::get('/history/{history}/download','HistoryController@download');

	//Masterpoint
	route::resource('/masterpoint','MasterpointController',['except' => ['create']]);

	//Kas Iuran SK
	route::resource('/iuranSk','IuranSkController',['except' => ['create','edit','update']]);
	route::post('/iuranSk/{iuranSk}/addAtlet', 'IuranSkController@addAtlet');
	route::get('/iuranSk/{iuranSk}/{atlet}/removeAtlet', 'IuranSkController@removeAtlet');

	//User management
	route::get('/user', 'UserManagementController@index');
	route::post('/user', 'UserManagementController@create');
	route::get('/user/{user}/edit', 'UserManagementController@edit');
	route::patch('/user/{user}', 'UserManagementController@update');
	route::delete('/user/{user}', 'UserManagementController@destroy');

	//Pengeluaran
	route::resource('/pengeluaran','KasPengeluaranController',['except' => ['create']]);

	//User Device Information
	route::get('/clientInfo', 'ClientInfoController@index');
	route::delete('/clientInfo/delete/{id}', 'ClientInfoController@delete');
});

//User
route::group(['middleware' => ['auth','CheckRole:0,1']],function()
{
	route::resource('/dashboard', 'DashboardController',['except' => ['create','edit','store','destroy']]);
	route::get('/passwordForm/{user}', 'DashboardController@passwordForm');
	route::post('/changePassword/{user}', 'DashboardController@changePassword');
	route::get('/_materi','UserPageController@_materi');
	route::get('/_materi/{materi}','UserPageController@show_materi');
	route::get('/_materi/{materi}/download','UserPageController@_materiDownload');
	route::get('/_history','UserPageController@_history');
	route::get('/_history/{history}','UserPageController@show_history');
	route::get('/_history/{history}/download','UserPageController@_historyDownload');
	route::get('/_masterpoint','UserPageController@_masterpoint');
	route::get('/_masterpoint/{masterpoint}','UserPageController@show_masterpoint');
	route::resource('/pesan','PesanController',['except' => ['create','edit','update']]);
	route::get('/pesan/form/{id}','PesanController@makePesan')->name('makePesan');
});

//Login
Auth::routes(['register'=>false, 'reset'=>false]);


