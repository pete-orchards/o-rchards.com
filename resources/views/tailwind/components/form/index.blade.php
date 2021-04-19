<div>
	<div class="js-tabcontrol">
		<a href="#tane-form" class="js-tab js-tab-active">
			<div>
				<img src="{{asset('img/tane2.svg')}}" alt="tane" class="js-changetype-form js-type-on type-icon" data-target="tane">
			</div>
		</a>
		<a href="#nae-form" class="js-tab">
			<div>
				<img src="{{asset('img/nae2.svg')}}" alt="nae" class="js-changetype-form js-type-on type-icon" data-target="nae">
			</div>
		</a>
		<a href="#mi-form" class="js-tab">
			<div>
				<img src="{{asset('img/mi2.svg')}}" alt="mi" class="js-changetype-form js-type-on type-icon" data-target="mi">
			</div>
		</a>
	</div>

	<div class="js-tabbody">
		<section id="tane-form" class="tabbody-item js-tabbody-show">
			<div class="index-text">
				タネを投稿する
			</div>
			@include('components.form.tane')
		</section>
		<section id="nae-form" class="tabbody-item">
			<div class="index-text">
				ナエを投稿する
			</div>
			@include('components.form.nae')
		</section>
		<section id="mi-form" class="tabbody-item">
			<div class="index-text">
				ミを投稿する
			</div>
			@include('components.form.mi')
		</section>
	</div>
</div>