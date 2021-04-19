<div class="user-header">
	<div>

		<img class="ac_prof_img" src="{{$user->prof_path()}}">
	</div>

	<div class="textbox">
		<div class="user-name">
			<p>{{$user->name}}</p>
			<small>{{'@'.$user->user_id}}</small>
		</div>
	</div>
</div>

<div style="margin:10px auto; ">
	<div>
		<img class="ac-icon" src="{{asset('img/comment.svg')}}" alt="Comment">コメント:
		@if($user->detail->prof_comment)
		<p>{!!nl2br(e($user->detail->prof_comment))!!}</p>
		@else
		{{__('Not set')}}
		@endif
	</div>
	<br>

	<div>
		<img class="ac-icon" src="{{asset('img/website.svg')}}" alt="Website">Webサイト:
		@if($user->detail->url)
		<a href="{{$user->detail->url}}" target="_blanc">{{$user->detail->url}}</a>
		@else
		{{__('Not set')}}
		@endif
	</div>

	<div>
		<p>
			<img class="ac-icon" src="{{asset('img/location.svg')}}" alt="Location">地域: 
			@if($user->detail->location)
			{{$user->detail->location}}
			@else
			{{__('Not set')}}
			@endif
		</p>
	</div>
</div>