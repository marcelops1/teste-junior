<?php

use Illuminate\Http\Request;

Route::group(['prefix' => 'v1'], function () {
    Route::get('/pessoa', 'Api\PessoaController@index');
    Route::get('/pessoa/{id}', 'Api\PessoaController@show');
    Route::post('/pessoa', 'Api\PessoaController@store');
    Route::put('/pessoa/{id}', 'Api\PessoaController@update');
    Route::delete('/pessoa/{id}', 'Api\PessoaController@destroy');

    Route::fallback(function () {
        return response()->json([
            'sucess' => false,
            'payload' => 'Route Not Found.',
            'message'=> "You can check an array with routes names on 'routes' key",
            'routes'=>['get/pessoa','get/pessoa{id}','post/pessoa','put/pessoa{id}','delete/pessoa/{id}']
        ], 404);
    });
});
