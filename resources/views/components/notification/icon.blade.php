<div class="relative text-center">
	<div>
		<img src="{{$src}}" class="w-8 h-8 inline">
		@if($notification->isUnreceived())
		<span class="absolute bg-tomato-500 rounded-full border border-white w-3 h-3 top-0.5 right-0.5"></span>
		@endif
	</div>
	<div class="text-xs">{{$name}}</div>
</div>