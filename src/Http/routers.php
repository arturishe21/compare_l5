<?php
Route::group (['middleware' => ['web']], function () {
    Route::get ('/add_compare', [
        'as' => 'add_compare',
        'uses' => 'Vis\Compare\CompareController@doAddCompare'
    ]);

    Route::get ('/remove_to_compare', [
        'as' => 'add_compare',
        'uses' => 'Vis\Compare\CompareController@doRemoveCompare'
    ]);
    
});
