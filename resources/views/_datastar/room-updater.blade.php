@php
    $room = \App\Models\Datastar\Room::find($signals->room_id);

    // close this if user leaves
    ignore_user_abort(false);

    // browser was killing
    ini_set('max_execution_time', 36000);

    $last_updated = round(microtime(true) * 1000); 
    $sleeptime = 50 * 1000; // 1000 * milliseconds

@endphp


@while(true)
    @php
        $updates = \App\Models\Datastar\Chat::where('room_id', $room->id)
                                   ->where('updated_milliseconds', '>', $last_updated)
                                   ->withTrashed()
                                   ->count();                    
    @endphp

    @if ($updates > 0 || $last_updated < round(microtime(true) * 1000) - 20000)
        @mergefragments
            @include('wave.room')
        @endmergefragments

        @php($last_updated = round(microtime(true) * 1000))

        @executescript
            scrollToBottom();
            console.log("here");
        @endexecutescript

    @endif

    @php(usleep($sleeptime))

@endwhile