<label for="{{$type}}/imgs/{{$key ?? '0'}}" class="{{$class ?? ''}} col-span-2 row-span-2 my-auto bg-lettuce-200 hover:bg-opacity-75 js-img-items">
	<img src="{{asset('img/select_image.svg')}}" class="w-1/2 h-auto inline">
	<input id="{{$type}}/imgs/{{$key ?? '0'}}" type="file" name="imgs[]" class="hidden js-{{$type}}-img" multiple accept="image/jpeg, image/gif, image/png">
</label>