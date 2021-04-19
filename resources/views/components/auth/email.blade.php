<div class="rounded-xl bg-lettuce-300 text-center p-1">
	@if (session('status'))
		<div class="relative py-2 px-4 mb-4 border border-green-300 bg-green-200 text-green-900" role="alert">
			{{ session('status') }}
		</div>
	@endif

	<form method="POST" action="{{ route('password.email') }}">
		@csrf

		<div class="my-4">
			@include('utilities.forms.label', ['for' => 'email', 'name' => __('E-Mail Address')])
			<div class="">
				<input class="bg-lettuce-50 rounded-full w-80 max-w-full p-1 border border-lettuce-300 mx-1 focus:border-tomato-300 focus:outline-none" id="email" type="email" name="email" value="{{old('email')}}" autocomplete="email" required autofocus>
			</div>
			@error('email')
				@include('utilities.forms.alert', ['message' => $errors->first('email')])
			@enderror
		</div>

		<button type="submit" class="inline-block text-lg mx-4 rounded-lg py-4 px-8 bg-tomato-500 text-white break-all hover:bg-opacity-75">
			{{ __('Send Password Reset Link') }}
		</button>
	</form>
</div>