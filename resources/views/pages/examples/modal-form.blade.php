
<div class="tet-lg font-black p-4">
    {{ date('Y-m-d H:i:s') }}
</div>

<div class="p-4 text-gray-500 text-left border-b">
    <div class="flex items-center mb-4 w-full">
        <div class="w-1/6">
            Type:
        </div>
        <div class="w-3/6">
            <select name="type" class="p-2 border rounded-lg w-full">
                <option value="">-- None --</option>
                <option value="Type1">Type 1</option>
                <option value="Type2">Type 2</option>
                <option value="Type3">Type 3</option>
            </select>
        </div>
    </div>

    <div class="flex mb-4 items-center w-full">
        <div class="w-1/6">
            Date:
        </div>
        <div class="w-3/6">
            <input type="date" name="date" placeholder="Date" class="form-control border rounded-lg p-2 w-full" />
        </div>
    </div>

    <input type="text" placeholder="Subject" name="subject" autocomplete="off" class="border text-lg px-4 py-3 w-full rounded-t-lg bg-gray-50" />

    <textarea id="call-log-notes" name="notes" class="border rounded-b-lg p-4 border-t-0 text-lg w-full bg-gray-50" placeholder="Message" rows="4"></textarea>

    <div class="flex items-center">
        <div class="w-2/3 p-4">
            <label class="checkbox cursor-pointer font-normal">
                <input type="checkbox" name="private">
                Private
            </label>

        </div>
    </div>
</div>

<div class="flex justify-between items-center rounded-full p-4">
    <button type="button" class="text-red-400 px-4 py-3 mx-2 hover:text-red-700 transition">
        Delete
    </button>
    <div class="flex space-x-2">
        <button onclick="window.my_modal.close()" type="button" class="bg-gray-400 text-white px-6 py-3 mx-2 rounded-full hover:bg-gray-500 transition hover:shadow-lg">
            Cancel
        </button>
        <button onclick="window.my_modal.close()" type="submit" class="bg-blue-400 text-white px-6 py-3 mx-2 rounded-full hover:bg-blue-500 transition hover:shadow-lg">
            Save
        </button>
    </div>
</div>

