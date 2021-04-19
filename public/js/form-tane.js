'use strict';
jQuery(function($){
	//ナエ投稿バリデーション
	$('.js-tane-form').validate({
		rules:{
			title:{
				required: true,
				maxlength: 30,
			},
			body: {
				required: true,
				maxlength: 140,
			},
		},

		messages:{
			title:{
				required: '入力されていません',
				maxlength: '30文字以内で入力してください',
			},
			body: {
				required: '入力されていません',
				maxlength: '140字以内で入力してください',
			},
		},
		errorClass: "inline-block text-red-600",
		errorElement: "label",
		errorPlacement: function (err, element) {
			if (element.attr("name") == "body") {
				element.parent().after(err);
			} else {
				element.after(err);
			}
		},
	});
	
	$('.js-tane-form').on('click', '.js-tane-submit', function(){
		$('.js-tane-form').valid();
	});
});