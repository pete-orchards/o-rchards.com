'use strict';

jQuery(function($){
	$('.js-togglebutton').on('click', function(){
		const tar = $(this);
		const columnName = tar.data('columnname');
		const userId = tar.data('userid');
		const status = tar.data('status');
		const csrfToken = tar.data('csrftoken');
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
});