@extends('layouts.general')

@section('header')
	@include('components.header', ['title' => 'お問い合わせ | Orchards'])
@endsection

@push('js')
	<script src="{{asset('/js/length-count.js')}}" defar></script>
@endpush

@section('main')
	@component('components.container', ['id' => 'staff'])
		@include('components.pagetitle', ['title' => 'お問い合わせ'])

		@if(!empty(session('result')))
			お問い合わせを受け付けました。<br>
			いつもご利用ありがとうございます。<br>
			運営スタッフで内容を確認し、対応致します。
		@else
		<div class="rounded-xl bg-lettuce-300 p-2 my-4">
			<form action="" method="post">
				<div class="my-4">
					@include('utilities.forms.label', ['for' => 'name', 'name' => 'お名前'])
					<div class="">
						<input class="bg-lettuce-50 rounded-full w-80 max-w-full p-1 border border-lettuce-300 focus:border-tomato-300 focus:outline-none" id="name" type="text" name="name" value="{{old('name')}}" required>
					</div>
					@if($errors->has('name'))
						@include('utilities.forms.alert', ['message' => $errors->first('name')])
					@endif
				</div>

				<div class="my-4">
					@include('utilities.forms.label', ['for' => 'email', 'name' => __('E-Mail Address')])
					<div class="">
						<input class="bg-lettuce-50 rounded-full w-80 max-w-full p-1 border border-lettuce-300 mx-1 focus:border-tomato-300 focus:outline-none" id="email" type="email" name="email" value="{{old('email')}}" autocomplete="email" required autofocus>
					</div>
					@error('email')
						@include('utilities.forms.alert', ['message' => $errors->first('email')])
					@enderror
				</div>

				<div class="my-4">
					@include('utilities.forms.label', ['for' => 'message', 'name' => '内容'])
					@component('components.js.flex-textarea'))
						<textarea id="message" name="message" class="absolute top-0 left-0 w-full h-full overflow-hidden bg-lettuce-50 rounded-xl p-1 resize-none border-box border border-lettuce-300 focus:border-tomato-300 focus:outline-none js-flex-textarea-body" placeholder="" required>{{old('message')}}</textarea>
					@endcomponent
					@if($errors->tane->has('message'))
						@include('utilities.forms.alert', ['message' => $errors->tane->first('message')])
					@endif
				</div>

				@include('utilities.buttons.submit', [
					'text' => '送信',
					'color' => 'bg-tomato-500',
				])
			</form>
		</div>
		@endif
	@endcomponent
@endsection