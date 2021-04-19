@if(!empty($msg))
<div class="update-notice">
	{{$msg}}
</div>
@endif

@if($errors->any())
<span class="err_msg" role="alert">
	<strong>エラーが発生しました</strong>
</span>
@endif

<form action="{{route('user/home', ['user_id' => Auth::user()->user_id, 'view' => 'edit'])}}" method="post">
	@csrf
	<div class="user-header">
		<img class="ac_prof_img" src="{{$user->prof_path()}}">
		<div class="textbox">
			<div class="user-name">
				<label class="@error('name') err @enderror">
					<p><input type="text" name="name" value="@if(old('name')){{old('name')}}@else{{Auth::user()->name}}@endif"></p>
				</label>
				@error('name')
				<span class="err_msg" role="alert">
					<strong>{{ $message }}</strong>
				</span>
				@enderror
				<label class="@error('user_id') err @enderror">
					<small><input type="text" name="user_id" value="@if(old('user_id')){{old('user_id')}}@else{{Auth::user()->user_id}}@endif"></small>
				</label>
				@error('user_id')
				<span class="err_msg" role="alert">
					<strong>{{ $message }}</strong>
				</span>
				@enderror
			</div>
		</div>
	</div>

	<div>
		<div class="user-comment">
			<label class="@error('prof_comment') err @enderror">
				<img class="ac-icon" src="{{asset('img/comment.svg')}}" alt="Comment">コメント:
				<textarea name="prof_comment">@if(old('prof_comment')){{old('prof_comment')}}@else{{Auth::user()->detail->prof_comment}}@endif</textarea>
			</label>
			@error('prof_comment')
			<span class="err_msg" role="alert">
				<strong>{{ $message }}</strong>
			</span>
			@enderror
		</div>

		<div>
			<label class="@error('url') err @enderror">
				<img class="ac-icon" src="{{asset('img/website.svg')}}" alt="Website">Webサイト:
				<input type="text" name="url" value="@if(old('url')){{old('url')}}@else{{Auth::user()->detail->url}}@endif">
			</label>
			@error('url')
			<span class="err_msg" role="alert">
				<strong>{{ $message }}</strong>
			</span>
			@enderror
		</div>

		<div>
			<label class="@error('location') err @enderror">
				<p>
					<img class="ac-icon" src="{{asset('img/location.svg')}}" alt="Location">地域: <input type="text" name="location" value="@if(old('location')){{old('location')}}@else{{Auth::user()->detail->location}}@endif">
				</p>
			</label>
			@error('location')
			<span class="err_msg" role="alert">
				<strong>{{ $message }}</strong>
			</span>
			@enderror
		</div>
	</div>
	<input class="button" type="submit" name="btn_update" value="変更する">
</form>