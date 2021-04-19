<div class="nae-form-wrapper">
	<form action="{{route('confirm/nae')}}" method="post" enctype="multipart/form-data" class="js-nae-form" data-target="nae">
		@csrf
		<input type="hidden" name="MAX_FILE_SIZE" value="10000000">

		<div class="js-validate-error">
			<ul></ul>
		</div>
		@if($errors->any())
		<span class="err_msg" role="alert">
			<strong>エラーが発生しました</strong>
		</span>
		@endif

		<label class="@error('nae.title') err @enderror">
			<div class="nae-form-item">
				タイトル:
				<input type="text" name="nae[title]" value="{{old('nae.title')}}" required>
			</div>
		</label>
		@error('nae.title')
		<span class="err_msg" role="alert">
			<strong>{{ $message }}</strong>
		</span>
		@enderror

		<label class="@error('nae.body') err @enderror">
			<div class="nae-form-item">
				<textarea name="nae[body]" placeholder="{{Arr::random($nae_placeholders = ['どんなナエに育ちそうですか？'])}}" required>{{old('nae.body')}}</textarea>
			</div>
		</label>
		@error('nae.body')
		<span class="err_msg" role="alert">
			<strong>{{ $message }}</strong>
		</span>
		@enderror

		@include('components.form.income_cost_table', ['type' => 'nae', 'kind' => 'income', 'old' => old('nae.income')])
		@include('components.form.income_cost_table', ['type' => 'nae', 'kind' => 'cost', 'old' => old('nae.cost')])

		<label class="@error('nae.img') err @enderror">
				<div class="n-img-showcase js-img-showcase">
					<label class="n-form-imgs js-form-img" data-target="1">
						<img src="{{asset('img/select_image.svg')}}" class="n-img-form">
						<input type="file" name="nae[img][]" class="js-nae-img nae-form-img" multiple accept="image/jpeg, image/gif, image/png">
					</label>
				</div>

				<div>
					<span class="mini-button js-add-img">画像を追加</span>
				</div>
		</label>
		@error('nae.img')
		<span class="err_msg" role="alert">
			<strong>{{ $message }}</strong>
		</span>
		@enderror

		@include('components.form.tag', ['type' => 'nae'])
		@include('components.form.reference', ['type' => 'nae'])

		@if(!empty($btn_back_msg))
		<span class="err_msg" role="alert">
			<strong>{{$btn_back_msg}}</strong>
		</span>
		@endif
		<input type="submit" value="確認する" class="js-nae-submit button" name="btn_nae_confirm">

	</form>
</div>

<script async src="https://cdn.jsdelivr.net/npm/exif-js"></script>