<div class="rounded-xl bg-lettuce-300 text-center p-1">
	<form method="POST" action="{{route('password.update')}}">
		@csrf

		<input type="hidden" name="token" value="{{$token}}">

		<div class="my-4">
			@include('utilities.forms.label', ['for' => 'email', 'name' => __('E-Mail Address')])
			<div class="">
				<input class="bg-lettuce-50 rounded-full w-80 max-w-full p-1 border border-lettuce-300 mx-1 focus:border-tomato-300 focus:outline-none" id="email" type="email" name="email" value="{{ $email ?? old('email') }}" autocomplete="email" required autofocus>
			</div>
			@error('email')
				@include('utilities.forms.alert', ['message' => $errors->first('email')])
			@enderror
		</div>

		<div class="my-4">
			@include('utilities.forms.label', ['for' => 'password', 'name' => __('Password')])
			<div class="">
				<input class="bg-lettuce-50 rounded-full w-80 max-w-full p-1 border border-lettuce-300 mx-1 focus:border-tomato-300 focus:outline-none" id="password" type="password" name="password" value="" autocomplete="new-password" placeholder="半角英数8文字以上" required>
			</div>
			@error('password')
				@include('utilities.forms.alert', ['message' => $errors->first('password')])
			@enderror
		</div>

		<div class="my-4">
			@include('utilities.forms.label', ['for' => 'password-confirm', 'name' => __('Confirm Password')])
			<div class="">
				<input class="bg-lettuce-50 rounded-full w-80 max-w-full p-1 border border-lettuce-300 mx-1 focus:border-tomato-300 focus:outline-none" id="password-confirm" type="password" name="password-confirmation" value="" autocomplete="new-password" placeholder="もう一度ご入力ください" required>
			</div>
		</div>

		<button type="submit" class="inline-block text-lg mx-4 rounded-lg py-4 px-8 bg-tomato-500 text-white break-all hover:bg-opacity-75">
			{{ __('Reset Password') }}
		</button>
	</form>
</div>