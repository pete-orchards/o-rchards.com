'use strict';
jQuery(function($){
	$('.js-flex-textarea-body').on('input', function(){
		let target = $(this).parent('.js-flex-textarea');
		let dummy = target.find('.js-flex-textarea-dummy');
		let text = $(this).val();
		dummy.text(text + '\u200b');
	});
});
