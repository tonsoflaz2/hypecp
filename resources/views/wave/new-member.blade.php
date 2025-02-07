

	<div class="px-4 pb-6">
	<h3 class="text-base font-semibold text-gray-900">Who are you?</h3>
	<div class="mt-2 max-w-xl text-sm text-gray-500">
	  <p>Add your name to join the chat.</p>
	</div>

		<form action="/wave/members" method="POST" class="mt-5 sm:flex sm:items-center">
			@csrf
			<input type="hidden" 
				   name="room_id" 
				   value="{{ $room->id }}" />

		  <div class="w-full sm:max-w-xs">
		    <input type="text" required name="member_name" aria-label="Member Name" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-sky-600 sm:text-sm/6" placeholder="Name">
		  </div>
		  <button type="submit" class="cursor-pointer mt-3 inline-flex w-full items-center justify-center rounded-md bg-sky-600 px-3 py-1.5 text-sm font-semibold text-white shadow-sm hover:bg-sky-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-sky-600 sm:ml-3 sm:mt-0 sm:w-auto">Add New Member</button>
		</form>
	</div>

