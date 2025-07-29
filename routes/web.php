<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WaveController;
use App\Http\Controllers\Datastar\RipplesController;
use App\Http\Controllers\Htmx\StructureController;
use App\Http\Controllers\Htmx\ValidationController;
use App\Http\Controllers\Datastar\ValidationController as DatastarValidation;
use App\Http\Controllers\Datastar\ValidationVideoController;
use App\Http\Controllers\Htmx\ValidationHtmlController;
use App\Http\Controllers\Datastar\OneController;

function asciiByWhitespace($value) {
    // Clamp input value between 0 and 50
    $value = max(0, min(50, $value));

    // Ordered from most whitespace to most visually dense
    $asciiScale = [
        '.', '.', '`', ':', ',', '-', '~', '_', 'i', 'l',
        '!', '|', '/', '\\', '(', ')', '[', ']', '{', '}',
        '^', '<', '>', '=', '+', '*', '?', 't', 'r', 'c',
        's', 'v', 'o', 'u', 'n', 'a', 'e', 'x', 'd', 'g',
        'q', 'b', 'p', 'y', 'm', 'w', '#', '%', '&', '@',
        'M', 'W'
    ];

    // Map 0–50 to the index of the array
    $index = (int) round($value * (count($asciiScale) - 1) / 50);
    return $asciiScale[$index];
}

Route::view('/', 'htmx');

Route::view('demo', 'demo');

Route::post('/examples/modal', function (Request $request) {
	$article = App\Models\Article::find(request('id'));
	$article->content = request('content');
	$article->save();

	return view('pages.examples.modal-row', compact('article'));
	//return redirect()->back();
});

/*
i run it with this on the command line:
./tailwindcss -i ./public/css/input.css -o public/css/output.css --minify
*/

// ======================> DEMOS
Route::view('demos', 'demos.index');
Route::view('demos/live-widget', 'demos.live-widget.index');
Route::view('demos/live-dashboard', 'demos.live-dash-oob.index');
Route::view('demos/live-datastar', 'demos.live-datastar.index');
Route::view('demos/datastar-pool', 'demos.live-datastar.pool');
Route::view('demos/datastar-text', 'demos.live-datastar.text');
Route::view('demos/live-datastar/stream', 'demos.live-datastar.stream');
Route::view('demos/live-datastar/text-stream', 'demos.live-datastar.text-stream');
Route::view('demos/live-datastar/ripple', 'demos.live-datastar.ripple');
Route::view('demos/csvs', 'demos.csvs.index');

Route::view('demos/ripples', 'demos.live-datastar.pure-text');
Route::view('demos/datastar-signals', 'demos.datastar-signals');
Route::get('demos/pure-text/stream', [RipplesController::class, 'textStream']);

Route::get('demos/htmx-structure', [StructureController::class, 'index']);

// ======================> VALIDATION
Route::get('demos/html-validation',             [ValidationHtmlController::class, 'index']);
Route::post('demos/html-validation',            [ValidationHtmlController::class, 'create']);

Route::get('demos/htmx-validation',             [ValidationController::class, 'index']);
Route::post('demos/htmx-validation/validate',   [ValidationController::class, 'validate']);
Route::post('demos/htmx-validation',            [ValidationController::class, 'create']);

Route::get('demos/datastar-validation',           [DatastarValidation::class, 'index']);
Route::post('demos/datastar-validation/validate', [DatastarValidation::class, 'validate']);
Route::post('demos/datastar-validation',          [DatastarValidation::class, 'create']);





// ======================> BASECOAT
Route::view('demos/basecoat', 'demos.basecoat.index');


Route::view('demos/infinite-scroll', 'demos.infinite-scroll.easiest');
Route::view('demos/infinite-scroll/smoother', 'demos.infinite-scroll.better');
Route::view('demos/infinite-scroll/insane', 'demos.infinite-scroll.insane');
Route::view('demos/infinite-scroll/rows', 'demos.infinite-scroll.easiest-rows');
Route::view('demos/infinite-scroll/smoother-rows', 'demos.infinite-scroll.better-rows');
Route::view('demos/infinite-scroll/insane-rows', 'demos.infinite-scroll.insane-rows');

Route::get('demos/htmx-structure/emails/{id}/row', [StructureController::class, 'row']);
Route::get('demos/htmx-structure/emails/{id}/row-edit', [StructureController::class, 'rowEdit']);

Route::get('demos/htmx-structure/emails/{id}/people/lookup', [StructureController::class, 'peopleLookup']);
Route::get('demos/htmx-structure/emails/{id}/toggle-status', [StructureController::class, 'toggleActive']);
Route::post('demos/htmx-structure/emails/{id}/tag-link', [StructureController::class, 'tagLink']);
Route::post('demos/htmx-structure/emails/{id}/tag-unlink', [StructureController::class, 'tagUnlink']);
Route::post('demos/htmx-structure/emails/{id}/person-link', [StructureController::class, 'personLink']);
Route::post('demos/htmx-structure/emails/{id}/person-unlink', [StructureController::class, 'personUnlink']);
Route::post('demos/htmx-structure/emails/{id}/campaign-link', [StructureController::class, 'campaignLink']);
Route::post('demos/htmx-structure/emails/{id}/campaign-unlink', [StructureController::class, 'campaignUnlink']);

// ======================> RESPONSES
Route::view('/htmx/time', 'htmx.responses.time');
Route::view('/htmx/form', 'htmx.responses.form');

// ======================> HTMX EXTENSIONS
Route::view('/htmx/head-support/title-active', 'htmx.responses.title-active');
Route::view('/htmx/head-support/title-inactive', 'htmx.responses.title-inactive');
Route::view('/htmx/head-support/css-blue', 'htmx.responses.css-blue');
Route::view('/htmx/head-support/css-red', 'htmx.responses.css-red');
Route::get('/htmx/preload/content', function() {
    return response()->view('htmx.responses.preload-content')
        ->header('Cache-Control', 'public, max-age=60');
});

Route::get('/htmx/preload/form-response', function() {
    $plan = request('plan', 'none');
    $features = request('features', []);
    $region = request('region', 'none');
    
    return response()->view('htmx.responses.preload-form', compact('plan', 'features', 'region'))
        ->header('Cache-Control', 'public, max-age=60');
});

Route::get('/htmx/idiomorph/simple', function() {
    return response()->view('htmx.responses.idiomorph-simple');
});

Route::get('/htmx/idiomorph/content-1', function() {
    return response()->view('htmx.responses.idiomorph-content-1');
});

Route::get('/htmx/idiomorph/content-2', function() {
    return response()->view('htmx.responses.idiomorph-content-2');
});

Route::get('/htmx/idiomorph/content-3', function() {
    return response()->view('htmx.responses.idiomorph-content-3');
});

// ======================> RANDOM
Route::view('big-html', 'random.big-html');
Route::view('big-html-row', 'random.big-html-row');
Route::view('big-html-row-new', 'random.big-html-row-new');

// ======================> DATASTAR
Route::view('wave', 'wave.index');
Route::post('wave/rooms', [WaveController::class, 'createRoom']);
Route::post('wave/members', [WaveController::class, 'createMember']);
Route::get('wave/{code}', [WaveController::class, 'room']);

// ======================> BASECOAT
Route::get('demos/datastar-one', [OneController::class, 'show']);
Route::get('demos/datastar-one/long-request', [OneController::class, 'long']);


