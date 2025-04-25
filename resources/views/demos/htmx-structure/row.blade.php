<tr class="layout">
	<td width="5%">
		<span>ROW</span>
		@include('demos.htmx-structure.status')
	</td>
	<td width="10%">
		{{ $email->created_at->format('n/j/y') }}<br>
		{{ $email->created_at->diffForHumans() }}
	</td>
	<td width="35%">
		<b>{{ $email->subject }}</b><br>
		{{ $email->from }}<br>
		<div class="full"
			onclick="window.details_{{ $email->id }}.classList.toggle('hidden')">
			See full
		</div>
		{{ substr($email->full_text, 0, 50) }}<div id="details_{{ $email->id }}" class="details hidden">{!! substr($email->full_text, 50, strlen($email->full_text)) !!}</div>
	</td>
	<td width="50%">
		<div class="links layout">
			<div class="edit"
				 hx-get="/demos/htmx-structure/emails/{{ $email->id }}/row-edit"
				 hx-target="closest tr"
				 hx-trigger="mousedown"
				 hx-swap="outerHTML">
				 Manage Links
			</div>
			@php($count=0)

			@foreach ($email->tags as $tag)
				@php($count++)
				<div>Tag: {{ $tag->name }}</div>
			@endforeach
			@foreach ($email->campaigns as $campaign)
				@php($count++)
				<div>Campaign: {{ $campaign->name }}</div>
			@endforeach
			@foreach ($email->people as $person)
				@php($count++)
				<div>Person: {{ $person->name }}</div>
			@endforeach
			@if ($count < 1)
				<i>Nothing Linked</i>
			@endif
		</div>
	</td>
</tr>