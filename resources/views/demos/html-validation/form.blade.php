<form action="/demos/htmx-validation"
	  method="POST"
	  class="mb-8">

	<input type="hidden" name="_token" value="{{ csrf_token() }}" />

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
						<div class="ml-auto inline-block text-xs text-gray-500">Must contain a Z</div>
					</div>
			        <input name="name" type="text" value="{{ request('name') }}">
			      </div>

			      <div class="w-1/2 grid gap-2 pl-2">
			      	<div class="flex items-center gap-2">
			        	<label>SSN @include('demos.htmx-validation.info-ssn')
						</label>
						<div class="ml-auto inline-block text-xs text-gray-500">Nine digits, verified</div>
					</div>
			        <input name="ssn" type="text" value="{{ request('ssn') }}">
			      </div>
			  </div>

		      <div class="grid gap-2">
		        <div class="flex items-center gap-2">
		        	<label>Email</label>
					<div class="ml-auto inline-block text-xs text-gray-500">Well-formatted, unique</div>
				</div>
		        <input name="email" type="email" value="{{ request('email') }}">
		      </div>

		      <div class="grid gap-2">
		        <div class="flex items-center gap-2">
		        	<label>Create Password</label>
					<div class="ml-auto inline-block text-xs text-gray-500">Unique, 8+ characters, 1 special</div>
		        </div>
		        <input type="password" name="create_password" value="{{ request('create_password') }}">
		      </div>

		      <div class="grid gap-2">
		        <div class="flex items-center gap-2">
		        	<label>Confirm Password</label>
					<div class="ml-auto inline-block text-xs text-gray-500">Must match</div>
				</div>
		        <input type="password" name="confirm_password" value="{{ request('confirm_password') }}">
		      </div>

		    </div>
		  </section>
		  <div id="errors" class="px-8">
		  	@if ($errors)
		  		@include('demos.htmx-validation.errors')
		  	@endif
		  </div>
		  <footer class="flex flex-col items-center gap-2">

		    <button type="submit" class="btn w-full">Create</button>
		    <!-- <button type="button" class="btn-outline w-full">Login with Google</button> -->
		    <p class="mt-4 text-center text-sm">Already have an account? <a href="#" class="underline-offset-4 hover:underline">Sign in</a></p>
		  </footer>
		
	</div>
</form>
