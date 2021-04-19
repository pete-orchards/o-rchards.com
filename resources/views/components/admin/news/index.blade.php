@if($news->count() > 0)
@foreach($news as $item)
<a href="{{route('admin.news.show', ['news' => $item->id])}}">
	<article class="grid grid-rows-2 border border-sepia-800 bg-yellow-200 hover:bg-opacity-75 p-1 m-1 rounded-xl">
		<div>{{Str::limit($item->title, 35, '(…)')}}</div>
		<div class="flex justify-around">
			<div>
				<span class="text-xs text-gray-500">id</span>
				<span>{{$item->id}}</span>
			</div>
			<div>
				<div class="text-xs text-gray-500">日付</div>
				<div>{{$item->date}}</div>
			</div>
			<div>
				<div class="text-xs text-gray-500">公開日</div>
				<div>
					@if($item->published_at == NULL)
					非公開
					@else
					{{$item->published_at->format('Y/m/d')}}
					@endif
				</div>
			</div>
		</div>
	</article>
</a>
@endforeach
@endif