<div class="container">
	<div class="border border-gray-400 text-lg text-center @if($kind == 'incomes'){{'bg-cerulean-200'}}@elseif($kind == 'costs'){{'bg-blush-300'}}@endif">
		@if($kind == 'incomes'){{'収入'}}@elseif($kind == 'costs'){{'支出'}}@endif
	</div>
	<div class="js-add-target">
		@if($errors->$type->all() || !empty($btn_back_msg))
			@foreach(old($kind) as $key => $val)
				@include('components.post.nae.edit.income_cost_container', [])
			@endforeach

		@else
			@foreach($nae->$kind as $key => $val)
				@include('components.post.nae.edit.income_cost_container', [])
			@endforeach
			@endif
		<div class="flex justify-between container border-l border-r border-b border-gray-400 text-center">
			<div class="text-xl bg-gray-600 text-white rounded-lg py-1 px-4 my-1 mx-auto hover:bg-gray-700 js-add-{{$type}}-{{$kind}}-container">項目を追加</div>
		</div>
		<div class="text-right py-1 px-4 m-1 text-lg">
			@if($kind == 'incomes'){{'収入'}}@elseif($kind == 'costs'){{'支出'}}@endif計: <span class="js-gross">@if($kind == 'incomes'){{$nae->income_gross()}}@elseif($kind == 'costs'){{$nae->cost_gross()}}@endif</span>円
		</div>
	</div>
</div>

<script>
	'use strict';
	jQuery(function($){
		//収支項目を追加
		$('.js-add-{{$type}}-{{$kind}}-container').on('click', function(){
			let tar = $(this);
			let target = tar.parents('.js-add-target');
			let key = target.find('.js-{{$kind}}-container:last').data('key') + 1;
			const elem = `@include('components.form.income_cost_container', ['key' => '${key}'])`;
			target.find('.js-remove-{{$kind}}-container').remove();
			target.find('.js-{{$kind}}-container:last').after(elem);
		});
		//項目の削除
		$(document).on('click', '.js-remove-{{$kind}}-container', function(){
			let tar = $(this);
			let target = tar.parents('.js-add-target');
			let key = target.find('.js-{{$kind}}-container:last').data('key') - 1;
			target.find('.js-{{$kind}}-container:last').remove();
			if(key !== 0){
				const button = `@include('components.form.income_cost_removebutton')`;
				target.find('.js-{{$kind}}-container:last div:first').append(button);
			}
		});

		//金額数量を数字に変換して小計を出す
		$('.js-nae-form, .js-mi-form').on('change', '.js-amount, .js-volume', function(){
			const str = $(this);
			const val = str.val();
			//formInt()とformFloat()はscript.jsにある
			if($(this).hasClass('js-amount')){
				str.val(formInt(val));
			}else if($(this).hasClass('js-volume')){
				str.val(formFloat(val));
			}
			let subtotal = calcSubtotal(str);
			$(this).parents('.js-incomes-container, .js-costs-container').find('.js-subtotal').empty().append(subtotal);
			let sum = 0;
			$(this).closest('.js-add-target').find('.js-subtotal').each(function(index, element){
				sum += parseFloat($(this).text());
			});
			sum = sum.toFixed(2);
			sum = sum.replace(/\.?0+$/, '');
			$(this).closest('.js-add-target').find('.js-gross').text(sum);
		});

		//入力をintに変換
		function formInt(str){
			str = str
				.replace(/[０-９．]/g, function (s) {
					return String.fromCharCode(s.charCodeAt(0) - 65248);
				})
				.replace(/[‐－―ー]/g, '-')
				.replace(/[^\-\d\.]/g, '')
				.replace(/(?!^\-)[^\d\.]/g, '');
			return parseInt(str, 10);
		};

		//入力ををfloatに変換
		function formFloat(str){
			str = str
				.replace(/[０-９．]/g, function (s) {
					return String.fromCharCode(s.charCodeAt(0) - 65248);
				})
				.replace(/[‐－―ー]/g, '-')
				.replace(/[^\-\d\.]/g, '')
				.replace(/(?!^\-)[^\d\.]/g, '');
			str = parseFloat(str);
			str = str.toFixed(2);
			str = str.replace(/\.?0+$/, '');
			return str;
		};

		//ナエ投稿、テーブルの小計を計算
		function calcSubtotal(val){
			const par = val.parents('.js-incomes-container, .js-costs-container');
			const amount = par.find('.js-amount').val();
			const volume = par.find('.js-volume').val();
			let subtotal = 0;
			if((amount !== null) && (volume !== null)){
				subtotal = amount * volume;
			}
			subtotal = subtotal.toFixed(2);
			subtotal = subtotal.replace(/\.?0+$/, '');
			return subtotal;
		};
	});
</script>
