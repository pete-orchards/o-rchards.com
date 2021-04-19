<div class="">
	@if($posts->isNotEmpty())

{{-- ページネーションインスタンスかどうかで分岐 --}}
	@if($posts instanceof Illuminate\Pagination\Paginator)
	@include('components.post.paginated')
	@else
	@each('components.post.post', $posts, 'post')
	@endif

	@else
	<div class="text-center p-2 text-gray-400">
		表示する投稿がありません
	</div>
	@endif
</div>