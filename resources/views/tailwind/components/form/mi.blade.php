<div class="mi-form-wrapper">
	<form action="{{route('confirm/mi')}}" method="post" enctype="multipart/form-data" class="js-mi-form" data-target="mi">
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

		<label class="@error('mi.title') err @enderror">
			<div class="mi-form-item">
				タイトル:
				<input type="text" name="mi[title]" value="{{old('mi.title')}}" required>
			</div>
		</label>
		@error('mi.title')
		<span class="err_msg" role="alert">
			<strong>{{ $message }}</strong>
		</span>
		@enderror

		<label class="@error('mi.body') err @enderror">
			<div class="mi-form-item">
				<textarea name="mi[body]" placeholder="{{Arr::random($mi_placeholders = ['収穫の成果をミとして共有しよう'])}}" required>{{old('mi.body')}}</textarea>
			</div>
		</label>
		@error('mi.body')
		<span class="err_msg" role="alert">
			<strong>{{ $message }}</strong>
		</span>
		@enderror

		@include('components.form.income_cost_table', ['type' => 'mi', 'kind' => 'income', 'old' => old('mi.income')])
		@include('components.form.income_cost_table', ['type' => 'mi', 'kind' => 'cost', 'old' => old('mi.cost')])

		<label class="@error('mi.img') err @enderror">
				<div class="n-img-showcase js-img-showcase">
					<label class="n-form-imgs js-form-img" data-target="1">
						<img src="{{asset('img/select_image.svg')}}" class="n-img-form">
						<input type="file" name="mi[img][]" class="js-mi-img mi-form-img" multiple accept="image/jpeg, image/gif, image/png">
					</label>
				</div>

				<div>
					<span class="mini-button js-add-img">画像を追加</span>
				</div>
		</label>
		@error('mi.img')
		<span class="err_msg" role="alert">
			<strong>{{ $message }}</strong>
		</span>
		@enderror

		@include('components.form.tag', ['type' => 'mi'])
		@include('components.form.reference', ['type' => 'mi'])

		@if(!empty($btn_back_msg))
		<span class="err_msg" role="alert">
			<strong>{{$btn_back_msg}}</strong>
		</span>
		@endif
		<input type="submit" value="確認する" class="js-mi-submit button" name="btn_mi_confirm">

	</form>
</div>

<script async src="https://cdn.jsdelivr.net/npm/exif-js"></script>