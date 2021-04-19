<div class="post-container wrapper home-parts">
	@if($posts)
		@each('components.post.post', $posts, 'post')
	@else
		<div>
			表示する投稿がありません。
		</div>
	@endif

</div>