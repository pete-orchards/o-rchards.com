<div>
	<form method="post" action="{{route('admin.news.store')}}">
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
				<input type="text" name="title" value="{{old('title')}}" required>
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
				<input type="text" name="date" value="{{old('date')}}" required>
			</div>
		</label>
		@error('date')
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

		@include('utilities.buttons.submit', [
			'text' => '確定',
			'color' => 'bg-blue-400',
		])
	</form>
</div>