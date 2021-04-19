<article class="bg-white border-5 border-lettuce-300 rounded-tr-lg rounded-bl-lg p-4 mb-4" id="{{$news['date']}}">
	<header class="mb-2">
		<div class="text-xl">
			{{$news['title']}}
		</div>
		<div class="w-full text-right">
			{{$news['date']}}
		</div>
	</header>
	<main>
		<div class="text-left">
			{!!nl2br(e($news['body']))!!}
		</div>
	</main>
</article>