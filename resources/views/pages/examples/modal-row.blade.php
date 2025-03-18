
<div id="article_{{ $article->id }}" class="flex border-b items-center">
    <div class="">
        {{ $article->content }}
    </div>
    <div>
        <button hx-get="/examples/modal-form?id={{ $article->id }}"
                hx-trigger="mouseenter"
                hx-target="#modal_content_sm"
                hx-sync="closest .buttons:replace"
                class="block m-4 text-white bg-blue-500 hover:bg-blue-600 transition rounded-full hover:shadow px-4 py-2"
                onclick="window.my_modal_sm.showModal()">
            Open Modal {{ $article->id }}
        </button>
    </div>
</div>