<tr class="layout">
	<td width="5%">
		<span>ROW EDIT</span>
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
		<div class="links layout editing">
			<span>EDIT LINKED OBJECTS</span>
			<div class="edit"
				 hx-get="/demos/htmx-structure/emails/{{ $email->id }}/row"
				 hx-target="closest tr"
				 hx-trigger="mousedown"
				 hx-swap="outerHTML">
				<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="width: 20px;">
				  <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
				</svg>
			</div>
			@php($count=0)

			@foreach ($email->tags as $tag)
				@php($count++)
				<form hx-post="/demos/htmx-structure/emails/{{ $email->id }}/tag-unlink"
					  hx-target="closest tr"
					  hx-swap="outerHTML"
					  hx-confirm="Are you sure you want to remove {{ $tag->name }}?">
					<input type="hidden" name="_token" value="{{ csrf_token() }}" />
					<input type="hidden" name="tag_id" value="{{ $tag->id }}" />
					<button type="submit">❌</button>
					Tag: {{ $tag->name }}
				</form>
			@endforeach
			@foreach ($email->campaigns as $campaign)
				@php($count++)
				<form hx-post="/demos/htmx-structure/emails/{{ $email->id }}/campaign-unlink"
					  hx-target="closest tr"
					  hx-swap="outerHTML"
					  hx-confirm="Are you sure you want to remove {{ $campaign->name }}?">
					<input type="hidden" name="_token" value="{{ csrf_token() }}" />
					<input type="hidden" name="campaign_id" value="{{ $campaign->id }}" />
					<button type="submit">❌</button>
					Campaign: {{ $campaign->name }}
				</form>
			@endforeach
			@foreach ($email->people as $person)
				@php($count++)
				<form hx-post="/demos/htmx-structure/emails/{{ $email->id }}/person-unlink"
					  hx-target="closest tr"
					  hx-swap="outerHTML"
					  hx-confirm="Are you sure you want to remove {{ $person->name }}?">
					<input type="hidden" name="_token" value="{{ csrf_token() }}" />
					<input type="hidden" name="person_id" value="{{ $person->id }}" />
					<button type="submit">❌</button>
					Person: {{ $person->name }}
				</form>
				
			@endforeach
			@if ($count < 1)
				<i>Nothing Linked</i>
			@endif

			<div class="link-editor">
				<div>Add Tag</div>
				<select name="tag_id"
						hx-post="/demos/htmx-structure/emails/{{ $email->id }}/tag-link"
						hx-target="closest tr"
						hx-swap="outerHTML"
						hx-vals='{"_token":"{{ csrf_token() }}"}'
						hx-trigger="change">
					<option value="">Select Tag</option>
					@foreach ($tags as $tag)
						<option value="{{ $tag->id }}">{{ $tag->name }}</option>
					@endforeach
				</select>
			</div>

			<div class="link-editor">
				<div>Add Campaign</div>
				<select name="campaign_id"
						hx-post="/demos/htmx-structure/emails/{{ $email->id }}/campaign-link"
						hx-target="closest tr"
						hx-swap="outerHTML"
						hx-vals='{"_token":"{{ csrf_token() }}"}'
						hx-trigger="change">
					<option value="">Select Campaign</option>
					@foreach ($campaigns as $campaign)
						<option value="{{ $campaign->id }}">{{ $campaign->name }}</option>
					@endforeach
				</select>
			</div>

			<div class="link-editor">
				<div>Add Person</div>
				<input type="text" name="lookup" 
					   placeholder="Person Lookup"
					   hx-get="/demos/htmx-structure/emails/{{ $email->id }}/people/lookup"
					   hx-target="#results_{{ $email->id }}"
					   hx-trigger="keyup delay:200ms"
					   hx-sync="this:replace"
					   hx-indicator="#spinner_{{ $email->id }}" />


			</div>
			<img id="spinner_{{ $email->id }}"
				 class="htmx-indicator"
				 src="/images/spinner.png" />

			<div id="results_{{ $email->id }}"></div>
		</div>

	</td>
</tr>