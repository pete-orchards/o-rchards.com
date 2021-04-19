<header class="flex flex-row bg-lettuce-300 justify-between items-center px-1 py-2 mx-0 my-auto">
	<div>
			<a href="{{route('home')}}">
				<img class="w-4/5" src="{{asset('/img/orchards-logo.png')}}" alt="Orchards">
			</a>
	</div>

	<nav class="inline-block justify-between mx-2">
		<ul class="flex flex-col list-none text-lg uppercase my-0">
			<li class="my-1 text-left nm-concave-lettuce-300 rounded-full w-20 hover:nm-flat-lettuce-300 my-2">
				<a href="" class="js-modal-open text-sepia-800 hover:text-tomato-500" data-target="js-about">
					<img class="w-6 float-left m-1" src="{{asset('/img/icon_about.svg')}}" alt="About">
					<p class="text-sm">ABOUT</p>
				</a>
			</li>
			@auth
			<li class="text-center">
				<a class="text-sepia-800 hover:text-tomato-500" href="{{route('user/home', ['user_id' => Auth::user()->user_id])}}">
					<img class="bg-white rounded-full nm-concave-lettuce-300 w-20 hover:nm-flat-lettuce-300" src="{{Auth::user()->prof_path()}}" alt="My Page">
					<p class="text-md">MY PAGE</p>
				</a>
			</li>
			@else
			<li class="text-center">
				<a class="text-sepia-800 hover:text-tomato-500" href="{{route('login')}}">
					<img class="rounded p-2 nm-concave-lettuce-300 w-16 hover:nm-flat-lettuce-300" src="{{asset('/img/login.svg')}}" alt="login">
					<p class="text-md">LOG IN</p>
				</a>
			</li>
			@endauth
		</u1>
	</nav>
</header>
@include('modal-window')