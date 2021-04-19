<div class="flex flex-col container bg-white text-sepia-800 border-l border-r border-b border-gray-400 p-1 text-center">
	<div class="relative border-b border-gray-200 text-left pl-2">
		<div class="text-lg">
			{{$item->name}}
		</div>
	</div>
	<div class="flex flex-wrap container pl-4">
		<div class="w-1/4">
			@if($loop->first)
				<div class="text-sm">金額</div>
			@endif
			<div class="">
				{{number_format($item->amount)}}
				<span class="text-sm text-gray-500">円</span>
			</div>
		</div>
		<div class="w-1/12 flex justify-center items-center">
			<span class="text-tomato-500 font-black">×</span>
		</div>
		<div class="w-1/4">
			@if($loop->first)
				<div class="text-sm">数量</div>
			@endif
			<div class="">
				{{preg_replace("/\.?0+$/","" ,number_format($item->volume, 2))}}
			</div>
		</div>
		<div class="w-1/12 flex justify-center items-center">
			<span class="text-tomato-500 font-black">=</span>
		</div>
		<div class="w-1/3">
			@if($loop->first)
				<div class="text-sm">小計</div>
			@endif
			<div class="">
				{{preg_replace("/\.?0+$/","" ,number_format($item->subtotal(), 2))}}
				<span class="text-sm text-gray-500">円</span>
			</div>
		</div>
	</div>
</div>