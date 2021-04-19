@auth
@if(!empty($form_post_reference))
<input type="hidden" name="{{$type}}[reference]" value="{{$form_post_reference}}">
@elseif(Auth::user()->basket_posts->count() > 0)
<label class="@error('{{$type}}.reference') err @enderror">
	<div>
		参考にした投稿: 
		<select name="{{$type}}[reference]">
			<option value="">なし</option>
			@foreach (Auth::user()->basket_posts as $key => $basket_post)
			<option value="{{$basket_post->id}}" @if(old('{{$type}}.reference') && old('{{$type}}.reference') == $basket_post->id) 'selected' @endif>『{{Str::limit($basket_post->each()->title, 15, '(...)')}}』{{'@'.$basket_post->user->name}}</option>
			@endforeach
		</select>
	</div>
</label>
@error('{{$type}}.reference')
<span class="err_msg" role="alert">
	<strong>{{ $message }}</strong>
</span>
@enderror
@endif
@endauth