<div id="registration_form" class="mb-8">

	<input data-bind-csrf_token type="hidden" value="{{ csrf_token() }}" />

	<div class="card w-full">
	  <header>
	    <h2>Create your account</h2>
	    <p>Enter your details below to begin Ze journey</p>
	  </header>
	  
		  <section>
		    <div class="form grid gap-6">

		    	<div class="flex w-full">
			      <div class="w-1/2 grid gap-2 pr-4">
			      	<div class="flex items-center gap-2">
			        	<label>Name</label>
						<div class="ml-auto inline-block text-xs text-gray-400">
							<span id="validated_name" class="transition">
								Must contain a Z
							</span>
						</div>
					</div>
			        <input type="text"
			        	   autocomplete="off" 
			        	   data-bind-name
			        	   data-on-keydown__debounce.200ms="@post('/demos/datastar-validation/validate', {headers: {'x-csrf-token':'{{ csrf_token() }}'}})"			   
			        	   value="{{ request('name') }}"
			        	   name="name">
			      </div>

			      <div class="w-1/2 grid gap-2 pl-2">
			      	<div class="flex items-center gap-2">
			        	<label>SSN @include('demos.htmx-validation.info-ssn')
						</label>
						<div class="ml-auto inline-block text-xs text-gray-400">
							<span id="validated_ssn" class="transition">
								Nine digits, verified
							</span>
						</div>
					</div>
			        <input data-bind-ssn
			        	   data-on-keydown__debounce.200ms="@post('/demos/datastar-validation/validate', {headers: {'x-csrf-token':'{{ csrf_token() }}'}})"	
			        	   required
			        	   autocomplete="off"
			        	   name="ssn" type="text" value="{{ request('ssn') }}">
			      </div>
			  </div>

		      <div class="grid gap-2">
		        <div class="flex items-center gap-2">
		        	<label>Email</label>
					<div class="ml-auto inline-block text-xs text-gray-400">
						<span id="validated_email" class="transition">
							Well-formatted, unique
						</span>
					</div>
				</div>
		        <input data-bind-email
			           data-on-keydown__debounce.200ms="@post('/demos/datastar-validation/validate', {headers: {'x-csrf-token':'{{ csrf_token() }}'}})"	
		        	   required
		        	   name="email" type="email" value="{{ request('email') }}">
		      </div>

		      <div class="grid gap-2">
		        <div class="flex items-center gap-2">
		        	<label>Create Password</label>
					<div class="ml-auto inline-block text-xs text-gray-400">
						<span id="validated_create_password" class="transition">
							7+ characters, 1 special, unique
						</span>
					</div>
		        </div>
		        <input data-bind-create_password
			        	   data-on-keydown__debounce.200ms="@post('/demos/datastar-validation/validate', {headers: {'x-csrf-token':'{{ csrf_token() }}'}})"	
		        	   required
		        	   type="password" name="create_password" value="{{ request('create_password') }}">
		      </div>

		      <div class="grid gap-2">
		        <div class="flex items-center gap-2">
		        	<label>Confirm Password</label>
					<div class="ml-auto inline-block text-xs text-gray-400">
						<span id="validated_confirm_password" class="transition">
							Must match
						</span>
					</div>
				</div>
		        <input data-bind-confirm_password
			        	   data-on-keydown__debounce.200ms="@post('/demos/datastar-validation/validate', {headers: {'x-csrf-token':'{{ csrf_token() }}'}})"	
		        	   required
		        	   type="password" name="confirm_password" value="{{ request('confirm_password') }}">
		      </div>

		    </div>
		  </section>
		  <div id="errors" 

			   data-on-load="@post('/demos/datastar-validation/validate', {headers: {'x-csrf-token':'{{ csrf_token() }}'}})"	
		  	   class="px-8">
		  	@if (isset($validation_errors) && $validation_errors)
		  		@include('demos.htmx-validation.errors')
		  	@endif
		  </div>
		  <footer class="flex flex-col items-center gap-2">

		    <button data-on-click="@post('/demos/datastar-validation', {headers: {'x-csrf-token':'{{ csrf_token() }}'}})"
		    		data-indicator="fetching"	
		    		data-attr-disabled="$fetching"
			        id="zsubmit" type="submit" class="btn w-full">
		    	Create
		    	<img class="w-5 -mr-5 opacity-0" 
		    		 data-class='{"opacity-100":$fetching}'
		    		 src="/images/loading-gif.gif" />
		    </button>
		    <!-- <button type="button" class="btn-outline w-full">Login with Google</button> -->
		    <p class="mt-4 text-center text-sm">Already have an account? <a href="#" class="underline-offset-4 hover:underline">Sign in</a></p>
		  </footer>
		
	</div>
</div>
