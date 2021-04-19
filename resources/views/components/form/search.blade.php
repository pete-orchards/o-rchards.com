<div class="bg-lettuce-300 rounded-lg p-2 text-center mt-0 mb-4">
	<form action="{{route('search')}}" method="">
		<ul class="flex flex-col text-right lg:justify-center">
			<li class="text-center flex justify-center items-center">
				<input type="text" name="keyword" value="{{old('keyword')}}" placeholder="検索ワードを入力" class="bg-lettuce-50 rounded-full w-80 max-w-full p-1 border border-lettuce-300 mx-1 focus:border-tomato-300 focus:outline-none">
				<input type="image" src="img/search-w.svg" class="w-10 h-10 inline bg-tomato-500 rounded-lg border border-gray-400 p-1 hover:drop-shadow" alt="SEARCH" name="search" value="search">
			</li>

			<li class="mx-auto">
				{{--デフォルトでオン状態、検索した場合は絞り込みしてるかどうかでオンオフ制御--}}
				@if(old('type'))
					@if(in_array('tane', old('type')))
						@php
						$tane_src = 'img/tane2.svg';
						$tane_status = 'js-type-on';
						@endphp
					@else
						@php
						$tane_src = 'img/tane-g.svg';
						$tane_status = '';
						@endphp
					@endif
					@if(in_array('nae', old('type')))
						@php
						$nae_src = 'img/nae2.svg';
						$nae_status = 'js-type-on';
						@endphp
					@else
						@php
						$nae_src = 'img/nae-g.svg';
						$nae_status = '';
						@endphp
					@endif
					@if(in_array('mi', old('type')))
						@php
						$mi_src = 'img/mi2.svg';
						$mi_status = 'js-type-on';
						@endphp
					@else
						@php
						$mi_src = 'img/mi-g.svg';
						$mi_status = '';
						@endphp
					@endif
				@else
					@php
					$tane_src = 'img/tane2.svg';
					$tane_status = 'js-type-on';
					$nae_src = 'img/nae2.svg';
					$nae_status = 'js-type-on';
					$mi_src = 'img/mi2.svg';
					$mi_status = 'js-type-on';
					@endphp
				@endif
				@include('components.form.search_typeicon', ['type' => 'tane', 'src' => $tane_src, 'status' => $tane_status])
				@include('components.form.search_typeicon', ['type' => 'nae', 'src' => $nae_src, 'status' => $nae_status])
				@include('components.form.search_typeicon', ['type' => 'mi', 'src' => $mi_src, 'status' => $mi_status])

			</li>
		</ul>
	</form>

	<div class="text-xs">
		・「#」をつけるとタグ検索 ・アイコンをタップorクリックでタネ/ナエ/ミの絞り込み
	</div>
</div>