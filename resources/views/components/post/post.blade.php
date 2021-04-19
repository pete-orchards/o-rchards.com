@if($post->post_type->name === "tane")
	@include('components.post.tane', ['tane' => $post->tane, 'post_id' => $post->id])
@elseif($post->post_type->name === "nae")
	@include('components.post.nae', ['nae' => $post->nae, 'post_id' => $post->id])
@elseif($post->post_type->name === "mi")
	@include('components.post.mi', ['mi' => $post->mi, 'post_id' => $post->id])
@else
	<div>
		エラーが発生しました
	</div>
@endif