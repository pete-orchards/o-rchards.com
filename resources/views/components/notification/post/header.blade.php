<div class="flex">
	<div class="flex-grow">
		<img class="post-small-title-icon" src="{{asset('img/'.$type.'-w.svg')}}">
		{{$post->$type->title}}
	</div>
	<div class="flex flex-row justify-end">
		<div class="">
			<a class="relative z-3 hover:text-tomato-500" href="{{$post->user->href()}}">
				<div class="m-0 inline text-right">{{$post->user->name}}</div>
				<div class="text-xs text-right w-full">{{'@'.$post->user->user_id}}</div>
			</a>
		</div>
		<div class="">
			<a class="relative z-3" href="{{$post->user->href()}}">
				<img class="w-8 h-8 border border-gray-400 rounded-full hover:border-tomato-500" src="{{$post->user->prof_path()}}">
			</a>
		</div>
	</div>
</div>