@extends('wave.app')

@php
    
    $current_comment = null;
    $me = null;
    $member_arr = session($room->code);
    if (isset($member_arr['member_id'])) {
        $memberId = $member_arr['member_id'];
        $me = \App\Models\Datastar\Member::find($memberId);

        if ($me) {
            $livechat = \App\Models\Datastar\Chat::where('room_id', $room->id)
                                        ->where('member_id', $me->id)
                                        ->whereNull('sent_at')
                                        ->first();
            if ($livechat) {
                $current_comment = $livechat->content;
            }
        }
    }

@endphp

@section('main')

    <div class="h-screen">

        <div class="absolute top-0 w-full bg-white border-b border-gray-300 py-6 z-20">
            <div class="flex max-w-2xl mx-auto px-4 items-center">
    <div class="w-1/2">
        <div class="text-xl mb-1 font-bold">{{ $room->name }}</div>
        <a class="text-blue-400 text-sm" 
           href="{{ env('APP_URL').'/wave/'.$room->code }}">
            {{ env('APP_URL').'/wave/'.$room->code }}
        </a>
        <span copy="{{ env('APP_URL').'/wave/'.$room->code }}" class="text-xs text-gray-400 p-1 border border-gray-200 rounded ml-2 cursor-pointer hover:text-gray-800">Copy</span>
    </div>
    <div class="w-1/2 text-right text-sm">
        <div class="inline-block">
            <a href="/wave" class="text-gray-400 hover:text-gray-700 rounded-md bg-white px-2.5 py-1.5 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 cursor-pointer">
                Leave Room
            </a>
            <div class="flex justify-end mt-2">
                <a href="" class="mr-2" target="_blank">
                    <svg class="size-8" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Layer_1" viewBox="0 0 461.001 461.001" xml:space="preserve">
                        <g>
                            <path class="fill-[#bbb] hover:fill-[#666]" d="M365.257,67.393H95.744C42.866,67.393,0,110.259,0,163.137v134.728   c0,52.878,42.866,95.744,95.744,95.744h269.513c52.878,0,95.744-42.866,95.744-95.744V163.137   C461.001,110.259,418.135,67.393,365.257,67.393z M300.506,237.056l-126.06,60.123c-3.359,1.602-7.239-0.847-7.239-4.568V168.607   c0-3.774,3.982-6.22,7.348-4.514l126.06,63.881C304.363,229.873,304.298,235.248,300.506,237.056z"/>
                        </g>
                    </svg>
                </a>

                <a href="#" class="" target="_blank">
            <svg class="size-6 m-1 fill-[#bbb] hover:fill-[#666]" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
              <path fill-rule="evenodd" d="M10 0C4.477 0 0 4.484 0 10.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0110 4.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.203 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.942.359.31.678.921.678 1.856 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0020 10.017C20 4.484 15.522 0 10 0z" clip-rule="evenodd" />
            </svg>

          </a>
            </div>
        </div>
    </div>
</div>

        </div>

        <div data-on-load="{{ datastar()->get('_datastar/room-updater') }}"></div>

        <div id="chat-container" data-signals-room_id="{{ $room->id }}"
             class="absolute z-10 bottom-0 w-full">

            @include('wave.room')

            <div class="border-t border-gray-300"></div>

            <div class="w-full bg-slate-50 py-6">
                <div class="mx-auto max-w-2xl px-4 relative">
                    
                    @if ($me)
                        @include('wave.new-comment')
                    @else
                        @include('wave.new-member')
                    @endif

                </div>
                <div class="text-gray-500 absolute right-16 text-sm bottom-8">
                    <a class="flex" target="blank" href="https://data-star.dev">
                        Powered by <img class="ml-2 h-6 w-auto" src="https://data-star.dev/static/images/rocket-304e710dde0b42b15673e10937623789adf72cae569c0e0defe7ec21c0bdf293.webp" alt="Datastar">
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script>
        function scrollToBottomAlways() {
            const chatContainer = document.getElementById("room");
            if (chatContainer) {
                chatContainer.scrollTop = chatContainer.scrollHeight;
            }
        }


            function scrollToBottom() {
                const chatContainer = document.getElementById("room");
                if (chatContainer) {
                    const isAtBottom = chatContainer.scrollHeight - chatContainer.scrollTop <= chatContainer.clientHeight + 200;
                    if (isAtBottom) {
                        chatContainer.scrollTop = chatContainer.scrollHeight;
                    }
                }
            }

        window.onload = scrollToBottomAlways;

        document.addEventListener("click", function(event) {
            let target = event.target.closest("[copy]"); // Find the closest element with `copy`
            
            if (target) {
                let textToCopy = target.getAttribute("copy"); // Get the copy attribute value
                
                if (navigator.clipboard) {
                    navigator.clipboard.writeText(textToCopy).then(() => {
                        showCopyFeedback(target);
                    }).catch(err => {
                        console.error("Clipboard copy failed:", err);
                        fallbackCopyText(textToCopy);
                    });
                } else {
                    fallbackCopyText(textToCopy);
                    showCopyFeedback(target);
                }
            }
        });

        // Fallback for older browsers
        function fallbackCopyText(text) {
            const textArea = document.createElement("textarea");
            textArea.value = text;
            document.body.appendChild(textArea);
            textArea.focus();
            textArea.select();
            try {
                document.execCommand('copy');
                console.log('Copied to clipboard:', text);
            } catch (err) {
                console.error('Failed to copy:', err);
            }
            document.body.removeChild(textArea);
        }

        // Visual feedback for copied text
        function showCopyFeedback(element) {
            let originalText = element.innerText;
            element.innerText = "Copied!";
            setTimeout(() => {
                element.innerText = originalText;
            }, 2000);
        }

    </script>


@endsection