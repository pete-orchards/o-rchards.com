<div class="login-container">
	<form method="POST" action="{{ route('login') }}">
		@csrf

		<label for="user_id" class="">{{ __('User Id') }}</label>

		<div class="">
			<input id="user_id" type="user_id" class="form-control @error('user_id') is-invalid @enderror" name="user_id" value="{{ old('user_id') }}" required autocomplete="user_id" autofocus>

			@error('user_id')
			<span class="err_msg" role="alert">
				<strong>{{ $message }}</strong>
			</span>\
			@enderror
		</div>

		<label for="password" class="">{{ __('Password') }}</label>

		<div class="">
			<input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

			@error('password')
			<span class="invalid-feedback" role="alert">
				<strong>{{ $message }}</strong>
			</span>
			@enderror
		</div>

		<div class="">
			<div class="form-check">
				<input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

				<label class="form-check-label" for="remember">
					{{ __('Remember Me') }}
				</label>
			</div>
		</div>

		<div class="">
			<button type="submit" class="button">
				{{ __('Login') }}
			</button>
		</div>

		<div>
			@if (Route::has('password.request'))
			<a class="btn btn-link" href="{{ route('password.request') }}">
				{{ __('Forgot Your Password?') }}
			</a>
			@endif
		</div>
	</form>
</div>