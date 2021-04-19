<div class="container border-t border-ivory-400 pt-2 js-tabcontrol">
	<a href="#post" class="inline-block nm-inset-ivory-200 hover:nm-convex-ivory-200 mx-2 my-1 p-1 rounded-lg no-underline relative z-0">
		<div>
			<img class="w-4 h-4 inline" src="{{asset('img/post.svg')}}" alt="Post">全投稿
		</div>
	</a>
	<a href="#tane" class="inline-block nm-flat-ivory-200 hover:nm-convex-ivory-200 mx-2 my-1 p-1 rounded-lg no-underline relative z-0">
		<div>
			<img class="w-4 h-4 inline" src="{{asset('img/tane2.sv')}}g" alt="Tane">タネ
		</div>
	</a>
	<a href="#nae" class="inline-block nm-flat-ivory-200 hover:nm-convex-ivory-200 mx-2 my-1 p-1 rounded-lg no-underline relative z-0">
		<div>
			<img class="w-4 h-4 inline" src="{{asset('img/nae2.svg')}}" alt="Nae">ナエ
		</div>
	</a>
	<a href="#mi" class="inline-block nm-flat-ivory-200 hover:nm-convex-ivory-200 mx-2 my-1 p-1 rounded-lg no-underline relative z-0">
		<div>
			<img class="w-4 h-4 inline" src="{{asset('img/mi2.svg')}}" alt="Mi">ミ
		</div>
	</a>
	<a href="#good" class="inline-block nm-flat-ivory-200 hover:nm-convex-ivory-200 mx-2 my-1 p-1 rounded-lg no-underline relative z-0">
		<div>
			<img class="w-4 h-4 inline" src="{{asset('img/good2.svg')}}" alt="Good">Good
		</div>
	</a>
	<a href="#basket" class="inline-block nm-flat-ivory-200 hover:nm-convex-ivory-200 mx-2 my-1 p-1 rounded-lg no-underline relative z-0">
		<div>
			<img class="w-4 h-4 inline" src="{{asset('img/basket-checked-tomato.svg')}}" alt="Basket">バスケット
		</div>
	</a>
</div>

<div class="js-tabbody">
	<section id="post" class="my-2">
		@component('components.post.posts', ['posts' => $posts])
		@endcomponent
	</section>
	<section id="tane" class="my-2 hidden">
		@component('components.post.posts', ['posts' => $tane_posts])
		@endcomponent
	</section>
	<section id="nae" class="my-2 hidden">
		@component('components.post.posts', ['posts' => $nae_posts])
		@endcomponent
	</section>
	<section id="mi" class="my-2 hidden">
		@component('components.post.posts', ['posts' => $mi_posts])
		@endcomponent
	</section>
	<section id="good" class="my-2 hidden">
		@component('components.post.posts', ['posts' => $good_posts])
		@endcomponent
	</section>
	<section id="basket" class="my-2 hidden">
		@component('components.post.posts', ['posts' => $basket_posts])
		@endcomponent
	</section>
</div>