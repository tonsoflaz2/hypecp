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

    @for ($i=0; $i<10; $i++)
        <button hx-get="/examples/modal-form"
                hx-trigger="mouseenter"
                hx-target="#modal-content"
                class="block m-4 text-white bg-blue-500 hover:bg-blue-600 transition rounded-full hover:shadow px-4 py-2"
                onclick="window.my_modal.showModal()">
            Open Modal
        </button>
    @endfor


    <dialog id="my_modal" class="rounded-lg shadow-lg w-3/4">

        <div class="w-full">
            <div class="font-bold text-black text-lg border-b p-4">
                <div class="float-right cursor-pointer text-gray-400 hover:text-gray-600 transition" onclick="window.my_modal.close()">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>
                </div>
                My Special Editing Modal
            </div>

            <div id="modal-content">
                <div class="p-8 text-center text-xl text-gray-400">
                    Loading....
                </div>
            </div>
        </div>
    </dialog>
</body>
</html>