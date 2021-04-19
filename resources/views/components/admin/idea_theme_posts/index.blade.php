@if($posts->count() > 0)
@foreach($posts as $post)
	<article class="grid grid-rows-3 border border-sepia-800 bg-yellow-200 hover:bg-opacity-75 p-1 m-1 rounded-xl">
		<div>
			<span class="text-xs text-gray-500">種類</span>
			<span>{{$post->post_type->name}}</span>
		</div>
		<div>
			<span class="text-xs text-gray-500">タイトル</span>
			<span>{{$post->each()->title}}</span>
		</div>
		<div>
			<span class="text-xs text-gray-500">投稿者</span>
			<span>{{$post->user->name.'@'.$post->user->user_id}}</span>
		</div>
		<div>
			<span class="text-xs text-gray-500">グッド数</span>
			<span>{{$post->goods->count()}}</span>
		</div>
		<div class="flex justify-around border-t border-sepia-800 py-1">
			<div>
				<div class="">
					@if($idea_theme->posts_all->find($post->id))
					{{$idea_theme->posts_all->find($post->id)->pivot->name}}
					@else
					<form method="post" action="{{route('admin.idea_theme.posts.store', ['idea_theme' => $idea_theme->id])}}" enctype="multipart/form-data">
						@csrf
						<input type="hidden" value="{{$post->id}}" class="" name="post_id">
						<input type="text" value="" class="" name="name">
						<input type="submit" value="追加" class="mini-button" name="btn_submit">
					</form>
					@endif
				</div>
				<div class="">
					@if($idea_theme->posts_all->find($post->id))
					<form action="{{route('admin.idea_theme.posts.destroy', [
						'idea_theme' => $idea_theme->id,
						'post' => $idea_theme->posts_all->find($post->id)->pivot->id,
						])}}" method="POST">
						@method('DELETE')
						@csrf
						<input type="hidden" value="{{$post->id}}" class="" name="post_id">
						@include('utilities.buttons.submit2', [
							'text' => '削除',
							'color' => 'bg-gray-600',
						])
					</form>
				@endif
				</div>
			</div>
			<div class="">
				@if($idea_theme->posts_all->find($post->id))
				<form method="post" action="{{route('admin.idea_theme.posts.update', [
						'idea_theme' => $idea_theme->id,
						'post' => $idea_theme->posts_all->find($post->id)->pivot->id,
					])}}">
					@method('PUT')
					@csrf
					<label class="@error('published_at') err @enderror">
						<div class="">
							<input type="radio" name="published_at" value="hidden" @if($idea_theme->posts_all->find($post->id)->pivot->published_at == NULL){{'checked'}}@endif> 非公開
							<input type="radio" name="published_at" value="public" @if($idea_theme->posts_all->find($post->id)->pivot->published_at !== NULL){{'checked'}}@endif> 公開
						</div>
					</label>
					@error('published_at')
					<span class="err_msg" role="alert">
						<strong>{{ $message }}</strong>
					</span>
					@enderror
					<input type="hidden" value="{{$post->id}}" class="" name="post_id">
					@include('utilities.buttons.submit2', [
						'text' => '変更',
						'color' => 'bg-gray-600',
					])
				</form>
				@endif
			</div>
			<div class="">
				@if($idea_theme->posts_all->find($post->id))
					@if($idea_theme->posts_all->find($post->id)->pivot->published_at !== NULL)
						@include('utilities.buttons.a2', [
							'href' => route('admin.idea_theme.posts.mail.create', [
								'idea_theme' => $idea_theme->id,
								'post' => $idea_theme->posts_all->find($post->id)->pivot->id,
							]),
							'text' => 'メール作成',
							'color' => 'bg-tomato-500',
						])
					@endif
				@endif
			</div>
		</div>
	</article>
</a>
@endforeach
@endif