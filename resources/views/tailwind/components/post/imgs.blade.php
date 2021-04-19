@if(!empty($imgs))
	<div class="img-container img-length-{{$imgs->count()}}">
		@foreach($imgs as $key => $img)
			<div class="nae-img img-num{{$key+1}} js-modal-open" data-target="{{$post->id}}-img-num{{$key+1}}"><img src="@if(!empty($confirm)) {{url('/'.$img->confirm_path())}} @else {{url('/'.$img->img_path())}} @endif"></div>
		@endforeach
	</div>
@endif