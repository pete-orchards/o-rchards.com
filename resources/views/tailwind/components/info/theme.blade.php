<article class="theme-content-container">
	<header>
		<div>
			<img src="{{$content['banner']}}">
		</div>
	</header>

	<main>
		<div>
			<h3 class="theme-title">{{$content['title']}}</h3>
		</div>

		<div class="theme-span">
			開催期間: {{$content['from']}} - {{$content['to']}}
		</div>
		<div class="theme-tag">
			投稿用タグ: <a href="{{route('search', ['keyword' => '#'.$content['tag'], 'type' => ['tane', 'nae', 'mi']])}}"><div class="post-tags-item">{{'#'.$content['tag']}}</div></a>
		</div>


		<div>{!!nl2br(e($content['body']))!!}</div>
	</main>


	<footer>
		<div class="theme-form">
			@include('components.form.index', ['init' => $content['tag'], 'tane_placeholders' => ['楽しいアイディアを集めよう']])
		</div>
	</footer>

</article>