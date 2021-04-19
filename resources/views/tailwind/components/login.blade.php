		<h1 class="page-title">LOG IN</h1>

		<div class="login-container">
			<form method="post" action="">
				{{csrf_field()}}
				<div class="err_msg">
					@if($errors->has('msg'))
						{{$errors->get('msg')}}
					@endif
				</div>

				<label class="
					@if($errors->has('user_id'))
						err
					@endif">
					<p>
						ユーザーID
						<input type="text" name="user_id" value="{{old('user_id')}}">
					</p>
				</label>
				<div class="err_msg">
					@if($errors->has('msg'))
						{{$errors->get('user_id')}}
					@endif
				</div>
				<label class="
					@if($errors->has('password'))
						err
					@endif">
					<p>
						パスワード
						<input type="password" name="password" value="{{old('password')}}">
					</p>
				</label>
				<div class="err_msg">
					@if($errors->has('msg'))
						{{$errors->get('password')}}
					@endif
				</div>

				<input type="submit" name="btn_login" value="ログイン" class="button">
				<label>
					<input type="checkbox" name="remember">次回から自動ログインする
				</label>
<!--
				<div class="msg-container">
					<small><a href="pass-reset.php" class="pass-reset-link">パスワードをお忘れの場合(準備中)</a></small>
				</div>
-->						
			</form>
		</div>