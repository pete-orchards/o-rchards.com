<nav class="nm-flat-ivory-200 my-2 rounded-xl text-left py-2 px-4">
	目次 <span class="text-sm text-gray-400">(クリックで移動します)</span>
	<ul class="ml-4">
		@foreach($helps as $help)
		<li><a href="{{'#'.$help['id']}}" class="hover:text-tomato-500">{{$help['title']}}</a></li>
		@endforeach
	</ul>
</nav>