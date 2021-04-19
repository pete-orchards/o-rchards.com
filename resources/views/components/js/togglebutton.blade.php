<button type="button" class="rounded-xl w-12 box-border p-1 focus:border focus:border-gray-400 @if($data){{'nm-inset-lettuce-300 text-right'}}@else{{'nm-inset-gray-400 text-left'}}@endif js-togglebutton" data-columnname="{{$column_name}}" data-userid="{{$user_id}}" data-status="@if($data){{'on'}}@else{{'off'}}@endif" data-csrftoken="{{csrf_token()}}" {{$opt ?? ''}}>
	<div class="rounded-full w-4 h-4 bg-ivory-200 shadow-md p-1 box-border inline-block"></div>
</button>