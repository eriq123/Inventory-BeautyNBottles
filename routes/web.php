<?php

// Auth::routes();

// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

Route::get('/', 'StockController@Sindex')->name('stock.index');

Route::group(['middleware' => ['auth','web']], function () {
	Route::group(['middleware' => ['role:Admin|Assistant']], function () {

		// category
		Route::get('/Category/index', 'CategoryController@Cindex')->name('category.index');
		Route::post('/Category/store', 'CategoryController@Cstore')->name('category.store');
		Route::post('/Category/edit', 'CategoryController@Cedit')->name('category.edit');
		Route::post('/Category/destroy', 'CategoryController@Cdestroy')->name('category.destroy');

		// sub-category
		Route::get('/Sub_Category/index', 'SubCategoryController@SCindex')->name('sub_category.index');
		Route::post('/Sub_Category/store', 'SubCategoryController@SCstore')->name('sub_category.store');
		Route::post('/Sub_Category/edit', 'SubCategoryController@SCedit')->name('sub_category.edit');
		Route::post('/Sub_Category/destroy', 'SubCategoryController@SCdestroy')->name('sub_category.destroy');

		// item
		Route::get('/Product/index', 'ItemCrudController@ICindex')->name('item.index');
		Route::get('/Product/edit/{id}', 'ItemCrudController@ICedit')->name('item.edit');
		Route::post('/Product/store', 'ItemCrudController@ICstore')->name('item.store'); //store and update
		Route::post('/Product/destroy', 'ItemCrudController@ICdestroy')->name('item.destroy');
		Route::post('/Product/dropdown', 'ItemCrudController@ICdropdown')->name('item.dropdown');

		// stock add and minus
		Route::post('/Stock/store', 'StockController@Sstore')->name('stock.store');
		Route::get('/Stock/low', 'StockController@Slow')->name('stock.low');
		Route::get('/Stock/return', 'StockController@Sreturn')->name('stock.return');
		Route::get('/Stock/convert', 'StockController@Sconvert')->name('stock.convert');
		
		// convert stocks modal
		Route::post('/convert/High', 'StockController@CHigh')->name('convert.high');
		// convert action
		Route::post('/convert/action', 'StockController@CAction')->name('convert.action');

		// logs
		Route::get('/Logs/index', 'LogsController@Lindex')->name('log.index');
		Route::post('/Logs/undo', 'LogsController@Lundo')->name('log.undo');

		// reports
		Route::get('/Reports/index', 'ReportsController@Rindex')->name('report.index');
		Route::get('/Reports/download', 'ReportsController@Rdownload')->name('report.download');
		Route::get('/Reports/create', 'ReportsController@Rcreate')->name('report.create');

		

	});
		// account
		Route::get('/Account/index', 'AccountController@Aindex')->name('account.index');
		Route::post('/Account/edit', 'AccountController@Aedit')->name('account.edit');
		Route::post('/Account/activate', 'AccountController@Aactivate')->name('account.activate');
		Route::post('/Account/password/change', 'AccountController@Apassword')->name('account.password');
		Route::post('/Account/password/reset', 'AccountController@Areset')->name('account.reset');
		Route::post('/Account/GetUserInfo', 'AccountController@AGetUserInfo')->name('account.GetUserInfo');


	Route::group(['middleware' => ['role:Admin']], function () {

	});

	Route::group(['middleware' => ['role:Assistant']], function () {

	});

	Route::group(['middleware' => ['role:Employee']], function () {

	});
});

