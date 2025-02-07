<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WaveController;

Route::view('/', 'htmx');

Route::view('demo', 'demo');

// ======================> RESPONSES
Route::view('/htmx/time', 'htmx.responses.time');
Route::view('/htmx/form', 'htmx.responses.form');

// ======================> RANDOM
Route::view('big-html', 'random.big-html');

// ======================> DATASTAR
Route::view('wave', 'wave.index');
Route::post('wave/rooms', [WaveController::class, 'createRoom']);
Route::post('wave/members', [WaveController::class, 'createMember']);
Route::get('wave/{code}', [WaveController::class, 'room']);

