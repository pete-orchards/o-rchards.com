<div class="rounded-xl bg-lettuce-300 text-center p-1">
	<form method="POST" action="{{ route('login') }}">
		@csrf

		<div class="my-4">
			@include('utilities.forms.label', ['for' => 'user_id', 'name' => 'ユーザーID'])
			<div class="">
				<input class="bg-lettuce-50 rounded-full w-80 max-w-full p-1 border border-lettuce-300 mx-1 focus:border-tomato-300 focus:outline-none" id="user_id" type="text" name="user_id" value="{{old('user_id')}}" autocomplete="user_id" required>
			</div>
			@error('user_id')
				@include('utilities.forms.alert', ['message' => $errors->first('user_id')])
			@enderror
		</div>

		<div class="my-4">
			@include('utilities.forms.label', ['for' => 'password', 'name' => __('Password')])
			<div class="">
				<input class="bg-lettuce-50 rounded-full w-80 max-w-full p-1 border border-lettuce-300 mx-1 focus:border-tomato-300 focus:outline-none" id="password" type="password" name="password" value="" autocomplete="current-password" required>
			</div>
			@error('password')
				@include('utilities.forms.alert', ['message' => $errors->first('password')])
			@enderror
		</div>

		<div class="my-2">
			<div class="">
				<input class="" type="checkbox" name="remember" id="remember" {{old('remember') ? 'checked' : ''}}>

				<label class="" for="remember">
					{{ __('Remember Me') }}
				</label>
			</div>
		</div>

		@include('utilities.buttons.submit', [
			'text' => __('Login'),
			'color' => 'bg-tomato-500',
		])

		<div class="my-2">
			@if (Route::has('password.request'))
			<a class="text-sm hover:text-tomato-500" href="{{ route('password.request') }}">
				{{ __('Forgot Your Password?') }}
			</a>
			@endif
		</div>
	</form>
</div>

@push('js')
	<script src="{{asset('/js/length-count.js')}}" defar></script>
@endpush
