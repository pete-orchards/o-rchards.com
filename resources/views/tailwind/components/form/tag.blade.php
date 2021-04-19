<label class="@error($type.'.tag') err @enderror">
	<div class="tagify-container">
		<input type="" class="js-tagify {{$opt =''}}" name="{{$type}}[tag]" placeholder="{{__('write some tags')}}" value="@if(!empty(old($type.'.tag'))){{old($type.'.tag')}}@else{{$init =''}}@endif">
	</div>
</label>
@error($type.'.tag')
<span class="err_msg" role="alert">
	<strong>{{ $message }}</strong>
</span>\
@enderror
