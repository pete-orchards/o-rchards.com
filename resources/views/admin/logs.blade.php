@extends('layouts.admin')

@section('header')
	@include('components.admin.header', ['title' => 'ログ分析 | Orchards'])
@endsection

@section('main')
	@component('components.container', ['id' => 'logs'])
		@include('components.pagetitle', ['title' => 'ログ分析'])

		<div class="py-2 nm-flat-blue-100 rounded-lg">
			<div>
				@include('components.admin.analytics.short', ['name' => '行動ログ', 'models' => $action_logs,])
			</div>
		</div>

		<div class="py-2 nm-flat-blue-100 rounded-lg my-4">
			<div>アクセス数上位10</div>
			<div>
				@foreach($log_urls as $key => $val)
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