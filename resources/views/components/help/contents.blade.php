<div class="nm-flat-ivory-200 rounded-xl p-2 mb-4" id="{{$help['id']}}">
	<div>
		<h3 class="border-b-2 border-tomato-500 text-xl pl-4 py-2 text-left">{{$help['title']}}</h3>
	</div>
	<div class="text-left py-2">
		{{$help['description']}}
	</div>
	@foreach($help['imgs'] as $img)
	<div class="my-2 w-full border border-sepia-800">
		<img class="inline w-full" src="{{asset('img/help/'.$img)}}">
	</div>
	@endforeach
</div>