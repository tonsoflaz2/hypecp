@php
    $room = \App\Models\Datastar\Room::find($signals->room_id);
    $comment = $signals->current_comment;
    $me = \App\Models\Datastar\Member::find($signals->current_member);
    $current_chat = \App\Models\Datastar\Chat::where('room_id', $room->id)
                                   ->where('member_id', $me->id)
                                   ->whereNull('sent_at')
                                   ->first();
    if (!$current_chat) {
        $current_chat = new \App\Models\Datastar\Chat;
        $current_chat->room_id = $room->id;
        $current_chat->member_id = $me->id;
    }

    if ($comment) {
        $milliseconds = round(microtime(true) * 1000);
        $current_chat->content = $comment;
        $current_chat->sent_at = $milliseconds;
        $current_chat->save();
    } else {
        $current_chat->delete();
    } 

@endphp

@mergesignals(['current_comment' => ''])

@mergefragments
    @include('wave.room')
@endmergefragments