'use strict';
jQuery(function($){
	$('.js-{{$type}}-form').on('click', '.js-add-{{$type}}-img', function(){
		let tar = $(this);
		let container = tar.parent().prevAll('.js-img-container');
		let count = container.find('.js-img-items').length + 1;
		if(count <= 4){
			const item = `@include('components.form.img_item', ['key' => '${count}'])`;
			container.find('.js-img-items:last').after(item);

			if(count == 4){
				$(this).remove();
			} else if(count == 2){
				const removebutton = `@include('components.form.img_removebutton')`;
				$(this).after(removebutton);
			}
		}
		resizeImg(container);
		event.preventDefault();
	});
	$(document).on('click', '.js-remove-{{$type}}-img', function(){
		let tar = $(this);
		let container = tar.parent().prevAll('.js-img-container');
		let count = container.find('.js-img-items').length - 1;
		container.find('.js-img-items:last').remove();
		if(count == 1){
			$(this).remove();
		} else if(count == 3){
			const addbutton = `@include('components.form.img_addbutton')`;
			$(this).before(addbutton);
		}
		resizeImg(container);
		event.preventDefault();
	});

	function resizeImg(container){
		let items = container.find('.js-img-items');
		let count = items.length;
		if(count == 1){
			items.removeClass('col-span-2 col-span-1 row-span-2 row-span-1').addClass('col-span-2 row-span-2');
		}else if(count == 2){
			items.removeClass('col-span-2 col-span-1 row-span-2 row-span-1').addClass('col-span-1 row-span-2');
		} if(count == 3){
			items.removeClass('col-span-2 col-span-1 row-span-2 row-span-1');
			items.first().addClass('col-span-1 row-span-2');
			items.eq(1).addClass('col-span-1 row-span-1');
			items.eq(2).addClass('col-span-1 row-span-1');
		} if(count == 4){
			items.removeClass('col-span-2 col-span-1 row-span-2 row-span-1').addClass('col-span-1 row-span-1');
		}
	};

	$('.js-img-container').on('change', '.js-{{$type}}-img', function(){
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
			const frame = $('.js-img-container');
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

});