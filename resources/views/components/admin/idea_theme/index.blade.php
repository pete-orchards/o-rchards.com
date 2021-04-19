@if($idea_theme->count() > 0)
@foreach($idea_theme as $item)
<a href="{{route('admin.idea_theme.show', ['idea_theme' => $item->id])}}">
	<article class="grid grid-rows-3 border border-sepia-800 bg-yellow-200 hover:bg-opacity-75 p-1 m-1 rounded-xl">
		<div>
			<img src="{{url('/'.$item->banner_path())}}" class="w-full">
		</div>
		<div class="flex justify-around">
			<div>
				<div>
					<span class="text-xs text-gray-500">id</span>
					<span>{{$item->id}}</span>
				</div>
				<div>
					<span class="text-xs text-gray-500">タグ</span>
					{{$item->tag}}
				</div>
			</div>
			<div>
				<div>
					<span class="text-xs text-gray-500">開始</span>
					{{$item->from}}
				</div>
				<div>
					<span class="text-xs text-gray-500">終了</span>
					{{$item->to}}
				</div>
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
		<div class="flex justify-around">
			<div>
				<div class="text-xs text-gray-500">結果発表</div>
				<div>
					@if(!empty($item->result_all))
					<div class="text-xs">作成済み</div>
					@if($item->result_all->published_at == NULL)
					非公開
					@else
					公開済み
					@endif
					@include('utilities.buttons.a2', [
						'text' => '編集',
						'href' => route('admin.idea_theme_result.edit', ['idea_theme_result' => $item->result_all->id]),
						'color' => 'bg-yellow-700',
					])
					@else
					<div class="text-xs">未作成</div>
					@include('utilities.buttons.a2', [
						'text' => '作成する',
						'href' => route('admin.idea_theme_result.create', ['idea_theme_id' => $item->id]),
						'color' => 'bg-yellow-700',
					])
					@endif
				</div>
			</div>
			<div>
				<div class="text-xs text-gray-500">投稿の表彰</div>
				<div>
					@if(count($item->posts_all))
					@foreach($item->posts_all as $post)
					{{$post->id}}/
					@if($item->posts_all->find($post->id)->pivot->published_at == NULL)
					非公開
					@else
					公開済み
					@endif
					<br>
					@endforeach
					@endif
					<div>
						<div class="text-xs">0件</div>
						@include('utilities.buttons.a2', [
							'text' => '編集する',
							'href' => route('admin.idea_theme.posts.index', ['idea_theme' => $item->id]),
							'color' => 'bg-yellow-700',
						])
					</div>
				</div>
			</div>
		</div>
	</article>
</a>
@endforeach
@endif
