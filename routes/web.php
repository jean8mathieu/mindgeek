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
        'prefix' => 'view/{schoolboard_id}'
    ], function () {
        Route::get('/', 'StudentController@getIndex')->name('student.index');
        Route::get('{student_id}', 'StudentController@getView')->name('student.view');
        Route::get('{student_id}/generate', 'SchoolboardController@exportStudentInfo')->name('schoolboard.generate');
    });
});

