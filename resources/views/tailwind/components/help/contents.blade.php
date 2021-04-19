<div class="help-contents-container">
	<div>
		<h3 class="help-subtitle">{{$title}}</h3>
	</div>
	@foreach($contents as $key => $val)
	<img src="{{asset('img/help/'.$val)}}">
	@endforeach
</div>