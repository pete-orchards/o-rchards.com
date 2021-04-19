<div class="mt-4 text-center">
	<div class="js-tabcontrol">
		<a href="#tane-form" class="inline-block nm-inset-ivory-200 hover:nm-convex-ivory-200 mx-4 p-1 rounded-lg no-underline relative z-0">
			<img src="{{asset('img/tane2.svg')}}" alt="tane" class="w-8 h-8" data-target="tane">
		</a>
		<a href="#nae-form" class="inline-block nm-flat-ivory-200 hover:nm-convex-ivory-200 mx-4 p-1 rounded-lg no-underline relative z-0">
			<img src="{{asset('img/nae2.svg')}}" alt="nae" class="w-8 h-8" data-target="nae">
		</a>
		<a href="#mi-form" class="inline-block nm-flat-ivory-200 hover:nm-convex-ivory-200 mx-4 p-1 rounded-lg no-underline relative z-0">
			<img src="{{asset('img/mi2.svg')}}" alt="mi" class="w-8 h-8" data-target="mi">
		</a>
	</div>

	<div class="js-tabbody">
		<section id="tane-form" class="my-2">
			<div class="text-xl mb-2">
				タネを投稿する
			</div>
			@include('components.form.tane')
		</section>
		<section id="nae-form" class="my-2 hidden">
			<div class="text-xl mb-2">
				ナエを投稿する
			</div>
			@include('components.form.nae')
		</section>
		<section id="mi-form" class="my-2 hidden">
			<div class="text-xl mb-2">
				ミを投稿する
			</div>
			@include('components.form.mi')
		</section>
	</div>
</div>