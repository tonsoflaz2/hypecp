<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'htmx');


// ======================> RESPONSES
Route::view('/htmx/time', 'htmx.responses.time');
Route::view('/htmx/form', 'htmx.responses.form');
