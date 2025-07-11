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

        sleep(3);
        return "<div id='response'>Response is back baby!</div>";
        // $sse = new \starfederation\datastar\ServerSentEventGenerator();
        // $sse->sendHeaders();

        

        // $html = "<div></div>";
        // $sse->patchElements($html);
    }
} 