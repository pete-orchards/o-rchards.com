<div class="p-4">
	<div>

		@include('utilities.img.user_icon', ['src' => $user->prof_path(), 'sizing' => 'w-32 h-32'])
	</div>

	<div class="">
		<div class="">
			<div class="text-lg">{{$user->name}}</div>
			<span class="text-sm">{{'@'.$user->user_id}}</span>
		</div>
	</div>
</div>

<div class="my-2 border-t border-ivory-400">
	<div class="text-left my-1">
		<img class="inline w-4 h-4" src="{{asset('img/comment.svg')}}" alt="Comment">コメント:
		@if($user->detail->prof_comment)
		<p>{!!nl2br(e($user->detail->prof_comment))!!}</p>
		@else
		{{__('Not set')}}
		@endif
	</div>

	<div class="text-left my-1">
		<img class="inline w-4 h-4" src="{{asset('img/website.svg')}}" alt="Website">Webサイト:
		@if($user->detail->url)
		<a href="{{$user->detail->url}}" class="hover:text-tomato-500" target="_blank" rel="noopener">{{$user->detail->url}}</a>
		@else
		{{__('Not set')}}
		@endif
	</div>

	<div class="text-left my-1">
		<p>
			<img class="inline w-4 h-4" src="{{asset('img/location.svg')}}" alt="Location">地域: 
			@if($user->detail->location)
			{{$user->detail->location}}
			@else
			{{__('Not set')}}
			@endif
		</p>
	</div>
</div>