<div class="w-full">
	<div class="text-lg text-center border-t border-l border-r border-gray-400 @if($kind == 'income'){{'bg-cerulean-200'}}@elseif($kind == 'cost'){{'bg-blush-300'}}@endif">{{$title}}</div>
	<table class="w-full border-collapse">
		<tr class="border border-gray-400">
			<th class="w-5/12">項目</th>
			<th class="w-3/12">金額</th>
			<th class="w-2/12">数量</th>
			<th class="w-2/12">小計</th>
		</tr>
		@foreach($items as $key => $item)
			<tr class="bg-white border-gray-400 border text-center">
				<td>{{$item->name}}</td>
				<td>{{number_format($item->amount)}}円</td>
				<td>{{preg_replace("/\.?0+$/","" ,number_format($item->volume, 2))}}</td>
				<td>{{preg_replace("/\.?0+$/","" ,number_format($item->subtotal(), 2))}}円</td>
			</tr>
		@endforeach
	</table>
	<div class="text-right px-2">
		 {{$title}}計: <span class="">{{preg_replace("/\.?0+$/","" ,number_format($gross, 2))}}</span>円
	</div>
</div>