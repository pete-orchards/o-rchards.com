'use strict';
jQuery(function($){
	//投稿、収入項目を追加
	$('.js-add-{{$type}}-{{$kind}}-container').on('click', function(){
		let tar = $(this);
		let target = tar.parents('.js-add-target');
		let key = target.find('.js-{{$kind}}-container:last').data('key') + 1;
		const elem = `@include('components.form.income_cost_container', ['key' => '${key}'])`;
		target.find('.js-remove-{{$kind}}-container').remove();
		target.find('.js-{{$kind}}-container:last').after(elem);
	});

	$(document).on('click', '.js-remove-{{$kind}}-container', function(){
		let tar = $(this);
		let target = tar.parents('.js-add-target');
		let key = target.find('.js-{{$kind}}-container:last').data('key') - 1;
		console.log(key);
		target.find('.js-{{$kind}}-container:last').remove();
		if(key !== 0){
			const button = `@include('components.form.income_cost_removebutton')`;
			target.find('.js-{{$kind}}-container:last div:first').append(button);
		}
	});

});
