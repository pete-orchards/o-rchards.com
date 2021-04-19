<div class="hidden h-screen fixed top-0 container z-10 js-modal" id="js-about">
	<div class="bg-black bg-opacity-25 absolute h-screen w-screen z-10 js-modal-close js-modal-tab-close"></div>
	<div class="absolute bg-white bg-opacity-50 top-1/2 left-1/2 p-2 modal-about js-modal-tab">
		<section class="modal-body js-tabbody js-tabbody-show textbox" id="js-about1">
			<div class="textbox_child_center">
				<h3 class="modal-title">Orchardsとは</h3>
				<p>
					ちょっとだけ稼げるアイデアを
					<br>実現するための
					<br>知恵と工夫を共有するSNSです。
					<br>「タネ」、「ナエ」、「ミ」の3種類の投稿をすることができます。
				</p>
			</div>

		</section>

		<section class="modal-body js-tabbody" id="js-about2">
			<img src="{{asset('img/tutorial1.png')}}" alt="チュートリアル1">
 		</section>

		<section class="modal-body js-tabbody" id="js-about3">
			<img src="{{asset('img/tutorial2.png')}}" alt="チュートリアル2">
 		</section>

		<section class="modal-body js-tabbody" id="js-about4">
			<img src="{{asset('img/tutorial3.png')}}" alt="チュートリアル3">
 		</section>

		<section class="modal-body js-tabbody" id="js-about5">
			<img src="{{asset('img/tutorial4.png')}}" alt="チュートリアル4">
 		</section>

		<section class="modal-body js-tabbody" id="js-about6">
			<img src="{{asset('img/tutorial5.png')}}" alt="チュートリアル5">
 		</section>

		<section class="modal-body js-tabbody" id="js-about7">
			<img src="{{asset('img/tutorial6.png')}}" alt="チュートリアル6">
 		</section>

		<div class="modal-nav js-modal-nav">
			<span class="js-modal-prev js-modal-nav-hidden">
				<a class="mini-button" href="">前へ </a>
			</span>
			<span class="js-modal-count" data-target="1">1</span>
			<span>/</span>
			<span class="js-modal-length" data-target="7">7</span>
			<span class="js-modal-next">
				<a class="mini-button" href=""> 次へ</a>
			</span>
		</div>

		<div class="modal-close">
			<a class="mini-button js-modal-close js-modal-tab-close" href="">閉じる</a>
		</div>
	</div>
</div>


<div class="hidden h-screen fixed top-0 container z-10 js-modal" id="js-delete-confirm">
	<div class="bg-black bg-opacity-25 absolute h-screen w-screen z-10 js-modal-close"></div>
	<div class="absolute bg-white bg-opacity-50 top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 m-2 z-20 p-2 modal-delete">
		<div class="modal-text">
			投稿を削除してよろしいですか？
		</div>
		<div class="modal-text">
			<span class="mini-button js-delete">削除する</span>
			<a class="mini-button js-modal-close" href="">キャンセル</a>
		</div>
	</div>
</div>