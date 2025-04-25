<div class="status"
	 hx-get="/demos/htmx-structure/emails/{{ $email->id }}/toggle-active"
	 hx-swap="outerHTML">
	@if ($email->status == 'active')
		🔵
	@else
		✅
	@endif
</div>