@php
    $room = \App\Models\Datastar\Room::find($signals->room_id);

    // close this if user leaves
    ignore_user_abort(false);

    // browser was killing
    ini_set('max_execution_time', 36000);

    $last_updated = \Carbon\Carbon::now();
    $sleeptime = 50 * 1000; // 1000 * milliseconds

@endphp


@while(true)
    @php
        $updates = \App\Models\Datastar\Chat::where('room_id', $room->id)
                                   ->where('updated_at', '>', $last_updated)
                                   ->withTrashed()
                                   ->count();                    
    @endphp

    @if ($updates > 0 || $last_updated < \Carbon\Carbon::now()->subSeconds(20))
        @mergefragments
            @include('wave.room')
        @endmergefragments

        @php($last_updated = \Carbon\Carbon::now())

        @executescript
            scrollToBottom();
            console.log("here");
        @endexecutescript

    @endif

    @php(usleep($sleeptime))

@endwhile