<?php

use Illuminate\Support\Facades\Route;
use Jeoip\Server\Http\Controllers;

Route::get('/api/{ip}', ['uses' => Controllers\ApiController::class.'@query']);
