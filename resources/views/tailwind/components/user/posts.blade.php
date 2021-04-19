<div>
	<div class="ac-postlist js-tabcontrol">
		<a href="#post" class="js-tab js-tab-active">
			<div>
				<img class="ac-icon" src="{{asset('img/post.svg')}}" alt="Post">全投稿
			</div>
		</a>
		<a href="#tane" class="js-tab">
			<div>
				<img class="ac-icon" src="{{asset('img/tane2.sv')}}g" alt="Tane">タネ
			</div>
		</a>
		<a href="#nae" class="js-tab">
			<div>
				<img class="ac-icon" src="{{asset('img/nae2.svg')}}" alt="Nae">ナエ
			</div>
		</a>
		<a href="#mi" class="js-tab">
			<div>
				<img class="ac-icon" src="{{asset('img/mi2.svg')}}" alt="Mi">ミ
			</div>
		</a>
		<a href="#good" class="js-tab">
			<div>
				<img class="ac-icon" src="{{asset('img/good2.svg')}}" alt="Good">Good
			</div>
		</a>
		<a href="#basket" class="js-tab">
			<div>
				<img class="ac-icon" src="{{asset('img/basket2.svg')}}" alt="Basket">バスケット
			</div>
		</a>
	</div>

	<div class="js-tabbody">
		<section id="post" class="tabbody-item js-tabbody-show">
			@component('components.post.posts', ['posts' => $user->post])
			@endcomponent

		</section>
		<section id="tane" class="tabbody-item">
			@component('components.post.posts', [
				'posts' => $user->post->filter(function($post){
					return $post->post_type->name == 'tane';
				})
			])
			@endcomponent
		</section>
		<section id="nae" class="tabbody-item">
			@component('components.post.posts', [
				'posts' => $user->post->filter(function($post){
					return $post->post_type->name == 'nae';
				})
			])
			@endcomponent
		</section>
		<section id="mi" class="tabbody-item">
			@component('components.post.posts', [
				'posts' => $user->post->filter(function($post){
					return $post->post_type->name == 'mi';
				})
			])
			@endcomponent
		</section>
		<section id="good" class="tabbody-item">
			@component('components.post.posts', [
				'posts' => $user->good_posts
			])
			@endcomponent
		</section>
		<section id="basket" class="tabbody-item">
			@component('components.post.posts', [
				'posts' => $user->basket_posts
			])
			@endcomponent
		</section>
	</div>
</div>