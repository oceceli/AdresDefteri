<?php


Auth::routes();

Route::get('/logoff', function(){
    request()->session()->invalidate();
    return redirect('/');
});

Route::get('/{any}', 'AppController@index')->where('any', '.*');
