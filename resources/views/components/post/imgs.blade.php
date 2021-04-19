@if(!empty($imgs))
{{--画像の数によりサイズを変更--}}
@php
if($imgs->count() == 1){
	$span = [
		'col-span-2 row-span-2',
	];
}elseif($imgs->count() == 2){
	$span = [
		'col-span-1 row-span-2',
		'col-span-1 row-span-2',
	];
}elseif($imgs->count() == 3){
	$span = [
		'col-span-1 row-span-2',
		'col-span-1 row-span-1',
		'col-span-1 row-span-1',
	];
}elseif($imgs->count() == 4){
	$span = [
		'col-span-1 row-span-1',
		'col-span-1 row-span-1',
		'col-span-1 row-span-1',
		'col-span-1 row-span-1',
	];
}
@endphp
<div class="m-2 p-2 grid grid-cols-2 grid-rows-2 gap-2">
	@foreach($imgs as $key => $img)
	<div class="{{$span[$key]}} js-modal-open" data-target="{{$post->id}}-img-num{{$key+1}}">
		<img src="@if(!empty($confirm)) {{url('/'.$img->confirm_path())}} @else {{url('/'.$img->img_path())}} @endif">
	</div>
	@endforeach
</div>
@endif