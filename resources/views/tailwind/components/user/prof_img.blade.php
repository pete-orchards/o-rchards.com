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

<div class="user-header">
	<img class="ac_prof_img" src="{{$user->prof_path()}}">

	<div class="textbox">
		<div class="user-name">
			<p>{{Auth::user()->name}}</p>
			<small>{{'@'.Auth::user()->user_id}}</small>
		</div>
	</div>
</div>

<br>

<div class="icon-edit-wrapper">
	<form action="" method="post" enctype="multipart/form-data">
		@csrf
		<p><input type="file" name="prof_img" class="js-iconview"></p>
		<input class="button" type="submit" name="btn_icon_submit" value="変更する">
		<input type="hidden" name="user_id" value="{{Auth::id()}}">
	</form>
</div>