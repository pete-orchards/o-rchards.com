<div>
	<form method="post" action="{{route('admin.idea_theme_result.update', ['idea_theme_result' => $idea_theme_result->id])}}" enctype="multipart/form-data">
		@method('PUT')
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
				<input type="file" name="banner" value="{{$idea_theme_result->banner}}">
			</div>
		</label>
		@error('banner')
		<span class="text-red-500" role="alert">
			<strong>{{ $message }}</strong>
		</span>
		@enderror

		<label class="@error('body'){{'bg-red-600 bg-opacity-50'}}@enderror">
			<div>
				<textarea name="body" placeholder="本文" required>{{$idea_theme_result->body}}</textarea>
			</div>
		</label>
		@error('body')
		<span class="text-red-500" role="alert">
			<strong>{{ $message }}</strong>
		</span>
		@enderror


		<label class="@error('published_at'){{'bg-red-600 bg-opacity-50'}}@enderror">
			<div class="">
				公開設定: 
				<input type="radio" name="published_at" value="hidden" @if($idea_theme_result->published_at == NULL){{'checked'}}@endif> 非公開
				<input type="radio" name="published_at" value="public" @if($idea_theme_result->published_at !== NULL){{'checked'}}@endif> 公開する
			</div>
		</label>
		@error('published_at')
		<span class="text-red-500" role="alert">
			<strong>{{ $message }}</strong>
		</span>
		@enderror

		@include('utilities.buttons.submit', [
			'text' => '確定',
			'color' => 'bg-blue-400',
		])
	</form>
	<form action="{{route('admin.idea_theme_result.destroy', ['idea_theme_result' => $idea_theme_result->id])}}" method="POST">
		@method('DELETE')
		@csrf
		@include('utilities.buttons.submit', [
			'text' => '削除',
			'color' => 'bg-red-400',
		])
	</form>
</div>