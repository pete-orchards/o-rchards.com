<div class="post-table-container">
	<div class="{{$class}}">
		<div class="table-title">{{$title}}</div>
		<table class="table">
			<tr class="name">
				<th class="accountname">項目</th>
				<th class="amount">金額</th>
				<th class="volume">数量</th>
				<th class="subtotal">小計</th>
			</tr>
			@foreach($items as $key => $item)
				<tr class="item">
					<td>{{$item->name}}</td>
					<td>{{number_format($item->amount)}}円</td>
					<td>{{preg_replace("/\.?0+$/","" ,number_format($item->volume, 2))}}</td>
					<td>{{preg_replace("/\.?0+$/","" ,number_format($item->subtotal(), 2))}}円</td>
				</tr>
			@endforeach
		</table>
		<div class="under_table_total">
			 {{$title}}計: <span class="table-gross">{{preg_replace("/\.?0+$/","" ,number_format($gross, 2))}}</span>円
		</div>
	</div>
</div>