<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Htmx Dynamic Modal</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <!-- <meta http-equiv="refresh" content="5"> -->

    <script src="https://unpkg.com/htmx.org@2.0.3"></script>

    <style>
        dialog {
            display: flex;
            opacity: 0;
            pointer-events: none;
            transform: scale(0.9);
        }
        dialog[open] {
            display: flex;
            opacity: 1;
            transform: scale(1);
            pointer-events: inherit;
            transition: opacity 0.1s ease-in, transform 0.1s ease-in;
        }
        dialog::backdrop {
            background: rgba(0,0,0,0.3);
            backdrop-filter: blur(3px);
        }

    </style>
</head>
<body class="p-32">

    <div class="buttons">
        @for ($i=1; $i<10000; $i++)
            @php
                $article = \App\Models\Article::find($i);
                if (!$article) {
                    $article = new \App\Models\Article;
                    $article->content = "Article ".$i;
                    $article->save();
                }
            @endphp
            
            @include('pages.examples.modal-row')

        @endfor
    </div>


    <dialog id="my_modal_sm" class="rounded-lg shadow-lg w-1/3">

        <div id="modal_content_sm" class="w-full">
            <div class="p-8 text-center text-xl text-gray-400">
                Loading....
            </div>

        </div>
    </dialog>

    <dialog id="my_modal_md" class="rounded-lg shadow-lg w-1/2">

        <div id="modal_content_md" class="w-full">
            <div class="p-8 text-center text-xl text-gray-400">
                Loading....
            </div>

        </div>
    </dialog>

    <dialog id="my_modal_lg" class="rounded-lg shadow-lg w-3/4">

        <div id="modal_content_lg" class="w-full">
            <div class="p-8 text-center text-xl text-gray-400">
                Loading....
            </div>

        </div>
    </dialog>
</body>
</html>