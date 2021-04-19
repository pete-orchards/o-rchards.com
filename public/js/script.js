'use strict';

jQuery(function($){

	//モーダルウィンドウ
	$(document).on('click', '.js-modal-open', openModal);

	$(document).on('click', '.js-modal-close', closeModal);

	//モーダルを閉じたときにスクロールしていた分だけページ位置を移動するため、変数を宣言
	var winScrollTop;
	//$(this) = $('.js-modal-open')
	function openModal(){
		//位置を検知
		winScrollTop = $(window).scrollTop();
		const id = $(this).data('target');
		const modal = $(document.getElementById(id));
		modal.remove();
		//bodyタグの末尾に差し込む(zインデックスの関係でモーダルが隠れないように)
		$('body').append(modal);
		$(document.getElementById(id)).fadeIn();

		return false;
	};

	//$(this) = $('.js-modal-close')
	function closeModal(){
		const modal = $(this).parents('.js-modal');
		modal.fadeOut();
		//位置を反映
		$('body,html').stop().animate({scrollTop:winScrollTop}, 100);
		return false;
	};

	//タブ
	$('.js-tabcontrol a').on('click', function(){
		let control = $(this).parents('.js-tabcontrol');
		let tabbody = control.next();
		let index = control.find('a').index(this);
		control.find('a').removeClass('nm-inset-ivory-200').addClass('nm-flat-ivory-200');
		$(this).toggleClass('nm-flat-ivory-200').toggleClass('nm-inset-ivory-200');
		tabbody.children('section').addClass('hidden').eq(index).removeClass('hidden');
		event.stopPropagation();
		return false;
	});




	//モーダル内カルーセル表示(about用)
	$(document).on('click', '.js-modal-next', function(){
		const container = $(this).parents('.js-modal');
		const length = container.find('.js-modal-length').text();
		let counter_tag = container.find('.js-modal-count');
		let counter = parseInt(counter_tag.text(), 10);
		const prev = container.find('.js-modal-prev');
		const next = container.find('.js-modal-next');

		container.find(`.js-tabbody:nth-of-type(${counter})`).addClass('hidden');
		counter = counter + 1;
		container.find(`.js-tabbody:nth-of-type(${counter})`).removeClass('hidden');
		counter_tag.text(counter);

		if(counter == 1){
			prev.addClass('hidden');
		}else{
			prev.removeClass('hidden');
		}
		if(counter == length){
			next.addClass('hidden');
		}else{
			next.removeClass('hidden');
		}

		return false;
	});

	$(document).on('click', '.js-modal-prev', function(){
		const container = $(this).parents('.js-modal');
		const length = container.find('.js-modal-length').text();
		let counter_tag = container.find('.js-modal-count');
		let counter = parseInt(counter_tag.text(), 10);
		const prev = container.find('.js-modal-prev');
		const next = container.find('.js-modal-next');

		container.find(`.js-tabbody:nth-of-type(${counter})`).addClass('hidden');
		counter = counter - 1;
		container.find(`.js-tabbody:nth-of-type(${counter})`).removeClass('hidden');
		counter_tag.text(counter);

		if(counter == 1){
			prev.addClass('hidden');
		}else{
			prev.removeClass('hidden');
		}
		if(counter == length){
			next.addClass('hidden');
		}else{
			next.removeClass('hidden');
		}

		return false;
	});

	$('.js-modal-tab-close').on('click', function(){
		const container = $(this).parents('.js-modal');
		let counter_tag = container.find('.js-modal-count');
		let counter = counter_tag.data('target');
		let data = '#js-about' + counter;
		$(data).removeClass('js-tabbody-show');
		$('#js-about1').addClass('js-tabbody-show');
		counter_tag.data('target', 1);
		counter_tag.text(1);
		container.find('.js-modal-prev').addClass('js-modal-nav-hidden');
		container.find('.js-modal-next').removeClass('js-modal-nav-hidden');
	});

	//タネ入力途中でindexを離れる時に内容を削除していいか確認して処理
	$('.js-tane-form, .js-nae-form, .js-mi-form').on('focusin', function(){
	//ajaxでログイン済みかをチェックして未ログインならエラーを表示
		const tar = $(this);
		$.ajax({
			url: route + "ajax_auth",
			type: "GET",
			timeout: 10000,
			dataType: "json",
			//data:{},
			success: function(data){
				if(data.result === "1"){
				}else if(data.result ==="2"){
					tar.prepend('<div class="text-red-600">ログインし直してから入力してください</div>');
				}else if(data.result ==="0"){
					tar.prepend('<div class="text-red-600">ログインしてから入力してください</div>');
				}
			},
		});
	});

/*	//アップロードするプロフィール画像を確認表示(アカウントページ)
	$('.js-iconview').on('change',function(){
		var me=$(this);
		var file = $(this).prop('files')[0];
		var fr = new FileReader();
		if(file.type.match(/^image/)){
			me.next('.myimgs').remove();
			var imgtag=$('<img alt="upload icon" class="ac_prof_img">');
			me.after(imgtag);
			fr.onload = function() {
				imgtag.attr('src', fr.result);
			}
			fr.readAsDataURL(file);
		}
	});

*/
	//投稿、収入項目を追加
/*	$('.js-add-incometable').on('click', function(){
		let tar = $(this);
		let form = tar.parents('form');
		let type = form.data('target');
		let count = form.find('.js-income-table:last').data('target') + 1;
		console.log($(this));
		console.log(form);
		console.log(type);
		console.log(count);
		const td = `
		<tr class="js-income-table" data-target="${count}">
		<td>
		<input type="text" name="${type}[income][${count}][name]" value="" required>
		</td>
		<td class="js-amount">
		<input type="text" name="${type}[income][${count}][amount]" value="" required>
		</td>
		<td class="js-volume">
		<input type="text" name="${type}[income][${count}][volume]" value="" required>
		</td>
		<td class="js-subtotal"></td>
		<td>
		<span class="js-remove-incometable inline-block text-xl bg-gray-600 text-white rounded-lg py-1 px-4 m-1 hover:bg-gray-700">×</span>
		</td>
		</tr>
		`;
		form.find('.js-remove-incometable').remove();
		form.find('.js-income-target tbody').append(td);
	});
*/
	//収入項目を減らす
/*	$(document).on('click', '.js-remove-incometable', function(){
		let tar = $(this);
		let form = tar.parents('form');
		let count = form.find('.js-income-table:last').data('target') - 1;
		form.find('.js-income-table:last').remove();
		if(count !== 0){
			const span = `<span class="js-remove-incometable mini-button">×</span>`;
			form.find('.js-income-table:last td:last').append(span);
		}
	});
*/
	//投稿、支出項目を追加
/*	$('.js-add-costtable').on('click', function(){
		let tar = $(this);
		let form = tar.parents('form');
		let type = form.data('target');
		let count = form.find('.js-cost-table:last').data('target') + 1;
		const td = `
		<tr class="js-cost-table" data-target="${count}">
		<td>
		<input type="text" name="${type}[cost][${count}][name]" value="" required>
		</td>
		<td class="js-amount">
		<input type="text" name="${type}[cost][${count}][amount]" value="" required>
		</td>
		<td class="js-volume">
		<input type="text" name="${type}[cost][${count}][volume]" value="" required>
		</td>
		<td class="js-subtotal"></td>
		<td>
		<span class="js-remove-costtable mini-button">×</span>
		</td>
		</tr>
		`;
		form.find('.js-remove-costtable').remove();
		form.find('.js-cost-target tbody').append(td);
	});
*/
	//支出項目を減らす
/*	$(document).on('click', '.js-remove-costtable', function(){
		let tar = $(this);
		let form = tar.parents('form');
		let count = form.find('.js-cost-table:last').data('target') - 1;
		form.find('.js-cost-table:last').remove();
		if(count !== 0){
			const span = `<span class="js-remove-costtable mini-button">×</span>`;
			form.find('.js-cost-table:last td:last').append(span);
		}
	});
*/
/*	//投稿、画像アップロード関連
	$('.js-img-showcase').on('change', '.js-nae-img, .js-mi-img', function(){
		const files = $(this)[0].files[0];
		if(files && files.type.match('image.*')){
			const imgtag = `<img alt="image" class="js-working">`;
			$(this).siblings('img').replaceWith(imgtag);
			fileUpload(files);
		}
	});

	function fileUpload(file){
		Promise.resolve(file)
		.then(loadImage)
		.then(resize)
		.then(blob => {
			return Promise.all([showPreview(blob), fetch(route + "ajax_form-img-upload", { method: "POST", body: file })]);
		})
		.then(showResult)
		.catch(showResult);
	};

	function showResult(result) {
		return new Promise(resolve => {
	//		result[0].classList.remove("working");
	});
	};

	function loadImage(file) {
		return new Promise(resolve => {
			const reader = new FileReader();
			reader.onload = element => {
				const img = new Image();
				img.onload = () => {
					resolve({ img: img, filetype: file.type});
				};
				img.src = element.target.result;
			};
			reader.readAsDataURL(file);
		});
	};

	const MAX_SIZE = 1200;
	const JPEG_QUALITY = 0.6;

	function resize(loadedImage) {
		const img = loadedImage["img"];
		return new Promise(resolve => {
			var arrayBuffer = base64ToArrayBuffer(img.src);
			const exif = EXIF.readFromBinaryFile(arrayBuffer);
			var rotate = '';
			if (exif && exif.Orientation) {
				switch (exif.Orientation) {
					case 3:
					case 4:
					rotate = 180;
					break;
					case 6:
					case 5:
					rotate = 90;
					break;
					case 8:
					case 7:
					rotate = -90;
					break;
					default:
					rotate = 0;
				}
			} else {
				rotate = 0;
			}
			var resizedWidth;
			var resizedHeight;
			if (MAX_SIZE > img.width && MAX_SIZE > img.height) {
				resizedWidth = img.width;
				resizedHeight = img.height;
			} else if (img.width > img.height) {
				const ratio = img.height / img.width;
				resizedWidth = MAX_SIZE;
				resizedHeight = MAX_SIZE * ratio;
			} else {
				const ratio = img.width / img.height;
				resizedWidth = MAX_SIZE * ratio;
				resizedHeight = MAX_SIZE;
			}
			const canvas = document.createElement("canvas");
			if (rotate == 90 || rotate == -90) {
				canvas.height = resizedWidth;
				canvas.width = resizedHeight;
			} else {
				canvas.width = resizedWidth;
				canvas.height = resizedHeight;
			}
			const ctx = canvas.getContext("2d");
			ctx.translate(canvas.width / 2, canvas.height / 2);
			ctx.rotate(rotate * TO_RADIANS);
			ctx.translate(-resizedWidth / 2, -resizedHeight / 2);
			ctx.drawImage(img, 0, 0, img.width, img.height, 0, 0, resizedWidth, resizedHeight);
			var quality;
			const filetype = loadedImage["filetype"];
			if (filetype == "image/jpeg") {
				quality = JPEG_QUALITY;
			} else {
				quality = 1;
			}
			canvas.toBlob(
				blob => {
					resolve(blob);
				},
				filetype,
				quality
				);
		});
	};

	function showPreview(blob) {
		return new Promise(resolve => {
			const dataUrl = URL.createObjectURL(blob);
			const frame = $('.js-img-showcase');
			resolve(frame);
			$('.js-working').attr('src', dataUrl).removeClass('js-working');
		});
	};

	function base64ToArrayBuffer(base64) {
		base64 = base64.replace(/^data\:([^\;]+)\;base64,/gim, "");
		var binaryString = atob(base64);
		var len = binaryString.length;
		var bytes = new Uint8Array(len);
		for (var i = 0; i < len; i++) {
			bytes[i] = binaryString.charCodeAt(i);
		}
		return bytes.buffer;
	}
	const TO_RADIANS = Math.PI / 180;
*/
	//画像を追加
/*	$('.js-nae-form').on('click', '.js-add-img', function(){
		let tar = $(this);
		let form = tar.parents('form');
		let count = form.find('.js-form-img:last').data('target') + 1;
		if(count <= 4){
			const input = `
			<label class="n-form-imgs js-form-img" data-target="${count}">
			<img src="img/img.svg" class="n-img-form">
			<input type="file" name="img[]" class="js-nae-img nae-form-img" multiple accept="image/jpeg, image/gif, image/png">
			</label>
			`;
			form.find('.js-img-showcase').append(input);

			if(count == 4){
				$(this).remove();
			} else if(count == 2){
				const span = `<span class="mini-button js-remove-img">画像を減らす</span>`;
				$(this).parent().append(span);
			}
		};
		event.preventDefault();
	});
*/
		//画像を追加
/*	$('.js-mi-form').on('click', '.js-add-img', function(){
		let tar = $(this);
		let form = tar.parents('form');
		let count = form.find('.js-form-img:last').data('target') + 1;
		if(count <= 4){
			const input = `
			<label class="m-form-imgs js-form-img" data-target="${count}">
			<img src="img/select_image.svg" class="n-img-form">
			<input type="file" name="img[]" class="js-mi-img mi-form-img" multiple accept="image/jpeg, image/gif, image/png">
			</label>
			`;
			form.find('.js-img-showcase').append(input);

			if(count == 4){
				$(this).remove();
			} else if(count == 2){
				const span = `<span class="mini-button js-remove-img">画像を減らす</span>`;
				$(this).parent().append(span);
			}
		};
		event.preventDefault();
	});
*/
	//画像を減らす
/*	$(document).on('click', '.js-remove-img', function(){
		let tar = $(this);
		let form = tar.parents('form');
		let count = form.find('.js-form-img:last').data('target') - 1;
		form.find('.js-form-img:last').remove();
		if(count == 1){
			$(this).remove();
		} else if(count == 3){
			const span = `<span class="mini-button js-add-img">画像を追加</span>`;
			$(this).parent().prepend(span);
		}
		event.preventDefault();
	});

*/
	//ナエ投稿バリデーション
/*	$('.js-tane-form').validate({
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
				required: 'タイトルが入力されていません',
				maxlength: 'タイトルが30文字以内で入力してください',
			},
			body: {
				required: '本文が入力されていません',
				maxlength: '本文が140字以内で入力してください',
			},
		},
		errorLabelContainer: $('.js-tane-form').find('.js-validate-error ul'),
		wrapper: 'li'
	});
	
	$('.js-tane-form').on('click', '.js-tanes-submit', function(){
		$('.js-tane-form').valid();
	});
*/

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
		},

		messages:{

			title: {
				required: '入力されていません',
				maxlength: '30文字以内で入力してください',
			},
			body: {
				required: '入力されていません',
				maxlength: '1200字以内で入力してください',
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

	function setIncomeCostRules($form_class){
		//ナエとミ、収入と支出の区別なくname属性の絞り込みで実行
		$('input[name$="[name]"]').each(function() {
			if(!$(this).parents('form').hasClass($form_class)){
				return true;
			}
			$(this).rules('add', {
				required: true,
				maxlength: 20,
				messages: {
					required: '入力されていません',
					maxlength: '10字以内で入力してください',
				}
			});
		});
		$('input[name$="[amount]"]').each(function() {
			if(!$(this).parents('form').hasClass($form_class)){
				return true;
			}
			$(this).rules('add', {
				required: true,
				number: true,
				max: 99999999999,
				min: 0,
				messages: {
					required: '入力されていません',
					number: '半角数字で入力してください',
					max: '数字が大きすぎます',
					min: '0以外で入力してください',
				}
			});
		});
		$('input[name$="[volume]"]').each(function() {
			if(!$(this).parents('form').hasClass($form_class)){
				return true;
			}
			$(this).rules('add', {
				required: true,
				number: true,
				max: 9999999999,
				min: 0,
				messages: {
					required: '入力されていません',
					number: '半角数字で入力してください',
					max: '数字が大きすぎます',
					min: '0以外で入力してください',
				}
			});
		});
	};


	$('.js-nae-form').on('click', '.js-nae-confirm', function(){
		event.preventDefault();
		//収支項目のバリデーションルールを設定(動的に増える場合があるので直前で呼び出し)
		setIncomeCostRules('js-nae-form');
		//バリデーションエラーなら終了
		if(!$('.js-nae-form').valid()){
			return false;
		}

		//モーダルのidとターゲット
		const id = $(this).data('target');
		const modal = $(document.getElementById(id));
		const domTarget = modal.find('.js-dom-target');
		const submitTarget = modal.find('.js-submit-target');

		//formの入力値からナエのモデルとDOMを取得
		let fd =  new FormData($(this).parents('.js-nae-form').get(0));
		$.ajax({
			headers: {'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')},
			type: 'POST',
			url: route + 'ajax/get/nae',
			timeout: 10000,
			data: fd,
			dataType : "json",
			contentType: false,
			processData: false,
		}).done(function(data){
			//取得したDOMをモーダルに追加(前回の確認DOMを削除)
			domTarget.empty();
			domTarget.append(data.dom);
			submitTarget.empty();
			submitTarget.append(data.submit);
			//確認モーダルをひらく
			$('.js-nae-confirm').trigger('openModal');
		}).fail(function(jqXHR, textStatus, errorThrown){
			domTarget.empty();
			submitTarget.empty();
			if(jqXHR.status == 419){
				//419(csrfトークン切れ)
				location.href = location.href;
			}else if(jqXHR.status == 422){
				domTarget.append('<div>入力内容が適切ではありませんでした</div>');
				$.each(jqXHR.responseJSON.errors, function(name, error) {
					// エラーが発生した入力項目を取得します。
					let message = $(`<div class="text-red-600">${error}</div>`)
					domTarget.append(message);

				});
				$('.js-nae-confirm').trigger('openModal');
			}
		});
	});

	//カスタムイベントでモーダルを開閉
	$('.js-nae-confirm').on('openModal', openModal);
	//確認のモーダルのリンクタグを無効化
//	$(document).on('click', '#js-modal/nae/confirm', function(){
//		return false;
//	});

	$(document).on('click', '.js-nae-submit', function(){
		$.find('.js-nae-form').submit()
	});

	//ナエ投稿バリデーション
	$('.js-mi-form').validate({
		rules:{
			title: {
				required: true,
				maxlength: 30,
			},
			body: {
				required: true,
				maxlength: 1200,
			},
		},

		messages:{

			title: {
				required: '入力されていません',
				maxlength: '30文字以内で入力してください',
			},
			body: {
				required: '入力されていません',
				maxlength: '1200字以内で入力してください',
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


	$('.js-mi-form').on('click', '.js-mi-confirm', function(){
		event.preventDefault();
		//収支項目のバリデーションルールを設定(動的に増える場合があるので直前で呼び出し)
		setIncomeCostRules();
		//バリデーションエラーなら終了
		if(!$('.js-mi-form').valid()){
			return false;
		}

		//モーダルのidとターゲット
		const id = $(this).data('target');
		const modal = $(document.getElementById(id));
		const domTarget = modal.find('.js-dom-target');
		const submitTarget = modal.find('.js-submit-target');

		//formの入力値からナエのモデルとDOMを取得
		let fd =  new FormData($(this).parents('.js-mi-form').get(0));
		$.ajax({
			headers: {'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')},
			type: 'POST',
			url: route + 'ajax/get/mi',
			timeout: 10000,
			data: fd,
			dataType : "json",
			contentType: false,
			processData: false,
		}).done(function(data){
			//取得したDOMをモーダルに追加(前回の確認DOMを削除)
			domTarget.empty();
			domTarget.append(data.dom);
			submitTarget.empty();
			submitTarget.append(data.submit);
			//確認モーダルをひらく
			$('.js-mi-confirm').trigger('openModal');
		}).fail(function(jqXHR, textStatus, errorThrown){
			domTarget.empty();
			submitTarget.empty();
			if(jqXHR.status == 419){
				//419(csrfトークン切れ)
				location.href = location.href;
			}else if(jqXHR.status == 422){
				domTarget.append('<div>入力内容が適切ではありませんでした</div>');
				$.each(jqXHR.responseJSON.errors, function(name, error) {
					// エラーが発生した入力項目を取得します。
					let message = $(`<div class="text-red-600">${error}</div>`)
					domTarget.append(message);

				});
				$('.js-mi-confirm').trigger('openModal');
			}
		});
	});

	//カスタムイベントでモーダルを開閉
	$('.js-mi-confirm').on('openModal', openModal);
	//確認のモーダルのリンクタグを無効化
//	$(document).on('click', '#js-modal/mi/confirm', function(){
//		return false;
//	});

	$(document).on('click', '.js-mi-submit', function(){
		$.find('.js-mi-form').submit()
	});

	$(document).on('click', '.js-good', function(){
		const tar = $(this);
		const postId = tar.data('postid');
		const postType = tar.data('posttype');
		const userId = tar.data('userid');
		const csrfToken = $('meta[name="_token"]').attr('content');
		if(!userId){ location.href = `${route}login`;}

		$.ajax({
			headers: {'X-CSRF-TOKEN': csrfToken},
			type: 'POST',
			url: route + 'ajax_good',
			timeout: 10000,
			data: {
				user_id : userId,
				post_id : postId,
				post_type : postType,
			},
			dataType : "json",
		}).done(function(data){
			tar.find('.js-good-count').html(data.count);
			if(data.ex == false){
				let src = `${route}img/good2.svg`;
				tar.find('img').attr('src', src);
			}else{
				let src = `${route}img/good-w.svg`;
				tar.find('img').attr('src', src);
			}
		}).fail(function(data){
			//失敗時
		});
	});

	$(document).on('click', '.js-basket', function(){
		const tar = $(this);
		const postId = tar.data('postid');
		const postType = tar.data('posttype');
		const userId = tar.data('userid');
		const csrfToken = $('meta[name="_token"]').attr('content');

		if(!userId){ location.href = `${route}login`;}

		$.ajax({
			headers: {'X-CSRF-TOKEN': csrfToken},
			type: 'POST',
			url: route + 'ajax_basket',
			timeout: 10000,
			data: {
				user_id : userId,
				post_id : postId,
				post_type : postType
			},
			dataType : "json",
		}).done(function(data){
			if(data.ex == false){
				let src = `${route}img/basket-checked-tomato.svg`;
				tar.find('img').attr('src', src);
			}else{
				let src = `${route}img/basket-plus-w.svg`;
				tar.find('img').attr('src', src);
			}
		}).fail(function(data){
			//失敗時
		});
	});

/*20210302 不要
	$('.js-delete-confirm').on('click', function(){
		const tar = $(this);
		const postId = tar.data('postid');
		const userId = tar.data('userid');
		const csrfToken = tar.data('csrftoken');

		$('.js-delete').data('postid', postId).data('userid', userId).data('csrftoken', csrfToken);
	});
*/

	$(document).on('click', '.js-delete', function(){
		const tar = $(this);
		const postId = tar.data('postid');
		const userId = tar.data('userid');
		const csrfToken = $('meta[name="_token"]').attr('content');

		if(!userId){ location.href = "login";}

		$.ajax({
			headers: {'X-CSRF-TOKEN': csrfToken},
			type: 'POST',
			url: route + 'ajax_delete',
			timeout: 10000,
			data: {
				user_id : userId,
				post_id : postId
			},
			dataType : "json",
		}).done(function(data){
			if(data.ex == "delete"){
				location.reload();
			}else if(data.ex == "failed"){
				location.reload();
			}
		}).fail(function(data){
			//失敗時
		});
	});

	//タネナエミの切り替え

	//検索
	$('.js-changetype-search').on('click', function(){
		let target = $(this).data('target');
		let ret = $(this).hasClass('js-type-on');

		if (ret == true){
			if($(this).parent().children('.js-type-on').length > 1){
				let src = `img/${target}-g.svg`;
				$(this).toggleClass('js-type-on').next().remove();
				$(this).attr('src', src);
			}
		}else{
			let hidden = `<input type="hidden" name="type[]" value="${target}">`;
			$(this).toggleClass('js-type-on').after(hidden);
			let src = `img/${target}2.svg`;
			$(this).attr('src', src);
		}
	});

	//ナエとミの画像をクリックで拡大
	$('.js-img-closeup').on('click', function(){
		var src = $(this).find('img').attr('src');
		winScrollTop = $(window).scrollTop();
		let tag = `<div class="modal-bg js-img-close></div><div class="modal-img"><img src="${src}" /></div>`;
		$('body').prepend(tag);
	});

	$('.js-img-close').on('click', '.img-container', function(){
		$('.js-img-close').remove();
	});

	var $tagify = $('.js-tagify').tagify({
		whitelist : [],
		delimiters: " |,|　",
		originalInputValueFormat: valuesArr => valuesArr.map(item => item.value).join(','),
		pattern: /^[^#].*$/,
	}).on('add', function(e, tagName){
//		console.log('JQEURY EVENT: ', 'added', tagName)
	}).on("invalid", function(e, tagName) {
//		console.log('JQEURY EVENT: ',"invalid", e, ' ', tagName);
	}).on('change', function(e){
//		console.log('JQEURY EVENT: ',"change", e.target.value);
	});

	// get the Tagify instance assigned for this jQuery input object so its methods could be accessed
	var jqTagify = $tagify.data('tagify');

	// bind the "click" event on the "remove all tags" button
//	$('.tags-jquery--removeAllBtn').on('click', jqTagify.removeAllTags.bind(jqTagify))

	$('.js-infinitescroll-container').infiniteScroll({
		button : ".js-infinitescroll-nav",
		path : ".js-infinitescroll-next",
		append : ".js-infinitescroll-item",
		hideNav : ".js-infinitescroll-nav",
		status : ".js-infinitescroll-status",
		history : "false",
	});

	$('.js-togglebutton').on('click', function(){
		const tar = $(this);
		const columnName = tar.data('columnname');
		const userId = tar.data('userid');
		const status = tar.data('status');
		const csrfToken = $('meta[name="_token"]').attr('content');
		tar.toggleClass('nm-inset-lettuce-300 text-right').toggleClass('nm-inset-gray-400 text-left');

		$.ajax({
			headers: {'X-CSRF-TOKEN': csrfToken},
			type: 'POST',
			url: route + 'ajax_user_notification_config',
			timeout: 10000,
			data: {
				user_id : userId,
				column_name : columnName,
				status : status,
			},
			dataType : "json",
		}).done(function(data){
			if(data.result == null){
				tar.removeClass('nm-inset-lettuce-300 text-right').addClass('nm-inset-gray-400 text-left');
				tar.data('status', 'off');
			}else{
				tar.removeClass('nm-inset-gray-400 text-left').addClass('nm-inset-lettuce-300 text-right');
				tar.data('status', 'on');
			}
		}).fail(function(data){
			//エラー時
			tar.toggleClass('nm-inset-lettuce-300 text-right').toggleClass('nm-inset-gray-400 text-left');
		});
	});

	$('.js-expandmenu-button').on('click', function(){
		const tar = $(this).parents('.js-expandmenu');
		const target = tar.find('.js-expandmenu-target');
		const status = tar.find('.js-expandmenu-status');
		if(target.hasClass('hidden')){
			status.text('-');
		}else{
			status.text('+');
		}
		target.toggleClass('hidden');
	});

/*
	var h = $(window).height();
	$('#wrap').css('display','none');
	$('#loader-bg ,#loader').height(h).css('display','block');

	$(window).load(function () { //全ての読み込みが完了したら実行
		$('#loader-bg').delay(900).fadeOut(800);
		$('#loader').delay(600).fadeOut(300);
		$('#wrap').css('display', 'block');
	});

	//10秒たったら強制的にロード画面を非表示
	$(function(){
		setTimeout('stopload()',10000);
	});

	function stopload(){
		$('#wrap').css('display','block');
		$('#loader-bg').delay(900).fadeOut(800);
		$('#loader').delay(600).fadeOut(300);
	}
*/
});