<div class="flex flex-col container border-l border-r border-b border-gray-400 p-1 @if($kind == 'incomes'){{'js-incomes-container'}}@elseif($kind == 'costs'){{'js-costs-container'}}@endif" data-key="{{$key}}">
	<div class="relative">
		<div class="js-length-count-container">
			@include('components.form.income_cost_item', [
				'id' => $type.'/'.$kind.'/'.$key.'/name',
				'name' => '項目',
				'input_name' => 'name',
				'key' => $key,
				'value' => $val->name,
				'input_type' => 'text',
			])
			<div class="font-black text-sm text-right">
				<span class="js-length-num">0</span>/<span class="js-length-lim">20</span>
			</div>
			@if($key != '0')
			@include('components.form.income_cost_removebutton')
			@endif
		</div>
	</div>
	<div class="flex flex-wrap container">
		<div class="w-1/3">
			{{--文字数カウントしないようlength_countを宣言だけしておく--}}
			@include('components.form.income_cost_item', [
				'id' => $type.'/'.$kind.'/'.$key.'/amount',
				'name' => '金額',
				'input_name' => 'amount',
				'key' => $key,
				'value' => $val->amount,
				'class' => 'js-amount',
				'input_type' => 'number',
				'length_count' => '',
			])
		</div>
		<div class="w-1/3">
			{{--文字数カウントしないようlength_countを宣言だけしておく--}}
			@include('components.form.income_cost_item', [
				'id' => $type.'/'.$kind.'/'.$key.'/volume',
				'name' => '数量',
				'input_name' => 'volume',
				'key' => $key,
				'value' => $val->volume,
				'class' => 'js-volume',
				'input_type' => 'number',
				'length_count' => '',
			])
		</div>
		<div class="w-1/3">
			<div>小計</div>
			<div>
				<span class="js-subtotal">
					{{$val->subtotal()}}
				</span>
				<span class="text-sm">円</span>
			</div>
		</div>
	</div>
	<div>
		@if($errors->$type->has($kind.'.'.$key.'.name'))
			@include('utilities.forms.alert', ['message' => $errors->$type->first($kind.'.'.$key.'.name')])
		@endif
		@if($errors->$type->has($kind.'.'.$key.'.amount'))
			@include('utilities.forms.alert', ['message' => $errors->$type->first($kind.'.'.$key.'.amount')])
		@endif
		@if($errors->$type->has($kind.'.'.$key.'.volume'))
			@include('utilities.forms.alert', ['message' => $errors->$type->first($kind.'.'.$key.'.volume')])
		@endif
	</div>
</div>