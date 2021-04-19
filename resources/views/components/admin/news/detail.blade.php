<div>
	<div class="border border-sepia-800 my-2 p-1">
		<span class="">{{$news->title}}</span>
		日付: {{$news->date}}
		<div>
			本文: 
			<div>
				{!!nl2br(e($news->body))!!}
			</div>
		</div>
		<small>投稿日: {{($news->created_at)->format('Y/m/d')}}</small><br/>
		<small>更新日: {{($news->updated_at)->format('Y/m/d')}}</small>
		<a href="{{route('admin.news.edit', ['news' => $news->id])}}">編集</a>
	</div>
</div>
