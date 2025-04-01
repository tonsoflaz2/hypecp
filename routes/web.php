<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WaveController;

Route::view('/', 'htmx');

Route::view('demo', 'demo');

Route::post('/examples/modal', function (Request $request) {
	$article = App\Models\Article::find(request('id'));
	$article->content = request('content');
	$article->save();

	return view('pages.examples.modal-row', compact('article'));
	//return redirect()->back();
});

// ======================> DEMOS
Route::view('demos/live-widget', 'demos.live-widget.index');
Route::view('demos/live-dashboard', 'demos.live-dash-oob.index');

// ======================> RESPONSES
Route::view('/htmx/time', 'htmx.responses.time');
Route::view('/htmx/form', 'htmx.responses.form');

// ======================> RANDOM
Route::view('big-html', 'random.big-html');
Route::view('big-html-row', 'random.big-html-row');
Route::view('big-html-row-new', 'random.big-html-row-new');

// ======================> DATASTAR
Route::view('wave', 'wave.index');
Route::post('wave/rooms', [WaveController::class, 'createRoom']);
Route::post('wave/members', [WaveController::class, 'createMember']);
Route::get('wave/{code}', [WaveController::class, 'room']);

