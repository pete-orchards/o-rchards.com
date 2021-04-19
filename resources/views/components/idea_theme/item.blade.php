<header class="py-4">
	<div class="w-full">
		<img class="inline w-full h-auto" src="@if(!empty($idea_theme->result)){{url('/'.$idea_theme->result->banner_path())}}@else{{url('/'.$idea_theme->banner_path())}}@endif">
	</div>
</header>
<main class="py-2">
	<div class="border-t border-gray-400 py-2">
		<span class="text-xl text-left py-2">{{$idea_theme['title']}}</span>
	</div>

	<div class="text-xs text-right">
		<div>
			開催期間: {{$idea_theme['from']}} - {{$idea_theme['to']}}
		</div>
		{{-- 終了日を過ぎている場合自動で表示 --}}
		@if(strtotime($idea_theme['to']) < strtotime('now'))
		<span class="text-gray-400">(募集期間は終了しています)</span>
		@endif
	</div>
	<div class="text-center my-4">
		<div class="text-sm text-gray-400">
			投稿用タグ
		</div>
		<div class="text-2xl pb-2">
			<a href="{{route('search', ['keyword' => '#'.$idea_theme['tag'], 'type' => ['tane', 'nae', 'mi']])}}">
				@include('utilities.tags.item1', ['tag' => $idea_theme['tag']])
			</a>
		</div>
	</div>

	{{-- 結果発表を作成の場合に表示 (App\IdeaThemeResult) --}}
	@if(!empty($idea_theme->result))
	<div class="border-t border-gray-400 py-2">
		<div class="text-center text-2xl py-2">結果発表</div>
		{!!nl2br(e($idea_theme->result['body']))!!}
	</div>
	@if(count($idea_theme->posts))
	@include('components.post.posts', ['posts' => $idea_theme->posts])
	@endif
	@endif

	<div class="border-t border-gray-400 py-2">
		<div class="text-center text-2xl py-2">開催概要</div>
		{!!nl2br(e($idea_theme['body']))!!}
	</div>
	<div class="border-t border-gray-400 py-2">
		<div class="text-center text-2xl py-2">優秀賞</div>
		{!!nl2br(e($idea_theme['awards']))!!}
	</div>
</main>