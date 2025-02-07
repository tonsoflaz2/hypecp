<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Datastar\Room;
use App\Models\Datastar\Member;
use Illuminate\Support\Str;

class WaveController extends Controller
{
    public function createRoom()
    {
        $room = new Room;
        $room->name = request('room_name');
        $room->code = strtoupper(Str::random(6));
        $room->save();
        return redirect('wave/'.$room->code);
    }
    public function createMember()
    {
        $room = Room::find(request('room_id'));
        $member = new Member;
        $member->room_id = $room->id;
        $member->name = request('member_name');
        $member->save();

        session([$room->code => ['member_id' => $member->id]]);

        return redirect('wave/'.$room->code);
    }

    public function room($code)
    {
        $room = Room::where('code', $code)
                    ->firstOrFail();

        return view('wave.main', compact('room'));
    }
}
