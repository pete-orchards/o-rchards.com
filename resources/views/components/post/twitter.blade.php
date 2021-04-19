<div class="border-b border-r border-sepia-800 rounded-lg text-left hover:bg-brightness-125">
	<a href="https://twitter.com/share?
	url={{$post->$type->href()}}&
	via=o_rchards&
	related=o_rchards&
	hashtags=オーチャーズ&
	text={{!empty($text)? $text : $post->user->name.'さんの投稿｜『'.$post->each()->title.'』｜Orchards'}}" 
	rel="nofollow" target="_blank" class="relative z-3 h-full w-full">
		<img src="{{asset('img/Twitter_Social_Icon_Circle_White.svg')}}" alt="Twitter" class="w-8 h-8 p-1 inline">
	</a>
</div>