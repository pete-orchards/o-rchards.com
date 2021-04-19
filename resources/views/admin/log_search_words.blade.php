@extends('layouts.admin')

@section('header')
	@include('components.admin.header', ['title' => '検索ワード分析 | Orchards'])
@endsection

@section('main')
	@component('components.container', ['id' => 'logs'])
		@include('components.pagetitle', ['title' => '検索ワード分析'])

		<div class="py-2 nm-flat-blue-100 rounded-lg">
			<div>
				@include('components.admin.analytics.log_search_words', ['name' => '検索ワード', 'models' => $log_search_words])
			</div>
		</div>

		<div class="py-2 nm-flat-blue-100 rounded-lg my-4">
			<div>検索数上位10</div>
			<div>
				@foreach($log_grouped as $key => $val)
					<div class="">
						<span>{{$key}}</span>:
						<span>
							{{$val->count}}
						</span>
					</div>
					@if($loop->index >= 9)
						@break
					@endif
				@endforeach
			</div>
		</div>

		@include('utilities.buttons.a1', [
			'text' => '管理者ページトップ',
			'href' => route('admin.home'),
			'color' => 'bg-yellow-700',
		])

	@endcomponent
@endsection