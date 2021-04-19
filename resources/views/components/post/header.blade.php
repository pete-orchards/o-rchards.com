<div class="flex flex-col max-h-32">
	<div class="">
	@if(empty($confirm))
		@if(!preg_match('/^'.$type.'/' , request()->path()) && empty($confirm) || request()->path() !== $type.'/'.$post->$type->id)
			<a class="relative z-2" href="{{$post->$type->href()}}">
		@endif
	@endif
				<div class="text-left text-xl mt-1 w-max border-b border-white flex items-baseline">
					<img class="w-10 h-10 inline mr-1" src="{{asset('img/'.$type.'-w.svg')}}">
					<span class="break-words">{{$post->$type->title}}</span>
				</div>
	@if(empty($confirm))
		@if(!preg_match('/^'.$type.'/' , request()->path()) && empty($confirm) || request()->path() !== $type.'/'.$post->$type->id)
			</a>
		@endif
	@endif
	</div>
	<div class="flex flex-row justify-end">
		<div class="">
			<a class="relative z-3 hover:text-tomato-500" href="{{$post->user->href()}}">
				<div class="m-0 inline text-right">{{$post->user->name}}</div>
				<div class="text-xs text-right w-full">{{'@'.$post->user->user_id}}</div>
			</a>
		</div>
		<div class="flex justify-center items-center">
			<a class="relative z-3" href="{{$post->user->href()}}">
				@include('utilities.img.user_icon', ['src' => $post->user->prof_path()])
			</a>
		</div>
	</div>
</div>