<?php
Route::group (['middleware' => ['web']], function () {
    Route::post ('/add_compare', [
        'as' => 'add_compare',
        'uses' => 'Vis\Compare\CompareController@doAddCompare'
    ]);

    Route::post ('/remove_to_compare', [
        'as' => 'add_compare',
        'uses' => 'Vis\Compare\CompareController@doRemoveCompare'
    ]);

    Route::get ('/compare', [
        'as' => 'show_compare',
        'uses' => 'Vis\Compare\CompareController@fetchCompare'
    ]);
});