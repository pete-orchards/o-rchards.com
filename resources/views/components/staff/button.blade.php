<div class="flex flex-wrap">
	<div class="w-full lg:w-1/2 p-2">
		@include('utilities.buttons.a1', [
			'text' => 'スタッフページトップ',
			'href' => route('staff'),
			'color' => 'bg-tomato-500',
		])
	</div>
	<div class="w-full lg:w-1/2 p-2">
		@include('utilities.buttons.a1', [
			'text' => 'トップページ',
			'href' => route('home'),
			'color' => 'bg-tomato-500',
		])
	</div>
</div>