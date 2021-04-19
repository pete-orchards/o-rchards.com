'use strict';

jQuery(function($){

	$('.js-length-count-target').on('input', function(){
		let container = $(this).parents('.js-length-count-container');
		let num = container.find('.js-length-num');
		let lim = container.find('.js-length-lim');
		let length = $(this).val().length;
		num.text(length);
		if(length > 0){
			num.addClass('text-lettuce-300');
		}
		if(length > lim.text()){
			num.removeClass('text-lettuce-300');
			num.addClass('text-tomato-500');
		}else{
			num.addClass('text-lettuce-300');
			num.removeClass('text-tomato-500');
		}
	});
});