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

    public function long()
    {

        return "Success! text/html sent back";
        $sse = new \starfederation\datastar\ServerSentEventGenerator();
        $sse->sendHeaders();

        sleep(3);

        $html = "<div></div>";
        $sse->patchElements($html);
    }
} 