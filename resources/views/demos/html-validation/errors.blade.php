
<div class="text-red-400 text-sm">
	@foreach ($errors as $field => $field_errors)
		
		@foreach ($field_errors as $type => $error)
			<div class="">
				* {{ $error }}
			</div>
		@endforeach
		
	@endforeach
</div>