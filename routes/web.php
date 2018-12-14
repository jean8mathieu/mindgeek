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

Route::group([
    'prefix' => ''
], function () {
    Route::get('/', 'SchoolboardController@getIndex')->name('home');


    Route::group([
        'prefix' => 'view/{schoolboard}'
    ], function () {
        Route::get('/', 'StudentController@getIndex')->name('student.index');
        Route::get('{student}', 'StudentController@getView')->name('student.view');
        Route::get('{student}/generate', 'SchoolboardController@exportStudentInfo')->name('schoolboard.generate');
    });
});

