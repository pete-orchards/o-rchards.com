<img src="{{$src}}" alt="{{$type}}" class="w-10 h-10 inline bg-white rounded-lg border border-gray-400 p-1 hover:drop-shadow js-changetype-search {{$status ?? 'js-type-on'}}" data-target="{{$type}}">
@if($status)
	<input type="hidden" name="type[]" value="{{$type}}">
@endif