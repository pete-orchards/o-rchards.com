<header class="fixed bg-lettuce-300 w-full border-b border-lettuce-400 pb-2 z-10 transform duration-200 js-header">
	<div class="flex flex-col items-center my-0 mx-auto pt-2 px-6 max-w-lg sm:flex-row sm:max-w-full">
		<div class="">
			<a href="{{route('home')}}">
				<img class="w-full max-w-md" src="{{asset('/img/orchards-logo.png')}}" alt="Orchards">
			</a>
			<div class="text-right">
				<a href="" class="hover:text-tomato-500 text-xs js-modal-open" data-target="js-modal/about">
					オーチャーズって？
				</a>
				{{--アバウトのモーダルウインドウ--}}
				@component('components.js.modal.content', [
					'id' => 'js-modal/about',
					'size' => 'w-11/12 h-11/12 max-h-screen',
					'opt' => 'overflow-auto js-modal-tab',
					'close_opt' => 'js-modal-tab-close'
				])
				<div class="flex flex-col justify-end h-full w-full">
					<div class="flex-grow flex-shrink">
						@component('components.centered')
						<div class="max-h-full max-w-full text-center m-auto js-tabbody" data-num="1">
							<div>
								<div class="text-2xl text-center m-4">Orchardsとは</div>
								<div class="m-2">
									<div class="m-1">ちょっとだけ稼げるアイデアを</div>
									<div class="m-1">実現するための</div>
									<div class="m-1">知恵と工夫を共有するSNSです。</div>
								</div>
								<div class="m-2">
									<div class="m-1">「タネ」、「ナエ」、「ミ」の</div>
									<div class="m-1">3種類の投稿をすることができます。</div>
								</div>
							</div>
						</div>

						<div class="text-center hidden m-auto js-tabbody" data-num="2">
							<img class="m-auto w-full" src="{{asset('img/tutorial1.png')}}" alt="チュートリアル1">
						</div>

						<div class="text-center hidden m-auto js-tabbody" data-num="3">
							<img class="m-auto w-full" src="{{asset('img/tutorial2.png')}}" alt="チュートリアル2">
						</div>

						<div class="text-center hidden m-auto js-tabbody" data-num="4">
							<img class="m-auto w-full" src="{{asset('img/tutorial3.png')}}" alt="チュートリアル3">
						</div>

						<div class="text-center hidden m-auto js-tabbody" data-num="5">
							<img class="m-auto w-full" src="{{asset('img/tutorial4.png')}}" alt="チュートリアル4">
						</div>

						<div class="text-center hidden m-auto js-tabbody" data-num="6">
							<img class="m-auto w-full" src="{{asset('img/tutorial5.png')}}" alt="チュートリアル5">
						</div>

						<div class="text-center hidden m-auto js-tabbody" data-num="7">
							<img class="m-auto w-full" src="{{asset('img/tutorial6.png')}}" alt="チュートリアル6">
						</div>
						@endcomponent
					</div>
					<div>
						<div class="relative text-center justify-center w-48 mx-auto my-4 js-modal-nav">
							<div class="absolute left-0 top-1/2 transform -translate-y-1/2 js-modal-prev hidden">
								@include('utilities.buttons.a2', [
									'href' => '',
									'color' => 'bg-gray-600',
									'text' => '前へ',
								])
							</div>
							<div class="">
								<span class="js-modal-count">1</span>
								<span>/</span>
								<span class="js-modal-length">7</span>
							</div>
							<div class="absolute right-0 top-1/2 transform -translate-y-1/2 js-modal-next">
								@include('utilities.buttons.a2', [
									'href' => '',
									'color' => 'bg-gray-600',
									'text' => '次へ',
								])
							</div>
						</div>

						<div class="text-center m-2">
							@include('utilities.buttons.a2', [
								'href' => '',
								'color' => 'bg-gray-600',
								'text' => '閉じる',
								'opt' => 'js-modal-close'
							])
						</div>
					</div>
				</div>
				@endcomponent
			</div>
		</div>

		<nav class="inline-block w-full">

			<ul class="flex justify-between text-xl uppercase mt-2 mx-2 sm:justify-end">

				<li class="text-center sm:mx-1">
					<a class="hover:text-tomato-500" href="{{route('help')}}">
						<img class="h-8 w-8 inline-block" src="{{asset('/img/icon_about.svg')}}" alt="HOW TO USE">
						<p class="text-center text-sm">使い方</p>
					</a>
				</li>

				@auth
				<li class="text-center sm:mx-1">
					<a class="hover:text-tomato-500" href="{{route('notification')}}">
						<div class="relative">
							<img class="h-8 w-8 inline-block" src="{{asset('/img/bell.svg')}}" alt="notification">
							@if(count(Auth::user()->unreceivedActiveNotifications) > 0)
							<span class="absolute top-0 right-0 bg-tomato-500 rounded-full border border-white h-5 w-5 text-sm text-white">
								<span class="absolute inset-0 text-sm text-white">
									{{Auth::user()->unreceivedActiveNotifications->count()}}</span>
								</span>
							@endif
						</div>

						<p class="text-center text-sm">通知</p>
					</a>
				</li>
				<li class="text-center sm:mx-1">
					<a class="hover:text-tomato-500" href="{{route('user/home', ['user_id' => Auth::user()->user_id])}}">
						<img class="h-8 w-8 inline-block rounded-full border border-gray-300" src="{{Auth::user()->prof_path()}}" alt="My Page">
						<p class="text-center text-sm">マイページ</p>
					</a>
				</li>
				@else
				<li class="text-center sm:mx-1">
					<a class="hover:text-tomato-500" href="{{route('register')}}">
						<img class="h-8 w-8 inline-block" src="{{asset('/img/register.svg')}}" alt="login">
						<p class="text-center text-sm">会員登録</p>
					</a>
				</li>
				<li class="text-center sm:mx-1">
					<a class="hover:text-tomato-500" href="{{route('login')}}">
						<img class="h-8 w-8 inline-block" src="{{asset('/img/login.svg')}}" alt="login">
						<p class="text-center text-sm">ログイン</p>
					</a>
				</li>
				@endauth

			</u1>

		</nav>
	</div>
</header>
<div></div>
{{--fixedで重なる分は下記のjqueryで調整--}}
@push('js')
	<script src="{{asset('/js/header-scroll.js')}}" defar></script>
@endpush