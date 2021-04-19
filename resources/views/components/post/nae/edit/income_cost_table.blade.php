<label class="@error($type.'.'.$kind){{'bg-red-600 bg-opacity-50'}}@enderror">
	<div class="w-full mt-6 mx-auto">
		<div class="border-t border-l border-r border-gray-400 text-lg text-center @if($kind == 'income'){{'bg-cerulean-200'}}@elseif($kind == 'cost'){{'bg-blush-300'}}@endif">@if($kind == 'income'){{'収入'}}@elseif($kind == 'cost'){{'支出'}}@endif</div>
		<table class="border border-gray-400 border-collapse mx-0 w-full @if($kind == 'income'){{'js-income-target'}}@elseif($kind == 'cost'){{'js-cost-target'}}@endif">
			<tbody>
				<tr class="border border-gray-400 border-collapse mx-0 w-full">
					<th class="w-5/12">項目</th>
					<th class="w-3/12">金額</th>
					<th class="w-2/12">数量</th>
					<th class="w-2/12">小計</th>
					<th></th>
				</tr>
				@if($old)
				@php
				$gross = 0;
				@endphp
				@foreach($old as $key => $val)
				@php
				$old[$key]['subtotal'] = $old[$key]['amount'] * $old[$key]['volume'];
				$gross = $gross + $old[$key]['subtotal'];
				@endphp
				<tr class="@if($kind == 'income'){{'js-income-table'}}@elseif($kind == 'cost'){{'js-cost-table'}}@endif" data-target="{{$key}}">
					<td class="p-1">
						<input type="text" name="{{$type}}[{{$kind}}][{{$key}}][name]" value="{{old($type.'.'.$kind.'.'.$key.'.name')}}" required>
					</td>
					<td class="p-1 js-amount">
						<input type="text" name="{{$type}}[{{$kind}}][{{$key}}][amount]" value="{{old($type.'.'.$kind.'.'.$key.'.amount')}}" required>
					</td>
					<td class="p-1 js-volume">
						<input type="text" name="{{$type}}[{{$kind}}][{{$key}}][volume]" value="{{old($type.'.'.$kind.'.'.$key.'.volume')}}" required>
					</td>
					<td class="p-1 js-subtotal js-{{$kind}}-subtotal">{{$old[$key]['subtotal']}}円</td>
					<td class="p-1"></td>
				</tr>
				@endforeach
				@else
				<tr class="@if($kind == 'income'){{'js-income-table'}}@elseif($kind == 'cost'){{'js-cost-table'}}@endif" data-target="0">
					<td class="p-1">
						<input type="text" name="{{$type}}[{{$kind}}][0][name]" value="" required>
					</td>
					<td class="p-1 js-amount">
						<input type="text" name="{{$type}}[{{$kind}}][0][amount]" value="" required>
					</td>
					<td class="p-1 js-volume">
						<input type="text" name="{{$type}}[{{$kind}}][0][volume]" value="" required>
					</td>
					<td class="p-1 js-subtotal js-{{$kind}}-subtotal"></td>
					<td></td>
				</tr>
				@endif
			</tbody>
		</table>
		<div class="flex justify-between">
			<span class="inline-block text-xl bg-gray-600 text-white rounded-lg py-1 px-4 m-1 hover:bg-gray-700 @if($kind == 'income'){{'js-add-incometable'}}@elseif($kind == 'cost'){{'js-add-costtable'}}@endif">項目を追加</span>
			<div class="text-right py-1 px-4 m-1 text-lg">
				@if($kind == 'income'){{'収入'}}@elseif($kind == 'cost'){{'支出'}}@endif計: <span class="js-gross">{{ old($type.'.'.$kind) ? $gross : 0}}</span>円
			</div>
		</div>
	</div>
</label>
@error($type.'.'.$kind)
@foreach($errors->nae->$kind as $error)
<span class="text-red-600" role="alert">
	<strong>{{ $error }}</strong>
</span>
@endforeach
@enderror