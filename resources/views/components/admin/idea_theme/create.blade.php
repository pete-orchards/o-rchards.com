<div>
	<form method="post" action="{{route('admin.idea_theme.store')}}" enctype="multipart/form-data">
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

		<label class="@error('title'){{'bg-red-600 bg-opacity-50'}}@enderror">
			<div class="">
				タイトル: 
				<input type="text" name="title" value="{{old('title')}}" required>
			</div>
		</label>
		@error('title')
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

		<label class="@error('from'){{'bg-red-600 bg-opacity-50'}}@enderror">
			<div class="">
				開始(YYYY/MM/dd): 
				<input type="text" name="from" value="{{old('from')}}" required>
			</div>
		</label>
		@error('from')
		<span class="text-red-500" role="alert">
			<strong>{{ $message }}</strong>
		</span>
		@enderror

		<label class="@error('to'){{'bg-red-600 bg-opacity-50'}}@enderror">
			<div class="">
				終了(YYYY/MM/dd): 
				<input type="text" name="to" value="{{old('to')}}" required>
			</div>
		</label>
		@error('to')
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

		<label class="@error('awards'){{'bg-red-600 bg-opacity-50'}}@enderror">
			<div>
				<textarea name="awards" placeholder="優秀賞" required>{{old('awards')}}</textarea>
			</div>
		</label>
		@error('awards')
		<span class="text-red-500" role="alert">
			<strong>{{ $message }}</strong>
		</span>
		@enderror

		<label class="@error('tag'){{'bg-red-600 bg-opacity-50'}}@enderror">
			<div class="">
				タグ: 
				<input type="text" name="tag" value="{{old('tag')}}" required>
			</div>
		</label>
		@error('tag')
		<span class="text-red-500" role="alert">
			<strong>{{ $message }}</strong>
		</span>
		@enderror

		@include('utilities.buttons.submit', [
			'text' => '確定',
			'color' => 'bg-blue-400',
		])
	</form>
</div>