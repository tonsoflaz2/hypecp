
<div class="w-full text-2xl p-4 text-center p-32 text-gray-500">
    Today is <b class="text-black">{{ date('l F jS, Y') }}</b><br><br>
    The time is <b class="text-black">{{ date('g:ia') }}
</div>

<div class="flex justify-between items-center py-4 px-6">
    <div></div>
    <div class="flex space-x-2">

        <button onclick="window.my_modal.close()" type="submit">
            Got it
        </button>
    </div>
</div>

