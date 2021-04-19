@if(!empty($msg))
<div class="text-center p-2 bg-tomato-500 text-white m-2">
	{{$msg}}
</div>
@endif

@if($errors->any())
<span class="text-red-600" role="alert">
	<strong>エラーが発生しました</strong>
</span>
@endif

<div class="border-b border-ivory-300 p-1 my-2">
	@include('utilities.img.user_icon', ['src' => $user->prof_path(), 'sizing' => 'w-32 h-32'])

	<div class="">
		<div class="">
			<div>{{Auth::user()->name}}</div>
			<span class="text-sm">{{'@'.Auth::user()->user_id}}</span>
		</div>
	</div>
</div>

<br>

<div class="text-center">
	<form action="" method="post" enctype="multipart/form-data">
		@csrf
		<div class="my-4 w-32 mx-auto">
			<label for="prof_img" class="hover:bg-opacity-75">
				<div class="nm-flat-ivory-200 mx-auto p-1 rounded-lg">
					<div class="text-sm">画像を選択</div>
					@include('utilities.img.user_icon', ['src' => asset('img/account.svg'), 'sizing' => 'w-16 h-16'])
					<input id="prof_img" type="file" name="prof_img" class="hidden js-iconview" multiple accept="image/jpeg, image/gif, image/png">
				</div>
			</label>
		</div>
		<input type="hidden" name="user_id" value="{{Auth::id()}}">
		@include('utilities.buttons.submit', [
			'text' => '変更',
			'color' => 'bg-tomato-500',
		])
	</form>
</div>

<script>
	'use strict';
	jQuery(function($){
		//アップロードするプロフィール画像を確認表示(アカウントページ)
		$('.js-iconview').on('change',function(){
			let me = $(this);
			let file = $(this).prop('files')[0];
			let fr = new FileReader();
			let target = me.siblings('img');
			if(file.type.match(/^image/)){
				fr.onload = function() {
					target.attr('src', fr.result);
				}
				fr.readAsDataURL(file);
			}
		});

	});
</script>