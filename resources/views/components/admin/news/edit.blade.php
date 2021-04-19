<div>
	<form method="post" action="{{route('admin.news.update', ['news' => $news->id])}}">
		@method('PUT')
		@csrf
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
				<input type="text" name="title" value="{{$news->title}}" required>
			</div>
		</label>
		@error('title')
		<span class="text-red-500" role="alert">
			<strong>{{ $message }}</strong>
		</span>
		@enderror

		<label class="@error('date'){{'bg-red-600 bg-opacity-50'}}@enderror">
			<div class="">
				日付(YYYY/MM/dd): 
				<input type="text" name="date" value="{{$news->date}}" required>
			</div>
		</label>
		@error('date')
		<span class="text-red-500" role="alert">
			<strong>{{ $message }}</strong>
		</span>
		@enderror

		<label class="@error('body'){{'bg-red-600 bg-opacity-50'}}@enderror">
			<div>
				<textarea name="body" placeholder="本文" required>{{$news->body}}</textarea>
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
				<input type="radio" name="published_at" value="hidden" @if($news->published_at == NULL){{'checked'}}@endif> 非公開
				<input type="radio" name="published_at" value="public" @if($news->published_at !== NULL){{'checked'}}@endif> 公開する
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
	<form action="{{route('admin.news.destroy', ['news' => $news->id])}}" method="POST">
		@method('DELETE')
		@csrf
		@include('utilities.buttons.submit', [
			'text' => '削除',
			'color' => 'bg-red-400',
		])
	</form>
</div>