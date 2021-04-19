<div>
	<a href="https://twitter.com/share?
	url={{request()->fullUrl()}}&
	via=o_rchards&
	related=o_rchards&
	hashtags=オーチャーズ&
	text={{!empty($text)? $text : $post->user->name.'さんの投稿｜『'.$post->each()->title.'』｜Orchards'}}" 
	rel="nofollow" target="_blank" class="z-3 relative">
		<img src="{{asset('img/Twitter_Social_Icon_Circle_White.svg')}}" alt="Twitter" class="social-icon">
	</a>
</div>