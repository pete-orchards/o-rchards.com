@include('utilities.forms.label', ['for' => $id, 'name' => $name])
<div class="mx-1">
	<input class="bg-lettuce-50 rounded-full w-80 max-w-full p-1 border border-lettuce-300 focus:border-tomato-300 focus:outline-none {{$length_count ?? 'js-length-count-target'}} {{$class ?? ''}}" id="{{$id}}" type="{{$input_type ?? 'text'}}" name="{{$kind}}[{{$key ?? '0'}}][{{$input_name}}]" value="{{$value ?? ''}}" required>
</div>