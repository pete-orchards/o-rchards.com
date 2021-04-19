<div class="p-h-container">
	<div class="p-h1">
		<div class="post-title">
			<img class="p-title-icon" src="{{asset('img/'.$type.'-w.svg')}}">
			{{$post->$type->title}}
		</div>
	</div>
	<div class="p-h2">
		<div class="p-h2-1">
			<a class="p-link p-link-zindex" href="{{$post->user->href()}}">
				<span class="post-name">{{$post->user->name}}</span>
				<br>
				<span class="post-userid">{{'@'.$post->user->user_id}}</span>
			</a>
		</div>
		<div class="p-h2-2">
			<div class="p-icon">
				<a class="p-link p-link-zindex"  href="{{$post->user->href()}}">
					<img class="p-icon" src="{{$post->user->prof_path()}}">
				</a>
			</div>
		</div>
	</div>
</div>