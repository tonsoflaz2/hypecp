<form hx-post="/demos/htmx-validation"
	  hx-target=".card"
	  hx-sync="closest form:replace"
	  hx-disabled-elt="button" 
	  class="mb-8">

	<input type="hidden" name="_token" value="{{ csrf_token() }}" />

	<div class="card w-full">
	  <header>
	    <h2>Create your account</h2>
	    <p>Enter your details below to begin Ze journey</p>
	  </header>
	  
		  <section>
		    <div hx-disabled-elt="" class="form grid gap-6">

		    	<div class="flex w-full">
			      <div class="w-1/2 grid gap-2 pr-4">
			      	<div class="flex items-center gap-2">
			        	<label>Name</label>
						<div class="ml-auto inline-block text-xs text-gray-400">
							 <span id="validated_name" class="transition">Must contain a Z</span>
						</div>
					</div>
			        <input autocomplete="off"
			        	   hx-post="/demos/htmx-validation/validate"
			        	   hx-swap="none"
			        	   hx-trigger="keyup"
			        	   name="name" 
			        	   type="text" 
			        	   value="{{ request('name') }}">
			      </div>

			      <div class="w-1/2 grid gap-2 pl-2">
			      	<div class="flex items-center gap-2">
			        	<label>SSN @include('demos.htmx-validation.info-ssn')
						</label>
						<div class="ml-auto inline-block text-xs text-gray-400">
							<span id="validated_ssn" 
								  class="transition">Nine digits, verified</span>
						</div>
					</div>
			        <input autocomplete="off"
			        	   hx-post="/demos/htmx-validation/validate"
			        	   hx-swap="none"
			        	   hx-trigger="keyup"
			        	   name="ssn" 
			        	   type="text" 
			        	   value="{{ request('ssn') }}">
			      </div>
			  </div>

		      <div class="grid gap-2">
		        <div class="flex items-center gap-2">
		        	<label>Email</label>
		        	<div class="ml-auto inline-block text-xs text-gray-400">
						<span id="validated_email" 
							  class="transition">Well-formatted, unique</span>
					</div>
				</div>
		        <input autocomplete="off"
		        	   hx-post="/demos/htmx-validation/validate"
			        	   hx-swap="none"
			        	   hx-trigger="keyup delay:500ms"
			        	   name="email" 
			        	   type="email" 
			        	   value="{{ request('email') }}">
		      </div>

		      <div class="grid gap-2">
		        <div class="flex items-center gap-2">
		        	<label>Create Password</label>
					<div class="ml-auto inline-block text-xs text-gray-400">
						<span id="validated_create_password" 
							  class="transition">7+ characters, 1 special, unique</span>
					</div>
		        </div>
		        <input autocomplete="off"
		        	   hx-post="/demos/htmx-validation/validate"
		        	   hx-swap="none"
		        	   hx-trigger="keyup"
		        	   type="password" 
		        	   name="create_password" 
		        	   value="{{ request('create_password') }}">
		      </div>

		      <div class="grid gap-2">
		        <div class="flex items-center gap-2">
		        	<label>Confirm Password</label>
					<div class="ml-auto inline-block text-xs text-gray-400">
						<span id="validated_confirm_password" 
							  class="transition">Must match</span>
					</div>
				</div>
		        <input autocomplete="off"
		        	   hx-post="/demos/htmx-validation/validate"
		        	   hx-swap="none"
		        	   hx-disabled-elt="none" 
		        	   hx-trigger="keyup"
		        	   type="password" 
		        	   name="confirm_password" 
		        	   value="{{ request('confirm_password') }}">
		      </div>

		    </div>
		  </section>
		  <div id="errors"
		  	   hx-post="/demos/htmx-validation/validate"
		       hx-swap="none"
		       hx-trigger="load"
		  	   class="px-8">
		  	@if (false && $errors)
		  		@include('demos.htmx-validation.errors')
		  	@endif
		  </div>
		  <footer class="flex flex-col items-center gap-2">

		    <button id="submit_zdate"
		    		type="submit" disabled class="btn w-full">
		    	Create
		    	<img class="htmx-indicator w-5 -mr-5 opacity-0" src="/images/loading-gif.gif" />
		    </button>

		    <p class="mt-4 text-center text-sm">Already have an account? <a href="#" class="underline-offset-4 hover:underline">Sign in</a></p>
		  </footer>
		
	</div>
</form>

