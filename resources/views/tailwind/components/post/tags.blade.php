@if(!empty($tags))
<div class="post-tags-container">
	@foreach($tags as $key => $tag)
	<a href="{{route('search', ['keyword' => '#'.$tag->name, 'type' => ['tane', 'nae', 'mi']])}}">
		<div class="post-tags-item p-link-zindex">
			{{'#'.$tag->name}}
		</div>
	</a>
	@endforeach
</div>
@endif