<?php

Route::get('/', 'TestController@welcome');

Route::get('/prueba', function(){
    return 'Hola soy la ruta de prueba';
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
