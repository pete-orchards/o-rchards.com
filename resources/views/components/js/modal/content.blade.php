<div class="hidden h-screen fixed top-0 left-0 w-full z-10 js-modal" id="{{$id}}">
	<div class="bg-black bg-opacity-25 absolute h-screen w-screen bg-blur-lg js-modal-close {{$close_opt ?? ''}}"></div>
	<div class="absolute bg-white bg-opacity-50 bg-blur-lg rounded-xl border border-white top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 m-2 z-20 p-2 max-w-lg {{$size ?? 'w-3/4 h-3/4'}} {{$opt ?? ''}}">
		{{$slot}}
	</div>
</div>