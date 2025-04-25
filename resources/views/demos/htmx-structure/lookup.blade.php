@foreach ($people as $person)

	<form class="lookup-person"
		  hx-post="/demos/htmx-structure/emails/{{ $email->id }}/person-link"
		  hx-target="closest tr"
		  hx-swap="outerHTML">
		  <input type="hidden" name="_token" value="{{ csrf_token() }}" />
		  <input type="hidden" name="person_id" value="{{ $person->id }}" />
		<div>{{ $person->name }}</div>
		<div>{{ $person->city }}</div>
		<button type="submit">Link Person</button>
	</form>

@endforeach