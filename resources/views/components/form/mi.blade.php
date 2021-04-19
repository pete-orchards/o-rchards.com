<div class="border-2 border-tomato-500 rounded-xl bg-white mx-auto p-2">
	<form action="{{route('mi.store')}}" method="post" enctype="multipart/form-data" class="js-mi-form" data-target="mi">
		@csrf
		<input type="hidden" name="MAX_FILE_SIZE" value="10000000">

		<div class="text-red-600 js-validate-error">
			<ul></ul>
		</div>

		<div class="my-4 js-length-count-container">
			@include('utilities.forms.label', ['for' => 'mi/title', 'name' => 'タイトル'])
			<div class="">
				<input class="bg-lettuce-50 rounded-full w-80 max-w-full p-1 border border-lettuce-300 focus:border-tomato-300 focus:outline-none js-length-count-target" id="mi/title" type="text" name="title" value="@if($errors->mi->all()){{old('title')}}@elseif(!empty($re_title)){{'Re:'.$re_title}}@endif" required>
			</div>
			<div class="font-black text-sm text-right">
				<span class="js-length-num">0</span>/<span class="js-length-lim">30</span>
			</div>
			@if($errors->mi->has('title'))
				@include('utilities.forms.alert', ['message' => $errors->mi->first('title')])
			@endif
		</div>

		<div class="my-4 js-length-count-container">
			@include('utilities.forms.label', ['for' => 'mi/body', 'name' => '本文'])
			@component('components.js.flex-textarea'))
				<textarea id="mi/body" name="body" class="absolute top-0 left-0 w-full h-full overflow-hidden bg-lettuce-50 rounded-xl p-1 resize-none border-box border border-lettuce-300 focus:border-tomato-300 focus:outline-none js-flex-textarea-body js-length-count-target" placeholder="{{ !empty($mi_placeholders) ? Arr::random($mi_placeholders) : '収穫の成果をミとして共有しよう'}}" required>@if($errors->mi->all()){{old('body')}}@endif</textarea>
			@endcomponent
			<div class="font-black text-sm text-right">
				<span class="js-length-num">0</span>/<span class="js-length-lim">10000</span>
			</div>
			@if($errors->mi->has('body'))
				@include('utilities.forms.alert', ['message' => $errors->mi->first('body')])
			@endif
		</div>


		@include('components.form.income_cost', ['type' => 'mi', 'kind' => 'incomes'])
		@include('components.form.income_cost', ['type' => 'mi', 'kind' => 'costs'])

		<div class="my-4">
			@include('components.form.img', ['type' => 'mi', 'error' => $errors->mi])
		</div>

		@include('components.form.tag', ['id' => 'mi/tag', 'error' => $errors->mi])
		@auth
		@include('components.form.reference', ['id' => 'mi/reference', 'error' => $errors->mi])
		@endauth

		{{--バリデーション->ajaxでミのモデルを取得->モーダルで確認->投稿--}}
		<input type="submit" value="確認する" class="inline-block text-2xl bg-tomato-500 text-white rounded-lg py-4 px-8 m-8 hover:bg-tomato-600 js-mi-confirm" name="btn_mi_confirm" data-target="js-modal/mi/confirm">

	</form>
</div>

@component('components.js.modal.content', [
	'id' => 'js-modal/mi/confirm',
	'size' => 'container m-2 max-w-screen max-h-screen',
	'opt' => 'overflow-auto',
])
<div class="text-center text-lg p-4">
	ミの確認
</div>
{{--ここに確認のミがくる　jqueryで毎回empty()をかけるので何も入れない--}}
<div class="text-center p-4 js-dom-target">
</div>
{{--ここに投稿ボタンがくる　jqueryで毎回empty()をかけるので実際には別のsubmitボタンが表示される--}}
<div class="text-center p-4 js-submit-target">
	@include('utilities.buttons.a2', [
		'href' => '',
		'color' => 'bg-gray-600',
		'text' => '投稿する',
		'opt' => 'js-mi-submit',
	])
</div>
<div class="text-center p-4 mb-4">
	@include('utilities.buttons.a2', [
		'href' => '',
		'color' => 'bg-gray-600',
		'text' => '戻る',
		'opt' => 'js-modal-close',
	])
</div>
@endcomponent

@push('js')
	<script async src="https://cdn.jsdelivr.net/npm/exif-js"></script>
	<script src="{{asset('/js/length-count.js')}}" defar></script>
@endpush
