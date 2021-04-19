<div class="rounded-xl bg-lettuce-300 text-center p-1">
	<form method="POST" action="{{ route('register') }}">
		@csrf

		<div class="my-4">
			@include('utilities.forms.label', ['for' => 'name', 'name' => __('Name').'(公開)'])
			<div class="">
				<input class="bg-lettuce-50 rounded-full w-80 max-w-full p-1 border border-lettuce-300 focus:border-tomato-300 focus:outline-none" id="name" type="text" name="name" value="{{old('name')}}" autocomplete="name" required>
			</div>
			@error('name')
				@include('utilities.forms.alert', ['message' => $errors->first('name')])
			@enderror
		</div>

		<div class="my-4">
			@include('utilities.forms.label', ['for' => 'user_id', 'name' => __('User Id').'(公開)'])
			<div class="">
				<input class="bg-lettuce-50 rounded-full w-80 max-w-full p-1 border border-lettuce-300 focus:border-tomato-300 focus:outline-none" id="user_id" type="text" name="user_id" value="{{old('user_id')}}" placeholder="半角英数で最大30文字" autocomplete="user_id" required>
			</div>
			@error('user_id')
				@include('utilities.forms.alert', ['message' => $errors->first('user_id')])
			@enderror
		</div>

		<div class="my-4">
			@include('utilities.forms.label', ['for' => 'email', 'name' => __('E-Mail Address').'(非公開)'])
			<div class="">
				<input class="bg-lettuce-50 rounded-full w-80 max-w-full p-1 border border-lettuce-300 focus:border-tomato-300 focus:outline-none" id="email" type="email" name="email" value="{{old('email')}}" autocomplete="email" required>
			</div>
			@error('email')
				@include('utilities.forms.alert', ['message' => $errors->first('email')])
			@enderror
		</div>


		<div class="my-4">
			@include('utilities.forms.label', ['for' => 'password', 'name' => __('Password')])
			<div class="">
				<input class="bg-lettuce-50 rounded-full w-80 max-w-full p-1 border border-lettuce-300 focus:border-tomato-300 focus:outline-none" id="password" type="password" name="password" value="" autocomplete="current-password" placeholder="半角英数8文字以上" required>
			</div>
			@error('password')
				@include('utilities.forms.alert', ['message' => $errors->first('password')])
			@enderror
		</div>

		<div class="my-4">
			@include('utilities.forms.label', ['for' => 'password-confirm', 'name' => __('Confirm Password')])
			<div class="">
				<input class="bg-lettuce-50 rounded-full w-80 max-w-full p-1 border border-lettuce-300 focus:border-tomato-300 focus:outline-none" id="password-confirm" type="password" name="password-confirm" value="" autocomplete="new-password" placeholder="もう一度ご入力ください" required>
			</div>
		</div>

		<div class="">利用規約とプライバシーポリシーを確認の上、それぞれ「同意する」にチェックを入れてください</div>

		<div class="border-t border-white w-80 mx-auto p-2 my-2">
			@include('utilities.forms.label', ['for' => 'terms', 'name' => __('Terms')])
			<div class="bg-lettuce-50 rounded-xl w-64 max-w-full p-1 border border-lettuce-300 text-tomato-500 focus:border-tomato-300 mx-auto focus:outline-none mb-2 js-modal-open" data-target="js-modal/terms">利用規約を表示する</div>
				@component('components.js.modal.content', [
					'id' => 'js-modal/terms',
					'size' => 'w-11/12 h-3/4',
					'opt' => 'max-h-screen overflow-auto js-modal-tab',
					'close_opt' => 'js-modal-tab-close'
				])
					<div class="border-b border-sepia-800 pb-4">
						@include('components.terms.body')
					</div>
					<div class="text-center m-2">
						@include('utilities.buttons.a2', [
							'href' => '',
							'color' => 'bg-gray-600',
							'text' => '閉じる',
							'opt' => 'js-modal-close'
						])

					</div>
				@endcomponent
			<div class="">
				<input class="" type="checkbox" name="terms" id="terms" value="1" {{old('terms') ? 'checked' : ''}} required>

				<label class="" for="terms">
					{{ __('Agree') }}
				</label>
			</div>
			@error('terms')
				@include('utilities.forms.alert', ['message' => $errors->first('terms')])
			@enderror
		</div>

		<div class="border-t border-white w-80 mx-auto p-2 my-2">
			@include('utilities.forms.label', ['for' => 'privacypolicy', 'name' => __('Privacy Policy')])
			<div class="bg-lettuce-50 rounded-xl w-72 max-w-full p-1 border border-lettuce-300 text-tomato-500 focus:border-tomato-300 mx-auto focus:outline-none mb-2 js-modal-open" data-target="js-modal/privacy-policy">プライバシーポリシーを表示する</div>
				@component('components.js.modal.content', [
					'id' => 'js-modal/privacy-policy',
					'size' => 'w-11/12 h-3/4',
					'opt' => 'max-h-screen overflow-auto js-modal-tab',
					'close_opt' => 'js-modal-tab-close'
				])
					<div class="border-b border-sepia-800 pb-4">
						@include('components.privacy-policy.body')
					</div>
					<div class="text-center m-2">
						@include('utilities.buttons.a2', [
							'href' => '',
							'color' => 'bg-gray-600',
							'text' => '閉じる',
							'opt' => 'js-modal-close'
						])

					</div>
				@endcomponent
			<div class="">
				<input class="" type="checkbox" name="privacypolicy" id="privacypolicy" value="1" {{old('privacypolicy') ? 'checked' : ''}} required>

				<label class="" for="privacypolicy">
					{{ __('Agree') }}
				</label>
			</div>
			@error('privacypolicy')
				@include('utilities.forms.alert', ['message' => $errors->first('privacypolicy')])
			@enderror
		</div>

		@include('utilities.buttons.submit', [
			'text' => __('Register'),
			'color' => 'bg-tomato-500',
		])
	</form>
</div>

@push('js')
	<script src="{{asset('/js/length-count.js')}}" defar></script>
@endpush
