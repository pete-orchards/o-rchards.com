@if($post->post_type->name === "tane")
	@include('components.notification.post.tane')
@elseif($post->post_type->name === "nae")
	@include('components.notification.post.nae')
@elseif($post->post_type->name === "mi")
	@include('components.notification.post.mi')
@else
	<div>
		エラーが発生しました
	</div>
@endif