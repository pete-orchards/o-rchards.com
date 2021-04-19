<div class="search-container wrapper home-parts">
	<form action="{{route('search')}}" method="">
		<ul class="search-nav">
			<li>
				<input type="text" name="keyword" value="{{old('keyword')}}" placeholder="検索ワードを入力">
			</li>

			<li>
				<img @if(old('type'))@if(in_array('tane', old('type'))){{'src=img/tane2.svg'}}@else{{'src=img/tane-g.svg'}}@endif @else {{'src=img/tane2.svg'}} @endif alt="tane" class="js-changetype-search type-icon @if(old('type'))@if(in_array('tane', old('type'))){{'js-type-on'}}@endif @else {{'js-type-on'}} @endif" data-target="tane">
				@if(old('type'))@if(in_array('tane', old('type')))<input type="hidden" name="type[]" value="tane">@endif @else <input type="hidden" name="type[]" value="tane"> @endif
				<img @if(old('type'))@if(in_array('nae', old('type'))){{'src=img/nae2.svg'}}@else{{'src=img/nae-g.svg'}}@endif @else {{'src=img/nae2.svg'}} @endif alt="nae" class="js-changetype-search type-icon @if(old('type'))@if(in_array('nae', old('type'))){{'js-type-on'}}@endif @else {{'js-type-on'}} @endif" data-target="nae">
				@if(old('type'))@if(in_array('nae', old('type')))<input type="hidden" name="type[]" value="nae">@endif @else <input type="hidden" name="type[]" value="nae"> @endif
				<img @if(old('type'))@if(in_array('mi', old('type'))){{'src=img/mi2.svg'}}@else{{'src=img/mi-g.svg'}}@endif @else {{'src=img/mi2.svg'}} @endif alt="mi" class="js-changetype-search type-icon @if(old('type'))@if(in_array('mi', old('type'))){{'js-type-on'}}@endif @else {{'js-type-on'}} @endif" data-target="mi">
				@if(old('type'))@if(in_array('mi', old('type')))<input type="hidden" name="type[]" value="mi">@endif @else <input type="hidden" name="type[]" value="mi"> @endif
			</li>
<!--
			<li>
				<input type="radio" name="type[]" value="tane"><img src="img/tane2.svg" alt="tane" class="js-changetype-search js-type-on type-icon" data-target="tane">
				
				<input type="radio" name="type[]" value="nae"><img src="img/nae-g.svg" alt="nae" class="js-changetype-search type-icon" data-target="nae">
				<input type="radio" name="type[]" value="mi"><img src="img/mi-g.svg" alt="mi" class="js-changetype-search type-icon" data-target="mi">
			</li>
-->
			<li>
				<input type="image" src="img/search-w.svg" class="search-icon" alt="SEARCH" name="search" value="search">
			</li>
		</ul>
	</form>

	<div>
		<small>・「#」をつけるとタグ検索 ・アイコンをタップorクリックでタネ/ナエ/ミの絞り込み</small>
	</div>
</div>