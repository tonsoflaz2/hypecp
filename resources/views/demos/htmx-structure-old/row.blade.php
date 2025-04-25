@php
	if (!isset($email)) {
		$email = \App\Models\Structure\Email::find($id);
	}
@endphp

<tr id="row_{{ $email->id }}" class="layout">	
	<td style="width:5%;">
		<span>ROW</span>
		@include('demos.htmx-structure.status')
	</td>				
	<td style="width:10%;">
		
		{{ $email->created_at->format('n/j/y') }}<br>
		{{ $email->created_at->diffForHumans() }}
	</td>
	<td style="width:35%;">
		<div class="full"
			 onclick="window.details_{{ $email->id }}.classList.toggle('hidden')">See full</div>
		<b>{{ $email->subject }}</b><br>
		
		{{ substr($email->full_text, 0, 50) }}<div id="details_{{ $email->id }}" class="details hidden">{!! nl2br(substr($email->full_text, 50, strlen($email->full_text))) !!}
		</div>
		
	</td>
	<td style="width:50%;">
		<div class="links layout">
			<span>LINKED OBJECTS</span>
			<div class="edit"
				 hx-get="/demos/htmx-structure/emails/{{ $email->id }}/row-edit"
				 hx-target="closest tr"
				 hx-swap="outerHTML">
				Manage Links
			</div>
			@php
				$count = 0;
			@endphp

		
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

			@if (!$count)
				<i>Nothing Linked.</i>
			@endif
		</div>
	</td>
</tr>