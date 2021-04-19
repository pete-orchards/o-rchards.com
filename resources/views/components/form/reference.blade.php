@if(!empty($form_post_reference))
<input type="hidden" name="reference" value="{{$form_post_reference}}">
@elseif(Auth::user()->basket_posts->count() > 0)
@include('utilities.forms.label', ['for' => $id, 'name' => 'オヤ投稿'])
<div>
	<select name="reference" id={{$id}} class="bg-lettuce-50 rounded-full w-full border border-lettuce-300 focus:border-tomato-300">
		<option value="">なし</option>
		@foreach (Auth::user()->basket_posts as $key => $basket_post)
		<option value="{{$basket_post->id}}" @if($error->all() && old('reference') == $basket_post->id){{'selected'}}@endif>『{{Str::limit($basket_post->each()->title, 15, '(...)')}}』{{'@'.$basket_post->user->name}}</option>
		@endforeach
	</select>
</div>
<div class="text-right text-xs text-gray-500">※バスケットに追加されている投稿を表示しています</div>
@if($error->has('reference'))
	@include('utilities.forms.alert', ['message' => $error->first('reference')])
@endif
@endif