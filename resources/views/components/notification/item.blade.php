<div class="rounded-lg mb-4 nm-flat-ivory-200 flex relative border-4 box-border relative z-3 @if($notification->post()->post_type->name == 'tane'){{'border-chocolate-800'}}@elseif($notification->post()->post_type->name == 'nae'){{'border-lettuce-300'}}@elseif($notification->post()->post_type->name == 'mi'){{'border-tomato-500'}}@endif" id="{{$notification->id}}">
	@if($notification->notifiable_type == "goods")
	@include('components.notification.good')
	@elseif($notification->notifiable_type == "user_baskets")
	@include('components.notification.basket')
	@elseif($notification->notifiable_type == "post_references")
	@include('components.notification.reference')
	@endif
	@include('components.notification.detail-link', ['post' => $notification->post()])
</div>