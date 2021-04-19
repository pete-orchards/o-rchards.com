@if(!empty($msg))
<div class="text-center p-1 bg-tomato-500 text-white my-2">
	{{$msg}}
</div>
@endif

<form action="{{route('user/home', ['user_id' => Auth::user()->user_id, 'view' => 'edit'])}}" method="post">
	@csrf
	<div class="border-b border-ivory-300 p-1 my-2">
		@include('utilities.img.user_icon', ['src' => $user->prof_path(), 'sizing' => 'w-32 h-32'])
		<div class="my-4">
			@include('utilities.forms.label', ['for' => 'name', 'name' => '名前'])
			<div class="">
				<input class="bg-lettuce-50 rounded-full w-full border border-lettuce-300 focus:border-tomato-300" id="name" type="text" name="name" value="@if($errors->all()){{old('name')}}@else{{Auth::user()->name}}@endif" required autofocus>
			</div>
			@if($errors->has('name'))
				@include('utilities.forms.alert', ['message' => $errors->first('name')])
			@endif
		</div>

		<div class="my-4">
			@include('utilities.forms.label', ['for' => 'user_id', 'name' => 'ユーザーID'])
			<div class="">
				<input class="bg-lettuce-50 rounded-full w-full border border-lettuce-300 focus:border-tomato-300" id="user_id" type="text" name="user_id" value="@if($errors->all()){{old('user_id')}}@else{{Auth::user()->user_id}}@endif" required>
			</div>
			@if($errors->has('user_id'))
				@include('utilities.forms.alert', ['message' => $errors->first('user_id')])
			@endif
		</div>
	</div>

	<div class="my-2">
		<div class="my-4">
			@component('utilities.forms.label', ['for' => 'prof_comment'])
				@slot('name')
					<img class="w-4 h-4 inline" src="{{asset('img/comment.svg')}}" alt="Comment">コメント
				@endslot
			@endcomponent
			<div>
				<textarea id="prof_comment" name="prof_comment" class="bg-lettuce-50 rounded-lg w-full border border-lettuce-300 focus:border-tomato-300">@if($errors->all()){{old('prof_comment')}}@else{{Auth::user()->detail->prof_comment}}@endif</textarea>
			</div>
			@if($errors->has('prof_comment'))
				@include('utilities.forms.alert', ['message' => $errors->first('prof_comment')])
			@endif
		</div>

		<div class="my-4">
			@component('utilities.forms.label', ['for' => 'url'])
				@slot('name')
					<img class="w-4 h-4 inline" src="{{asset('img/website.svg')}}" alt="Website">Webサイト
				@endslot
			@endcomponent
			<div class="">
				<input class="bg-lettuce-50 rounded-full w-full border border-lettuce-300 focus:border-tomato-300" id="url" type="url" name="url" value="@if($errors->all()){{old('url')}}@else{{Auth::user()->detail->url}}@endif">
			</div>
			@if($errors->has('url'))
				@include('utilities.forms.alert', ['message' => $errors->first('url')])
			@endif
		</div>

		<div class="my-4">
			@component('utilities.forms.label', ['for' => 'location'])
				@slot('name')
					<img class="w-4 h-4 inline" src="{{asset('img/location.svg')}}" alt="Website">地域
				@endslot
			@endcomponent
			<div class="">
				<input class="bg-lettuce-50 rounded-full w-full border border-lettuce-300 focus:border-tomato-300" id="location" type="text" name="location" value="@if($errors->all()){{old('location')}}@else{{Auth::user()->detail->location}}@endif">
			</div>
			@if($errors->has('location'))
				@include('utilities.forms.alert', ['message' => $errors->first('location')])
			@endif
		</div>
	</div>
		@include('utilities.buttons.submit', [
			'text' => '変更',
			'color' => 'bg-tomato-500',
		])
</form>