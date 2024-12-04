<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'htmx');

Route::view('/htmx/time', 'htmx.responses.time');
