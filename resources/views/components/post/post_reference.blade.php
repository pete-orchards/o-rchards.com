<div class="mt-4 text-center bg-white bg-opacity-50 border border-white rounded-lg p-2" id="post_reference">
	<div class="text-lg bg-white bg-opacity-50 border border-white rounded-lg px-2 py-1 my-4 mx-auto max-w-max">▽関連する投稿▽</div>
	<div class="js-tabcontrol">
		<a href="#parent" class="inline-block hover:nm-convex-ivory-200 mx-4 my-1 p-1 rounded-lg no-underline relative z-0 @if(!empty($post->parent()->first())){{'nm-inset-ivory-200'}}@else{{'nm-flat-ivory-200'}}@endif">
			<div>
				オヤ
				<img class="w-4 h-4 inline" src="{{asset('img/arrow-up.svg')}}">
				<img class="w-4 h-4 inline" src="{{asset('img/reference.svg')}}">
			</div>
		</a>
		<a href="#child" class="inline-block hover:nm-convex-ivory-200 mx-4 my-1 p-1 rounded-lg no-underline relative z-0 @if(empty($post->parent()->first()) && !empty($post->child()->first())){{'nm-inset-ivory-200'}}@else{{'nm-flat-ivory-200'}}@endif">
			<div>
				<img class="w-4 h-4 inline" src="{{asset('img/reference.svg')}}">
				<img class="w-4 h-4 inline" src="{{asset('img/arrow-down.svg')}}">
				コドモ
			</div>
		</a>
		@auth
		<a href="#form" class="inline-block hover:nm-convex-ivory-200 mx-4 my-1 p-1 rounded-lg no-underline relative z-0 @if(empty($post->parent()->first()) && empty($post->child()->first())){{'nm-inset-ivory-200'}}@else{{'nm-flat-ivory-200'}}@endif">
			<div>
				<img class="w-4 h-4 inline" src="{{asset('img/post.svg')}}" alt="Mi">コドモを投稿する
			</div>
		</a>
		@endauth
	</div>

	<div class="js-tabbody">
		<section id="parent" class="my-2 @if(empty($post->parent()->first())){{'hidden'}}@endif">
			@if(empty($post->parent()->first()))
				オヤはありません
			@else
				@component('components.post.post', ['post' => $post->parent()->first()])
				@endcomponent
			@endif
		</section>
		<section id="child" class="my-2 @if(!empty($post->parent()->first()) && empty($post->child()->first())){{'hidden'}}@endif">
			@if(empty($post->child()->get()))
				コはありません
			@else
				@each('components.post.post', $post->child()->get(), 'post')
			@endif
		</section>

		@auth

			<section id="form" class="my-2 @if(!empty($post->parent()->first()) || !empty($post->child()->first())){{'hidden'}}@endif">
				@component('components.form.index', [
					'form_post_reference' => $post->id,
					're_title' => $post->each()->title,
				])
				@endcomponent
			</section>

		@endauth
	</div>
</div>