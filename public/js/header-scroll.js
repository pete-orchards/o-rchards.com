'use strict';

jQuery(function($){
	function onScroll(){
		if(pos > hH && pos > lastPos){
			header.addClass('-translate-y-full');
		}
		if(pos < hH || pos < lastPos || windBtm <= pos){
			header.removeClass('-translate-y-full');
		}
		if(windBtm <= pos){
			//ページの高さが動的に変わってる場合があるので取得し直す
			docH = document.documentElement.scrollHeight;
			windBtm = docH - winH;
		}
		lastPos = pos;
	};
	//ヘッダーの高さを取得
	const header = $('.js-header');
	const hH = header.height();
	//スクロール位置を保存するのに使う
	let pos = 0;
	let lastPos = 0;
	//ウィンドウの高さ
	const winH = window.innerHeight;
	// ページの高さ
	let docH = document.documentElement.scrollHeight;
	// ウィンドウが最下部達した場合のウィンドウ上部の位置を取得
	let windBtm = docH - winH;
	window.addEventListener("scroll", function(){
		pos = window.scrollY;
		onScroll();
	});
	//ヘッダーがfixedな分重なるのを調整
	header.next().css("padding-top", hH);
});