<div class="">
	<div class="text-lg">{{ __('Verify Your Email Address') }}</div>

	<div class="">
		@if (session('resent'))
			<div class="relative py-2 px-4 mb-4 border border-green-300 bg-green-200 text-green-900" role="alert">
				{{ __('A fresh verification link has been sent to your email address.') }}
			</div>
		@endif

		{{ __('Before proceeding, please check your email for a verification link.') }}
		{{ __('If you did not receive the email') }},
		<form class="" method="POST" action="{{ route('verification.resend') }}">
			@csrf
			<button type="submit" class="inline-block text-lg mx-4 rounded-lg py-4 px-8 bg-tomato-500 text-white break-all hover:bg-opacity-75">
				{{ __('click here to request another') }}
			</button>
		</form>
	</div>
</div>
