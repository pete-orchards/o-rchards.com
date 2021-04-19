<div>
	<form method="post" action="{{route('admin.idea_theme.update', ['idea_theme' => $idea_theme->id])}}" enctype="multipart/form-data">
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

		<label class="@error('title'){{'bg-red-600 bg-opacity-50'}}@enderror">
			<div class="">
				タイトル: 
				<input type="text" name="title" value="{{$idea_theme->title}}" required>
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
				<input type="file" name="banner" value="{{$idea_theme->banner}}">
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
				<input type="text" name="from" value="{{$idea_theme->from}}" required>
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
				<input type="text" name="to" value="{{$idea_theme->to}}" required>
			</div>
		</label>
		@error('to')
		<span class="text-red-500" role="alert">
			<strong>{{ $message }}</strong>
		</span>
		@enderror

		<label class="@error('body'){{'bg-red-600 bg-opacity-50'}}@enderror">
			<div>
				<textarea name="body" placeholder="本文" required>{{$idea_theme->body}}</textarea>
			</div>
		</label>
		@error('body')
		<span class="text-red-500" role="alert">
			<strong>{{ $message }}</strong>
		</span>
		@enderror

		<label class="@error('awards'){{'bg-red-600 bg-opacity-50'}}@enderror">
			<div>
				<textarea name="awards" placeholder="優秀賞" required>{{$idea_theme->awards}}</textarea>
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
				<input type="text" name="tag" value="{{$idea_theme->tag}}" required>
			</div>
		</label>
		@error('tag')
		<span class="text-red-500" role="alert">
			<strong>{{ $message }}</strong>
		</span>
		@enderror


		<label class="@error('published_at'){{'bg-red-600 bg-opacity-50'}}@enderror">
			<div class="">
				公開設定: 
				<input type="radio" name="published_at" value="hidden" @if($idea_theme->published_at == NULL){{'checked'}}@endif> 非公開
				<input type="radio" name="published_at" value="public" @if($idea_theme->published_at !== NULL){{'checked'}}@endif> 公開する
				@if($idea_theme->published_at !== NULL)
				<input type="radio" name="published_at" value="public_all"> 子要素も全て公開
				@endif
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
	<form action="{{route('admin.idea_theme.destroy', ['idea_theme' => $idea_theme->id])}}" method="POST">
		@method('DELETE')
		@csrf
		@include('utilities.buttons.submit', [
			'text' => '削除',
			'color' => 'bg-red-400',
		])
	</form>

	@include('utilities.buttons.a1', [
		'text' => '一覧へ',
		'href' => route('admin.idea_theme.index'),
		'color' => 'bg-yellow-700',
	])

</div>