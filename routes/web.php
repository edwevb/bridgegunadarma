<?php

use Illuminate\Support\Facades\Route;

//Route home
route::get('/', 'PagesController@home')->name('home');
route::get('/moreAtlet', 'PagesController@moreAtlet')->name('HomeAtlet');
route::get('/detailAtlet/{atlet}/{name}', 'PagesController@detailAtlet')->name('HomeAtlet');
route::get('/morePrestasi', 'PagesController@morePrestasi')->name('HomePrestasi');
route::get('/detailPrestasi/{prestasi}/{name}', 'PagesController@detailPrestasi')->name('HomePrestasi');
route::get('/moreEvent', 'PagesController@moreEvent')->name('HomeEvent');
route::get('/detailEvent/{event}/{name}', 'PagesController@detailEvent')->name('HomeEvent');

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
	route::resource('/masterpoint','MasterpointController',['except' => ['create','show']]);

	//Kas Iuran SK
	route::get('/iuranSk/exportPdf/{iuranSk}','IuranSkController@exportPDF');
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
	route::get('/pengeluaran/exportPdf','KasPengeluaranController@exportPDF');
	route::resource('/pengeluaran','KasPengeluaranController',['except' => ['create']]);

		//User Device Information
		route::get('/clientInfo', 'ClientInfoController@index')->name('clientInfo');
		route::delete('/clientInfo/delete/{id}', 'ClientInfoController@delete')->name('clientInfo');

		//User Device Information
		route::get('/visitor', 'ClientInfoController@visit')->name('clientInfo');
		route::delete('/visitor/delete/{id}', 'ClientInfoController@deleteVisitor')->name('clientInfo');
});

//User
route::group(['middleware' => ['auth','CheckRole:0,1']],function()
{
	route::resource('/dashboard', 'DashboardController',['except' => ['create','edit','store','show','destroy']]);
	route::get('/passwordForm/{user}', 'DashboardController@passwordForm')->name('passwordForm');
	route::post('/changePassword/{user}', 'DashboardController@changePassword');
	route::get('/_materi','UserPageController@_materi')->name('_materi');
	route::get('/_materi/{materi}','UserPageController@show_materi')->name('_materi');
	route::get('/_materi/{materi}/download','UserPageController@_materiDownload');
	route::get('/_history','UserPageController@_history')->name('_history');
	route::get('/_history/{history}','UserPageController@show_history')->name('_history');
	route::get('/_history/{history}/download','UserPageController@_historyDownload');
	route::get('/_masterpoint','UserPageController@_masterpoint')->name('_masterpoint');
	route::resource('/pesan','PesanController',['except' => ['create','edit','update']]);
	route::get('/pesan/form/{id}','PesanController@makePesan')->name('makePesan');
});

//Login
Auth::routes(['register'=>false, 'reset'=>false]);


