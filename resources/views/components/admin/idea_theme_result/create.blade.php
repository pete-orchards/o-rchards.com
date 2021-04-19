<div>
	<form method="post" action="{{route('admin.idea_theme_result.store')}}" enctype="multipart/form-data">
		@csrf
		<input type="hidden" name="MAX_FILE_SIZE" value="10000000">
		<div class="js-validate-error">
			<ul></ul>
		</div>
		@error('common')
		<span class="text-red-500" role="alert">
			<strong>{{ $message }}</strong>
		</span>
		@enderror

		<label class="@error('banner'){{'bg-red-600 bg-opacity-50'}}@enderror">
			<div class="">
				バナー: 
				<input type="file" name="banner" value="{{old('banner')}}" required>
			</div>
		</label>
		@error('banner')
		<span class="text-red-500" role="alert">
			<strong>{{ $message }}</strong>
		</span>
		@enderror

		<label class="@error('body'){{'bg-red-600 bg-opacity-50'}}@enderror">
			<div>
				<textarea name="body" placeholder="本文" required>{{old('body')}}</textarea>
			</div>
		</label>
		@error('body')
		<span class="text-red-500" role="alert">
			<strong>{{ $message }}</strong>
		</span>
		@enderror

		<input type="hidden" name="idea_theme_id" value="{{$idea_theme_id}}" required>

		@include('utilities.buttons.submit', [
			'text' => '確定',
			'color' => 'bg-blue-400',
		])
	</form>
</div>