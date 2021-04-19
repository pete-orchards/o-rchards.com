<label class="@error($type.'.'.$kind) err @enderror">
	<div class="p-t-table-container">
		<div class="p-t-name-{{$kind}}">収入</div>
		<table class="p-t-table js-{{$kind}}-target">
			<tbody>
				<tr class="p-t-name">
					<th class="p-t-accountname">項目</th>
					<th class="p-t-amount">金額</th>
					<th class="p-t-volume">数量</th>
					<th class="p-t-subtotal">小計</th>
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
				<tr class="p-t-kind js-{{$kind}}-table" data-target="{{$key}}">
					<td>
						<input type="text" name="{{$type}}[{{$kind}}][{{$key}}][name]" value="{{old($type.'.'.$kind.'.'.$key.'.name')}}" required>
					</td>
					<td class="js-amount">
						<input type="text" name="{{$type}}[{{$kind}}][{{$key}}][amount]" value="{{old($type.'.'.$kind.'.'.$key.'.amount')}}" required>
					</td>
					<td class="js-volume">
						<input type="text" name="{{$type}}[{{$kind}}][{{$key}}][volume]" value="{{old($type.'.'.$kind.'.'.$key.'.volume')}}" required>
					</td>
					<td class="js-subtotal js-{{$kind}}-subtotal">{{$old[$key]['subtotal']}}円</td>
					<td></td>
				</tr>
				@endforeach
				@else
				<tr class="p-t-kind js-{{$kind}}-table" data-target="0">
					<td>
						<input type="text" name="{{$type}}[{{$kind}}][0][name]" value="" required>
					</td>
					<td class="js-amount">
						<input type="text" name="{{$type}}[{{$kind}}][0][amount]" value="" required>
					</td>
					<td class="js-volume">
						<input type="text" name="{{$type}}[{{$kind}}][0][volume]" value="" required>
					</td>
					<td class="js-subtotal js-{{$kind}}-subtotal"></td>
					<td></td>
				</tr>
				@endif
			</tbody>
		</table>
		<div class="under_table">
			<span class="mini-button js-add-incometable">項目を追加</span>
			<div class="under_table_total">
				収入計: <span class="js-gross">{{ old($type.'.'.$kind) ? $gross : 0}}</span>円
			</div>
		</div>
	</div>
</label>
@error($type.'.'.$kind)
@foreach($errors->nae->income as $error)
<span class="err_msg" role="alert">
	<strong>{{ $error }}</strong>
</span>
@endforeach
@enderror