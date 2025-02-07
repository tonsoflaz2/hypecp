@php

  $member_arr = session($room->code);
  $me_id = null;
  if (isset($member_arr['member_id'])) {
    $me_id = $member_arr['member_id'];
  }

@endphp

<div id="room" class="max-w-2xl mx-auto max-h-[calc(100vh-16rem)] overflow-y-auto px-4">
  <ul role="list" class="my-8 space-y-4">
      
    @foreach ($room->chats()->whereNotNull('sent_at')->orderBy('sent_at')->get() as $chat)
      <li id="chat-{{ $chat->id }}" class="relative flex gap-x-4">
        <div class="absolute -bottom-6 left-0 top-0 flex w-6 justify-center">
          <div class="w-px bg-gray-200"></div>
        </div>
        <div class="relative flex size-6 flex-none items-center justify-center bg-white">
          <div class="size-1.5 rounded-full bg-gray-100 ring-1 ring-gray-300"></div>
        </div>
        <div class="flex-auto text-gray-500 rounded-xl p-3 
                    @if ($chat->member->id == $me_id)
                      bg-slate-50
                    @else
                      bg-white
                    @endif
                    ">
          <div class="flex justify-between gap-x-4">
            <div class="py-0.5 text-xs/5 text-gray-500"><span class="font-medium text-gray-900">{{ $chat->member->name }}</span></div>
            <time class="flex-none py-0.5 text-xs/5">{{ $chat->ago }}</time>
          </div>
          <p class="text-sm/6">{!! nl2br($chat->content) !!}</p>
        </div>
      </li>
    @endforeach


      @foreach ($room->chats()->whereNull('sent_at')->get() as $livechat)
        <li id="chat-{{ $livechat->id }}" class="relative flex gap-x-4">
          <div class="absolute -bottom-6 left-0 top-0 flex w-6 justify-center">
            <div class="w-px bg-gray-200"></div>
          </div>
          <div class="relative flex size-6 flex-none items-center justify-center bg-white">
            <div class="size-1.5 rounded-full bg-gray-100 ring-1 ring-gray-700"></div>
          </div>
          <div class="flex-auto rounded-md p-3 ring-1 ring-inset ring-gray-200">
            <div class="flex justify-between gap-x-4">
              <div class="py-0.5 text-xs/5 text-gray-500"><span class="font-medium text-gray-900">{{ $livechat->member->name }}</span> is typing...</div>
              <time class="flex-none py-0.5 text-xs/5 text-gray-500">
                {{ $livechat->ago }}
              </time>
            </div>
            <p class="text-sm/6 text-gray-500">{!! nl2br($livechat->content) !!}</p>
          </div>
        </li>
      @endforeach
    
  </ul>
</div>