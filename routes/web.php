<?php

use Illuminate\Support\Facades\Route;
use Jeoip\Server\Http\Controllers\ApiController;

Route::group(['prefix' => 'api'], function () {
    Route::get('/ip', ['as' => 'ip.ip', 'uses' => ApiController::class.'@ip']);
    Route::get('/{ip}', ['as' => 'ip.info', 'uses' => ApiController::class.'@query']);
    Route::get('/{ip}/country-code', ['as' => 'ip.countryCode', 'uses' => ApiController::class.'@countryCode']);
    Route::get('/{ip}/country', ['as' => 'ip.country', 'uses' => ApiController::class.'@country']);
    Route::get('/{ip}/city', ['as' => 'ip.city', 'uses' => ApiController::class.'@city']);
    Route::get('/{ip}/asn', ['as' => 'ip.asn', 'uses' => ApiController::class.'@asn']);
});
