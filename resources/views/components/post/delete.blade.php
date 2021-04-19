<div class="border-b border-r border-sepia-800 rounded-lg text-left relative z-3 hover:bg-brightness-125 js-modal-open js-delete-confirm" data-target="js-modal/post/delete/{{$post->id}}">
	<img src="{{asset('img/dustbox-w.svg')}}" class="w-8 h-8 inline p-1" alt="delete">
</div>

@component('components.js.modal.content', ['id' => 'js-modal/post/delete/'.$post->id, 'size' => 'fit-content'])
<div class="text-center p-4">
	投稿を削除してよろしいですか？
</div>
<div class="text-center p-4">
	<span class="inline-block text-md rounded-lg py-1 px-4 bg-red-500 text-white hover:bg-opacity-75 js-delete" data-postid="{{$post->id}}" data-userid="@auth{{Auth::id()}}@endauth" data-csrftoken="{{csrf_token()}}">削除する</span>
	@include('utilities.buttons.a2', [
		'href' => '',
		'color' => 'bg-gray-600',
		'text' => 'キャンセル',
		'opt' => 'js-modal-close'
	])
</div>
@endcomponent