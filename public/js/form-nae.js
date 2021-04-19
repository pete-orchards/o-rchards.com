'use strict';
jQuery(function($){
		//ナエ投稿バリデーション
	$('.js-nae-form').validate({
		rules:{
			title: {
				required: true,
				maxlength: 30,
			},
			body: {
				required: true,
				maxlength: 1200,
			},
			'incomes[]name': {
				required: true,
				maxlength: 20,
			},
			'costs[]name': {
				required: true,
				maxlength: 20,
			},
			'incomes[]amount': {
				required: true,
				number: true,
				max: 99999999999,
				min: 0,
			},
			'costs[]amount': {
				required: true,
				number: true,
				max: 99999999999,
				min: 0,
			},
			'incomes[]volume': {
				required: true,
				number: true,
				max: 9999999999,
				min: 0,
			},
			'costs[]volume': {
				required: true,
				number: true,
				max: 9999999999,
				min: 0,
			},
	//テーブル各部
	//未入力チェック
	//数字チェック
	//画像
	//ファイルサイズチェック

		},

		messages:{

			title:{
				required: '入力されていません',
				maxlength: '30文字以内で入力してください',
			},
			body: {
				required: '入力されていません',
				maxlength: '1200字以内で入力してください',
			},
			'incomes[]name': {
				required: '入力されていません',
				number: '半角数字で入力してください',
				maxlength: '10字以内で入力してください',
			},
			'costs[]name': {
				required: '入力されていません',
				number: '半角数字で入力してください',
				maxlength: '10字以内で入力してください',
			},
			'incomes[]amount': {
				required: '入力されていません',
				number: '半角数字で入力してください',
				max: '数字が大きすぎます',
				min: '0以外で入力してください',
			},
			'costs[]amount': {
				required: '入力されていません',
				number: '半角数字で入力してください',
				max: '数字が大きすぎます',
				min: '0以外で入力してください',
			},
			'incomes[]volume': {
				required: '入力されていません',
				number: '半角数字で入力してください',
				max: '数字が大きすぎます',
				min: '0以外で入力してください',
			},
			'costs[]volume': {
				required: '入力されていません',
				number: '半角数字で入力してください',
				max: '数字が大きすぎます',
				min: '0以外で入力してください',
			},

		},
		errorClass: "text-red-600",
	});

	$('.js-nae-form').on('click', '.js-nae-confirm', function(){
		if($('.js-nae-form').valid()){
			console.log('validated true');
			openModal();
		}

		return false;
	});
});