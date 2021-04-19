<div class="tane-form-wrapper">
	<form action="{{route('post/tane')}}" method="post" class="js-tane-form">
		@csrf
		<div class="js-validate-error">
			<ul></ul>
		</div>
		@error('tane.common')
		<span class="err_msg" role="alert">
			<strong>{{ $message }}</strong>
		</span>\
		@enderror

		<label class="@error('tane.title') err @enderror">
			<div class="tane-form-item">
				タイトル: 
				<input type="text" name="tane[title]" value="@if(!empty(old('tane.title'))){{old('tane.title')}}@elseif(!empty($re_title)){{'Re:'.$re_title}}@endif" required>
			</div>
		</label>
		@error('tane.title')
		<span class="err_msg" role="alert">
			<strong>{{ $message }}</strong>
		</span>\
		@enderror

		<label class="@error('tane.body') err @enderror">
			<div>
				<textarea name="tane[body]" placeholder="{{ !empty($tane_placeholders) ? Arr::random($tane_placeholders) : 'あなたのアイデアのタネはなんですか？'}}" required>{{old('tane.body')}}</textarea>
			</div>
		</label>
		@error('tane.body')
		<span class="err_msg" role="alert">
			<strong>{{ $message }}</strong>
		</span>\
		@enderror

		@include('components.form.tag', ['type' => 'tane'])
		@include('components.form.reference', ['type' => 'tane'])

		<input type="submit" value="投稿する" class="button" name="btn_tane_submit">

	</form>
</div>