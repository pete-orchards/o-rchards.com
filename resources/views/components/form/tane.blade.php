<div class="border-2 border-chocolate-700 rounded-xl bg-white mx-auto p-4">
	<form action="{{route('tane.store')}}" method="post" class="js-tane-form">
		@csrf

		<div class="my-4 js-length-count-container">
			@include('utilities.forms.label', ['for' => 'tane/title', 'name' => 'タイトル'])
			<div class="">
				<input class="bg-lettuce-50 rounded-full w-80 max-w-full p-1 border border-lettuce-300 focus:border-tomato-300 focus:outline-none js-length-count-target" id="tane/title" type="text" name="title" value="@if($errors->tane->all()){{old('title')}}@elseif(!empty($re_title)){{'Re:'.$re_title}}@endif" required>
			</div>
			<div class="font-black text-sm text-right">
				<span class="js-length-num">0</span>/<span class="js-length-lim">30</span>
			</div>
			@if($errors->tane->has('title'))
				@include('utilities.forms.alert', ['message' => $errors->tane->first('title')])
			@endif
		</div>

		<div class="my-4 js-length-count-container">
			@include('utilities.forms.label', ['for' => 'tane/body', 'name' => '本文'])
			@component('components.js.flex-textarea'))
				<textarea id="tane/body" name="body" class="absolute top-0 left-0 w-full h-full overflow-hidden bg-lettuce-50 rounded-xl p-1 resize-none border-box border border-lettuce-300 focus:border-tomato-300 focus:outline-none js-flex-textarea-body js-length-count-target" placeholder="{{ !empty($tane_placeholders) ? Arr::random($tane_placeholders) : 'あなたのアイデアのタネはなんですか？'}}" required>@if($errors->tane->all()){{old('body')}}@endif</textarea>
			@endcomponent
			<div class="font-black text-sm text-right">
				<span class="js-length-num">0</span>/<span class="js-length-lim">140</span>
			</div>
			@if($errors->tane->has('body'))
				@include('utilities.forms.alert', ['message' => $errors->tane->first('body')])
			@endif
		</div>

		<div class="my-4">
			@include('components.form.tag', ['id' => 'tane/tag', 'error' => $errors->tane, 'opt' => 'bg-lettuce-50 rounded-full max-w-full p-1 border border-lettuce-300 focus:border-tomato-300 focus:outline-none'])
		</div>

		@auth
		<div class="my-4">
			@include('components.form.reference', ['id' => 'tane/reference', 'error' => $errors->tane])
		</div>
		@endauth

		@include('utilities.buttons.submit', [
			'text' => '投稿',
			'color' => 'bg-tomato-500',
		])
	</form>
</div>

@push('js')
	<script src="{{asset('/js/form-tane.js')}}" defar></script>
	<script src="{{asset('/js/length-count.js')}}" defar></script>
@endpush
