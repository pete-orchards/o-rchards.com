<div class="authform-container">
	<form method="POST" action="{{ route('register') }}">
		@csrf

		<label for="name" class="">{{ __('Name').'(公開)' }}</label>

		<div class="">
			<input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

			@error('name')
			<span class="invalid-feedback" role="alert">
				<strong>{{ $message }}</strong>
			</span>
			@enderror
		</div>

		<label for="user_id" class="">{{ __('User Id').'(公開)' }}</label>

		<div class="">
			<input id="user_id" type="text" class="form-control @error('user_id') is-invalid @enderror" name="user_id" value="{{ old('user_id') }}" placeholder="半角英数で最大30文字" required autocomplete="user_id">

			@error('user_id')
			<span class="invalid-feedback" role="alert">
				<strong>{{ $message }}</strong>
			</span>
			@enderror
		</div>

		<label for="email" class="">{{ __('E-Mail Address').'(非公開)' }}</label>

		<div class="">
			<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required placeholder="" autocomplete="email">

			@error('email')
			<span class="invalid-feedback" role="alert">
				<strong>{{ $message }}</strong>
			</span>
			@enderror
		</div>

		<label for="password" class="">{{ __('Password').'(非公開)' }}</label>

		<div class="">
			<input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required placeholder="半角英数8文字以上" autocomplete="new-password">

			@error('password')
			<span class="invalid-feedback" role="alert">
				<strong>{{ $message }}</strong>
			</span>
			@enderror
		</div>

		<label for="password-confirm" class="">{{ __('Confirm Password') }}</label>

		<div class="">
			<input id="password-confirm" type="password" class="form-control" name="password_confirmation" required placeholder="もう一度ご入力ください" autocomplete="new-password">
		</div>

		利用規約とプライバシーポリシーを確認の上、それぞれ「同意する」にチェックを入れてください

		<label for="terms" class="">{{ __('Terms') }}</label>

		<div class="">
			<span class="iframe-agree-back">
				<iframe class="iframe-agree-back" src="terms-body.php"></iframe>
			</span>
			<input id="terms" type="checkbox" class="form-control @error('terms') is-invalid @enderror" name="terms" required autocomplete="new-terms" value="1"> {{__('Agree')}}

			@error('terms')
			<span class="invalid-feedback" role="alert">
				<strong>{{ $message }}</strong>
			</span>
			@enderror
		</div>

		<label for="privacypolicy" class="">{{ __('Privacy Policy') }}</label>

		<div class="">
			<span class="iframe-agree-back">
				<iframe class="iframe-agree-back" src="privacy-policy-body.php"></iframe>
			</span>
			<input id="privacypolicy" type="checkbox" class="form-control @error('privacypolicy') is-invalid @enderror" name="privacypolicy" required autocomplete="new-privacypolicy" value="1"> {{__('Agree')}}

			@error('privacypolicy')
			<span class="invalid-feedback" role="alert">
				<strong>{{ $message }}</strong>
			</span>
			@enderror
		</div>

		<div class="">
			<button type="submit" class="button">
				{{ __('Register') }}
			</button>
		</div>
	</form>
</div>