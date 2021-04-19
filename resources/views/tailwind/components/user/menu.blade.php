<aside class="user-menu">
	<nav>
		<ul class="user-menu-nav">
			<li class="@if($view == 'home') menu-show @endif">
				<div>
					<a href="{{route('user/home', ['user_id' => Auth::user()->user_id])}}">
						<img class="logo-user-nav-icon" src="{{Auth::user()->prof_path()}}" alt="User Home">
						<p class="ac-menu-tag">
							マイアカウント
							<br>トップ
						</p>
					</a>
				</div>
			</li>
			<li class="@if($view == 'edit') menu-show @endif">
				<div>
					<a href="{{route('user/home', ['user_id' => Auth::user()->user_id, 'view' => 'edit'])}}">
						<img class="logo-user-nav" src="{{asset('img/edit_1.svg')}}" alt="Edit">
						<p class="ac-menu-tag">プロフィール編集</p>
					</a>
				</div>
			</li>
			<li class="@if($view == 'prof_img') menu-show @endif">
				<div>
					<a href="{{route('user/home', ['user_id' => Auth::user()->user_id, 'view' => 'prof_img'])}}">
						<img class="logo-user-nav" src="{{asset('img/change_icon.svg')}}" alt="Icon Edit">
						<p class="ac-menu-tag">
							アイコン画像変更
						</p>
					</a>
				</div>
			</li>
			<li>
				<div>
					<form method="post" action="{{route('logout')}}">
						@csrf
						<input class="logo-user-nav" type="image" src="{{asset('img/logout_1.svg')}}" name="logout">
						<p>
							<input type="submit" class="ac-menu-tag" name="logout" value="LOGOUT">
						</p>
					</form>
					</a>
				</div>
			</li>
		</u1>
	</nav>

	@include('components.footer')
</aside>