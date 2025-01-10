<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'htmx');

Route::view('demo', 'demo');
// ======================> RESPONSES
Route::view('/htmx/time', 'htmx.responses.time');
Route::view('/htmx/form', 'htmx.responses.form');
