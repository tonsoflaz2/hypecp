<?php

namespace App\Http\Controllers\Datastar;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use starfederation\datastar\ServerSentEventGenerator;

class OneController extends Controller
{

    public function show()
    {
        return view('demos.datastar-one');
    }

    public function stream()
    {
        ignore_user_abort(false);
        ini_set('max_execution_time', 36000);

        $sse = new ServerSentEventGenerator();
        $sse->sendHeaders();

        while (true) {
            $signals = ServerSentEventGenerator::readSignals();
            $foo = $signals['foo'] ?? '';

            $html = '<div id="foo">Foo: ' . htmlspecialchars($foo) . '</div>';
            $sse->patchElements($html);

            // Patch the current time to verify sse running
            $nowHtml = '<div id="now"> Now: ' . date('H:i:s') . '</div>';
            $sse->patchElements($nowHtml);
            usleep(250000);
        }
    }
} 