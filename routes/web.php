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
    return Redirect::action('JobfairController@index');
});
Route::resource('jobfair', 'JobfairController');


Route::get('joblogined', function () {
    return view('job.jobfairEdit');
});

Route::get("editJob","JobfairController@editjob");
// Route for view/blade file.
Route::get('importExport', 'CSVController@importExport');
// Route for export/download tabledata to .csv, .xls or .xlsx
Route::get('downloadExcel/{type}', 'CSVController@downloadExcel');
// Route for import excel data to database.
Route::post('importExcel', 'CSVController@importExcel');

Route::get("company","JobfairController@company");

Route::get('recaptchacreate', 'JobfairController@capchar');
Route::post('capcharck', 'JobfairController@capcharck');

Route::get("sekilogin","CSVController@sekilogin");
Route::get('mobile', function () {
    return view('job.mobile');
});