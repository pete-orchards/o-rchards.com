<aside class="max-w-lg mx-auto bg-lettuce-200 bg-blur-lg border border-white rounded-tr-lg transform overflow-auto max-h-screen md:fixed md:left-0 md:bottom-0 md:w-32">
	<nav class="p-2">
		<div class="text-sm font-bold border-b-2 border-lettuce-400 m-1">マイページナビ</div>
		<ul class="flex flex-col text-left text-uppercase">
			<li class="@if($view == 'home'){{'bg-lettuce-300'}}@endif">
				<div>
					<a class="hover:text-tomato-500" href="{{route('user/home', ['user_id' => Auth::user()->user_id])}}">
						<img class="w-8 h-8 inline rounded-full border-gray-400 border" src="{{Auth::user()->prof_path()}}" alt="User Home">
						<span class="text-xs">
							トップ
						</span>
					</a>
				</div>
			</li>
			<li class="@if($view == 'edit'){{'bg-lettuce-300'}}@endif">
				<div>
					<a class="hover:text-tomato-500" href="{{route('user/home', ['user_id' => Auth::user()->user_id, 'view' => 'edit'])}}">
						<img class="w-8 h-8 inline" src="{{asset('img/edit_1.svg')}}" alt="Edit">
						<span class="text-xs">編集</span>
					</a>
				</div>
			</li>
			<li class="@if($view == 'prof_img'){{'bg-lettuce-300'}}@endif">
				<div>
					<a class="hover:text-tomato-500" href="{{route('user/home', ['user_id' => Auth::user()->user_id, 'view' => 'prof_img'])}}">
						<img class="w-8 h-8 inline" src="{{asset('img/change_icon.svg')}}" alt="Icon Edit">
						<span class="text-xs">
							アイコン変更
						</span>
					</a>
				</div>
			</li>
			<li class="@if($view == 'config'){{'bg-lettuce-300'}}@endif">
				<div>
					<a class="hover:text-tomato-500" href="{{route('user/home', ['user_id' => Auth::user()->user_id, 'view' => 'config'])}}">
						<img class="w-8 h-8 inline" src="{{asset('img/config.svg')}}" alt="Icon Edit">
						<span class="text-xs">
							設定
						</span>
					</a>
				</div>
			</li>
			<li>
				<div>
					<form method="post" action="{{route('logout')}}">
						@csrf
						<input class="w-8 h-8 inline" type="image" src="{{asset('img/logout_1.svg')}}" name="logout">
						<div class="inline-block relative h-8">
						<span class="absolute top-0.5  transform translate-y-1/2">
							<input type="submit" class="text-xs bg-lettuce-200" name="ログアウト" value="LOGOUT">
						</span>
					</form>
					</a>
				</div>
			</li>
			@if(Auth::user()->isAdmin())
			<li>
				<div>
					<a class="hover:text-tomato-500" href="{{route('admin.home')}}">
						<span class="text-xs">
							管理者ページ
						</span>
					</a>
				</div>
			</li>
			@endif
		</u1>
	</nav>

	@include('components.footer')
</aside>