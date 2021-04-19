<div class="border-2 border-lettuce-300 rounded-xl bg-white mx-auto p-2">
	<form action="{{route('nae.update', ['nae' => $post->nae->id])}}" method="post" enctype="multipart/form-data" class="js-nae-form" data-target="nae">
		@csrf
		<input type="hidden" name="MAX_FILE_SIZE" value="10000000">
		<input type="hidden" name="nae_id" value="{{$post->nae->id}}">
		<div class="my-4 js-length-count-container">
			@include('utilities.forms.label', ['for' => 'nae/title', 'name' => 'タイトル'])
			<div class="">
				<input class="bg-lettuce-50 rounded-full w-80 max-w-full p-1 border border-lettuce-300 focus:border-tomato-300 focus:outline-none js-length-count-target" id="nae/title" type="text" name="title" value="@if($errors->nae->all()){{old('title')}}@else{{$nae->title}}@endif" required>
			</div>
			<div class="font-black text-sm text-right">
				<span class="js-length-num">0</span>/<span class="js-length-lim">30</span>
			</div>
			@if($errors->nae->has('title'))
				@include('utilities.forms.alert', ['message' => $errors->nae->first('title')])
			@endif
		</div>

		<div class="my-4 js-length-count-container">
			@include('utilities.forms.label', ['for' => 'nae/body', 'name' => '本文'])
			@component('components.js.flex-textarea'))
				<textarea id="nae/body" name="body" class="absolute top-0 left-0 w-full h-full overflow-hidden bg-lettuce-50 rounded-xl p-1 resize-none border-box border border-lettuce-300 focus:border-tomato-300 focus:outline-none js-flex-textarea-body js-length-count-target" placeholder="" required>@if($errors->nae->all()){{old('body')}}@else{{$nae->body}}@endif</textarea>
			@endcomponent
			<div class="font-black text-sm text-right">
				<span class="js-length-num">0</span>/<span class="js-length-lim">1200</span>
			</div>
			@if($errors->nae->has('body'))
				@include('utilities.forms.alert', ['message' => $errors->nae->first('body')])
			@endif
		</div>

		@include('components.post.nae.edit.income_cost', ['type' => 'nae', 'kind' => 'incomes'])
		@include('components.post.nae.edit.income_cost', ['type' => 'nae', 'kind' => 'costs'])

		<div class="my-4">
			@if(count($post->nae->imgs)>0)
				@include('components.post.imgs', ['imgs' => $post->nae->imgs])
			@endif
		</div>

		@include('components.post.nae.edit.tag', ['id' => 'nae/tag', 'error' => $errors->nae])

		{{--バリデーション->ajaxでナエのモデルを取得->モーダルで確認->投稿--}}
		<input type="submit" value="確認する" class="inline-block text-2xl bg-tomato-500 text-white rounded-lg py-4 px-8 m-8 hover:bg-tomato-600 js-nae-confirm" name="btn_nae_confirm" data-target="js-modal/nae/confirm">
	</form>
</div>

@component('components.js.modal.content', [
	'id' => 'js-modal/nae/confirm',
	'size' => 'container m-2 max-w-screen max-h-screen',
	'opt' => 'overflow-auto',
])
<div class="text-center text-lg p-4">
	ナエの確認
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
		'opt' => 'js-nae-submit',
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
{{--	<script src="{{asset('/js/form-nae.js')}}" defar></script>--}}
	<script src="{{asset('/js/length-count.js')}}" defar></script>
@endpush
