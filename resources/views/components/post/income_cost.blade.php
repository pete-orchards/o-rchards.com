<div class="container text-sepia-800">
	<div class="border border-gray-400 text-lg text-center @if($kind == 'incomes'){{'bg-cerulean-200'}}@elseif($kind == 'costs'){{'bg-blush-300'}}@endif">
		@if($kind == 'incomes'){{'収入'}}@elseif($kind == 'costs'){{'支出'}}@endif
	</div>
	@foreach($items as $key => $item)
	@include('components.post.income_cost_container', [])
	@endforeach
	<div class="text-right py-1 px-4 m-1 text-lg">
		@if($kind == 'incomes'){{'収入'}}@elseif($kind == 'costs'){{'支出'}}@endif計: <span class="js-gross">{{preg_replace("/\.?0+$/","" ,number_format($gross, 2))}}</span>円
	</div>
</div>