<div>
	<form method="post" action="{{route('admin.idea_theme.posts.mail.store', ['idea_theme' => $idea_theme->id, 'post' => $idea_theme_post_id,])}}" enctype="multipart/form-data">
		@csrf
		<div class="js-validate-error">
			<ul></ul>
		</div>
		@error('common')
		<span class="text-red-500" role="alert">
			<strong>{{ $message }}</strong>
		</span>
		@enderror

		<div class="my-4 js-length-count-container">
			@include('utilities.forms.label', ['for' => 'text', 'name' => 'テキストメッセージ'])
			@component('components.js.flex-textarea'))
				<textarea id="text" name="text" class="absolute top-0 left-0 w-full h-full overflow-hidden bg-lettuce-50 rounded-xl p-1 resize-none border-box border border-lettuce-300 focus:border-tomato-300 focus:outline-none js-flex-textarea-body js-length-count-target js-textarea-target" placeholder="" required>{{old('text')}}</textarea>
			@endcomponent
			<div class="font-black text-sm text-right">
				<span class="js-length-num">0</span>/<span class="js-length-lim">1200</span>
			</div>
			@if($errors->has('text'))
				@include('utilities.forms.alert', ['text' => $errors->first('text')])
			@endif
		</div>
		@include('utilities.buttons.submit', [
			'text' => '確定',
			'color' => 'bg-blue-400',
		])
	</form>
</div>

@push('js')
	<script src="{{asset('/js/length-count.js')}}" defar></script>
@endpush
