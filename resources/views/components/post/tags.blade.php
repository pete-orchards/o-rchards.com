@if(!empty($tags))
<div class="m-2 p-1 text-left">
	@foreach($tags as $key => $tag)
	<a class="hover:text-tomato-500" href="{{route('search', ['keyword' => '#'.$tag->name, 'type' => ['tane', 'nae', 'mi']])}}">
		@include('utilities.tags.item1', ['tag' => $tag->name])
	</a>
	@endforeach
</div>
@endif