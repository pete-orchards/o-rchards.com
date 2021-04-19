@include('utilities.forms.label', ['for' => $id, 'name' => 'ハッシュタグ'])
<div class="h-auto w-full mx-auto mb-2">
	<input id="{{$id}}" type="" class="js-tagify {{$opt??''}}" name="tag" placeholder="{{__('write some tags')}}" value="@foreach($post->tags as $val){{$val->name.','}}@endforeach">
</div>

@if($error->has('tag'))
	@include('utilities.forms.alert', ['message' => $error->first('tag')])
@endif