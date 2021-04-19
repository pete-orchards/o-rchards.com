<div>
	<div class="text-center text-lg p-1">通知</div>
	<div class="border-b border-ivory-300 my-1">
		<div class="flex">
			<div class="pr-2 border-r text-left border-ivory-300 flex-grow">
				メールで他ユーザーの反応の通知を受け取る
			</div>
			<div class="mx-1 my-auto">
				@include('components.js.togglebutton', [
					'data' => $user->notification_config->mail_general,
					'column_name' => 'mail_general',
					'user_id' => $user->id,
					'opt' => 'autofocus',
				])
			</div>
		</div>

		<div class="ml-4 js-expandmenu">
			<div class="text-left js-expandmenu-button">
				<span class="bg-tomato-500 inline-block rounded-full text-white w-5 h-5 text-center leading-5 js-expandmenu-status">+</span> 個別設定
			</div>

			<div class="hidden js-expandmenu-target">
				<div class="flex justify-end mb-2 ml-4">
					<div class="pr-2 border-r text-left flex-grow border-ivory-300">
						-> 「いいね」
					</div>
					<div class="mx-1 my-auto">
						@include('components.js.togglebutton', [
							'data' => $user->notification_config->mail_good,
							'column_name' => 'mail_good',
							'user_id' => $user->id,
						])
					</div>
				</div>

				<div class="flex justify-end mb-2 ml-4">
					<div class="pr-2 border-r text-left flex-grow border-ivory-300">
						-> バスケットへの追加
					</div>
					<div class="mx-1 my-auto">
						@include('components.js.togglebutton', [
							'data' => $user->notification_config->mail_basket,
							'column_name' => 'mail_basket',
							'user_id' => $user->id,
						])
					</div>
				</div>

				<div class="flex justify-end mb-2 ml-4">
					<div class="pr-2 border-r text-left flex-grow border-ivory-300">
						-> 関連投稿
					</div>
					<div class="mx-1 my-auto">
						@include('components.js.togglebutton', [
							'data' => $user->notification_config->mail_reference,
							'column_name' => 'mail_reference',
							'user_id' => $user->id,
						])
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="border-b border-ivory-300 my-1">
		<div class="flex">
			<div class="pr-2 border-r text-left border-ivory-300 flex-grow">
				リアクションのプッシュ通知を受け取る<span class="text-gray-500 text-sm px-1">(対応ブラウザのみ)</span>
				<div class="text-gray-500 text-sm">※ブラウザの通知設定で、当サイトからの通知を許可してください</div>
			</div>
			<div class="mx-1 my-auto">
				@include('components.js.togglebutton', [
					'data' => $user->notification_config->push_general,
					'column_name' => 'push_general',
					'user_id' => $user->id,
				])
			</div>
		</div>

		<div class="ml-4 js-expandmenu">
			<div class="text-left js-expandmenu-button">
				<span class="bg-tomato-500 inline-block rounded-full text-white w-5 h-5 text-center leading-5 js-expandmenu-status">+</span> 個別設定
			</div>

			<div class="hidden js-expandmenu-target">
				<div class="flex justify-end mb-2 ml-4">
					<div class="pr-2 border-r text-left flex-grow border-ivory-300">
						-> 「いいね」
					</div>
					<div class="mx-1 my-auto">
						@include('components.js.togglebutton', [
							'data' => $user->notification_config->push_good,
							'column_name' => 'push_good',
							'user_id' => $user->id,
						])
					</div>
				</div>

				<div class="flex justify-end mb-2 ml-4">
					<div class="pr-2 border-r text-left flex-grow border-ivory-300">
						-> バスケットへの追加
					</div>
					<div class="mx-1 my-auto">
						@include('components.js.togglebutton', [
							'data' => $user->notification_config->push_basket,
							'column_name' => 'push_basket',
							'user_id' => $user->id,
						])
					</div>
				</div>

				<div class="flex justify-end mb-2 ml-4">
					<div class="pr-2 border-r text-left flex-grow border-ivory-300">
						-> 関連投稿
					</div>
					<div class="mx-1 my-auto">
						@include('components.js.togglebutton', [
							'data' => $user->notification_config->push_reference,
							'column_name' => 'push_reference',
							'user_id' => $user->id,
						])
					</div>
				</div>
			</div>
		</div>
	</div>
</div>