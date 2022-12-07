<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Routes;
use App\Http\Controllers\Api\PessoaController;

Route::group(['prefix' => 'v1'], function () {
    Route::post('/pessoa', 'Api\PessoaController@store');
    Route::get('/pessoa/{id}', 'Api\PessoaController@show')->where('id', '[1-9]+');
    Route::get('/pessoa', 'Api\PessoaController@index');
    Route::put('/pessoa/{id}', 'Api\PessoaController@update')->where('id', '[1-9]+');
    Route::delete('/pessoa/{id}', 'Api\PessoaController@destroy')->where('id', '[1-9]+');
});

