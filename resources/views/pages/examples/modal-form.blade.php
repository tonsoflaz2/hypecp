
@php
    $article = \App\Models\Article::find(request('id'));
@endphp

<div class="font-bold text-black text-lg border-b p-4">
    <div class="float-right cursor-pointer text-gray-400 hover:text-gray-600 transition" onclick="window.my_modal.close();window.modal_content.innerHTML=''">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
          <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
        </svg>
    </div>
    Edit Article #{{ $article->id }}
</div>

<div class="w-full text-2xl p-4 text-gray-500">
    <h1>Article {{ request('id') }}</h1>
    <div>

        Content: {{ $article->content }}
</div>

<div class="flex justify-between items-center py-4 px-6">
    <form hx-post="/examples/modal"
          hx-target="#article_{{ $article->id }}"
          hx-swap="outerHTML"
          hx-on::after-request="window.my_modal.close();window.modal_content.innerHTML='';">
        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
        <input type="hidden" name="id" value="{{ $article->id }}" />
        <div>
            <textarea name="content">{{ $article->content }}</textarea>
        </div>
        <div class="flex space-x-2">

            <button onclick="window.my_modal_sm.close();window.modal_content_sm.innerHTML='';" type="button">
                Cancel
            </button>

            <button class="bg-blue-500 text-white rounded-full px-4 py-2" type="submit">
                Save
            </button>
        </div>
    </form>
</div>

