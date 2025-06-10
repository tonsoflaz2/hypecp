<span id="validated_name" 
	  hx-swap-oob="true"
	  class="transition">

	@if (request('name'))
		@if (isset($errors['name']['contains_z']))
			<span class="text-red-500 font-bold">
				Must contain a Z
			</span>
		@else
			✅ <s>Must contain a Z</s>
		@endif
	@else
		Must contain a Z
	@endif
</span>

<span id="validated_ssn" 
	  hx-swap-oob="true"
	  class="transition">
	@if (request('ssn'))
		@if (!isset($errors['ssn']))
			✅
		@endif
		@if (isset($errors['ssn']['nine_digits']))
			<span class="text-red-500 font-bold">
				Nine digits,
			</span>
		@else
			<s>Nine digits,</s>
		@endif
		@if (isset($errors['ssn']['verified']))
			<span class="text-red-500 font-bold">
				verified
			</span>
		@else
			<s>verified</s>
		@endif
	@else
		Nine digits, verified
	@endif
</span>

<span id="validated_email" 
	  hx-swap-oob="true"
	  class="transition">
	@if (request('email'))
		@if (!isset($errors['email']))
			✅
		@endif
		@if (isset($errors['email']['format']))
			<span class="text-red-500 font-bold">
				Well-formatted,
			</span>
		@else
			<s>Well-formatted,</s>
		@endif
		@if (isset($errors['email']['unique']))
			<span class="text-red-500 font-bold">
				unique
			</span>
		@else
			<s>unique</s>
		@endif
	@else
		Well-formatted, unique
	@endif
</span>

<span id="validated_create_password" 
	  hx-swap-oob="true"
	  class="transition">
	@if (request('create_password'))
		@if (!isset($errors['create_password']))
			✅
		@endif
		
		@if (isset($errors['create_password']['length']))
			<span class="text-red-500 font-bold">
				7+ characters,
			</span>
		@else
			<s>7+ characters,</s>
		@endif
		@if (isset($errors['create_password']['special']))
			<span class="text-red-500 font-bold">
				1 special,
			</span>
		@else
			<s>1 special,</s>
		@endif
		@if (isset($errors['create_password']['unique']))
			<span class="text-red-500 font-bold">
				unique
			</span>
		@else
			<s>unique</s>
		@endif
	@else
		7+ characters, 1 special, unique
	@endif
</span>

<span id="validated_confirm_password" 
	  hx-swap-oob="true"
	  class="transition">

	@if (request('confirm_password'))
		@if (isset($errors['confirm_password']['match']))
			<span class="text-red-500 font-bold">
				Must match
			</span>
		@else
			✅ <s>Must match</s>
		@endif
	@else
		Must match
	@endif
</span>

@if (!$errors)
	<button id="submit_zdate" hx-swap-oob="true"
			type="submit" class="btn w-full">
		Create
		<img class="htmx-indicator w-5 -mr-5 opacity-0" src="/images/loading-gif.gif" />
	</button>
@else
	<button id="submit_zdate" hx-swap-oob="true"
			type="submit" disabled class="btn w-full">
		Create
		<img class="htmx-indicator w-5 -mr-5 opacity-0" src="/images/loading-gif.gif" />
	</button>
@endif


<div id="errors" hx-swap-oob="true" class="px-8 text-red-400 text-sm">
	@if (false && $errors)
		@foreach ($errors as $field => $field_errors)
			
			@foreach ($field_errors as $type => $error)
				<div class="">
					* {{ $error }}
				</div>
			@endforeach
			
		@endforeach
	@endif
</div>
