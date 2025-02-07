<div class="flex gap-x-3">
                      
  <div class="relative flex size-6 flex-none items-center justify-center">
      <div class="size-1.5 rounded-full bg-gray-100 ring-1 ring-gray-700"></div>
    </div>

  <div action="#" class="relative flex-auto">
    <div class="shadow overflow-hidden rounded-lg pb-12 outline outline-1 -outline-offset-1 outline-gray-300 focus-within:outline focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
      <label for="comment" class="sr-only">Add your comment</label>
      <div data-signals-current_member="{{ $me->id }}"></div>
      <div data-signals-current_comment="'{{ $current_comment }}'"></div>
      <textarea data-bind="current_comment" 
                data-on-input="{{ datastar()->get('_datastar/update-comment') }}"
                data-on-keydown="evt.key === 'Enter' && !evt.shiftKey && (evt.preventDefault(), {{ datastar()->post('_datastar/post-comment') }})"
                rows="2" class="block bg-white w-full resize-none bg-transparent px-3 py-1.5 text-base text-gray-900 placeholder:text-gray-400 focus:outline focus:outline-0 sm:text-sm/6" 
                placeholder="{{ $me->name }} comment..."></textarea>

      </div>

      <div class="absolute inset-x-0 bottom-0 flex justify-between py-2 pl-3 pr-2">
          <button type="submit" 
                  data-on-click="{{ datastar()->post('_datastar/post-comment') }}"
                  class="no-hype rounded-md bg-white px-2.5 py-1.5 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 cursor-pointer">
              Comment
          </button>
      </div>

  </div>
</div>