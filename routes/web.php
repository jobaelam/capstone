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

Route::get('/message', function () {
    return view('messages.index');
});

Route::get('accreditation/department/{id}', 'PagesController@ShowDepartment');

Route::get('accreditation', 'PagesController@ShowAgency');

Route::get('accreditation/area/{id}/create', 'AreasController@create');

Route::get('accreditation/parameter/{id}/create', 'ParametersController@create');

Route::get('accreditation/benchmark/{id}/create', 'BenchmarksController@create');

Route::get('accreditation/folder/{id}/create', 'FoldersController@create');

Route::get('accreditation/file/{id}/upload', 'FilesController@create');

Route::resource('accreditation', 'AgenciesController');

Route::resource('accreditation/area', 'AreasController');

Route::resource('accreditation/parameter', 'ParametersController');

Route::resource('accreditation/benchmark', 'BenchmarksController');

Route::resource('accreditation/folder', 'FoldersController');

Route::resource('accreditation/file', 'FilesController');

Auth::routes();

Route::get('/', 'AgenciesController@index')->name('home')->middleware('auth');
