<article class="account-main profile-container">
	<div class="account-header">
		<div>

			<img class="ac_prof_img" src="{{asset($user->prof_path())}}">
		</div>

		<div class="textbox">
			<div class="account-name">
				<p>{{$user->name}}</p>
				<small>{{'@'.$user->user_id}}</small>
			</div>
		</div>
	</div>

	<div style="margin:10px auto; ">
		<div>
			<img class="ac-icon" src="{{asset('/img/comment.svg')}}" alt="Comment">コメント:
			@if($user->detail->prof_comment)
			<p>{!!nl2br(e($user->detail->prof_comment))!!}</p>
			@else
			{{__('Not set')}}
			@endif
		</div>
		<br>

		<div>
			<img class="ac-icon" src="{{asset('/img/website.svg')}}" alt="Website">Webサイト:
			@if($user->detail->url)
			<a href="{{$user->detail->url}}" target="_blanc">{{$user->detail->url}}</a>
			@else
			{{__('Not set')}}
			@endif
		</div>

		<div>
			<p>
				<img class="ac-icon" src="{{asset('/img/location.svg')}}" alt="Location">地域: 
				@if($user->detail->location)
				{{$user->detail->location}}
				@else
				{{__('Not set')}}
				@endif
			</p>
		</div>
	</div>
<?php /*
	<div>
		<div class="ac-postlist js-tabcontrol">
			<a href="#post" class="js-tab js-tab-active">
				<div>
					<img class="ac-icon" src="img/post.svg" alt="Post">全投稿
				</div>
			</a>
			<a href="#tane" class="js-tab">
				<div>
					<img class="ac-icon" src="img/tane2.svg" alt="Tane">タネ
				</div>
			</a>
			<a href="#nae" class="js-tab">
				<div>
					<img class="ac-icon" src="img/nae2.svg" alt="Nae">ナエ
				</div>
			</a>
			<a href="#mi" class="js-tab">
				<div>
					<img class="ac-icon" src="img/mi2.svg" alt="Mi">ミ
				</div>
			</a>
			<a href="#good" class="js-tab">
				<div>
					<img class="ac-icon" src="img/good2.svg" alt="Good">Good
				</div>
			</a>
			<?php if(!empty($_SESSION['user_id'])): ?>
				<?php if($_SESSION['user_id'] == $_GET['user_id']): ?>
					<a href="#basket" class="js-tab">
						<div>
							<img class="ac-icon" src="img/basket-checked-tomato.svg" alt="Basket">バスケット
						</div>
					</a>
				<?php endif; ?>
			<?php endif; ?>
		</div>

		<div class="js-tabbody">
			<section id="post" class="tabbody-item js-tabbody-show">
				<?php $dbPostList = getPostListByUserId($dbUserData['id']);
				if (!empty($dbPostList)) :
					foreach ($dbPostList as $key => $dbPost) :

						if($dbPost['type'] === "tane"){
							$post_id = $dbPost['id'];
							require __dir__.'/tane-body.php';
						}
						elseif($dbPost['type'] === "nae"){
							$post_id = $dbPost['id'];
							require __dir__.'/nae-body.php';
						}elseif($dbPost['type'] === "mi"){
							$post_id = $dbPost['id'];
							require __dir__.'/mi-body.php';
						}


					endforeach;
				else :
					if(!empty($_POST['keyword'])): ?>
						<div>
							検索に関連する投稿がありませんでした。
						</div>
					<?php else : ?>
						<div>
							まだ投稿がありません。
						</div>

					<?php endif; ?>
				<?php endif; ?>
			</section>
			<section id="tane" class="tabbody-item">
				<?php
				$dbTaneList = getPostListByUserIdByType($dbUserData['id'], "tane");
				if (!empty($dbTaneList)) :
					foreach ($dbTaneList as $key => $dbTane) :
						$post_id = $dbTane['id'];
						require __dir__.'/tane-body.php';
					endforeach;
				else : ?>
						<div>
							まだ投稿がありません。
						</div>
				<?php endif; ?>
			</section>
			<section id="nae" class="tabbody-item">
				<?php
				$dbNaeList = getPostListByUserIdByType($dbUserData['id'], "nae");
				if (!empty($dbNaeList)) :
					foreach ($dbNaeList as $key => $dbNae) :
						$post_id = $dbNae['id'];
						require __dir__.'/nae-body.php';
					endforeach;
				else : ?>
						<div>
							まだ投稿がありません。
						</div>

				<?php endif; ?>
			</section>
			<section id="mi" class="tabbody-item">
				<?php
				$dbMiList = getPostListByUserIdByType($dbUserData['id'], "mi");
				if (!empty($dbMiList)) :
					foreach ($dbMiList as $key => $dbMi) :
						$post_id = $dbMi['id'];
						require __dir__.'/mi-body.php';
					endforeach;
				else : ?>
						<div>
							まだ投稿がありません。
						</div>

				<?php endif; ?>
			</section>

			<section id="good" class="tabbody-item">
				<?php
				$dbGoodList = getUserPostGoodAll($dbUserData['id']);
				if (!empty($dbGoodList)) :
					foreach ($dbGoodList as $key => $dbGood) :
						if($dbGood['type'] === "tane"){
							$post_id = $dbGood['id'];
							require __dir__.'/tane-body.php';
						}
						elseif($dbGood['type'] === "nae"){
							$post_id = $dbGood['id'];
							require __dir__.'/nae-body.php';
						}
					endforeach;
				else :
					if(!empty($_POST['keyword'])): ?>
						<div>
							検索に関連する投稿がありませんでした。
						</div>
					<?php else : ?>
						<div>
							まだ投稿がありません。
						</div>

					<?php endif; ?>
				<?php endif; ?>
			</section>

			<?php if(!empty($_SESSION['user_id'])): ?>
				<?php if($_SESSION['user_id'] == $_GET['user_id']): ?>
					<section id="basket" class="tabbody-item">
						<?php
						$dbBasketList = getUserBasketAll($dbUserData['id']);
						if (!empty($dbBasketList)) :
							foreach ($dbBasketList as $key => $dbBasket) :
								if($dbBasket['type'] === "tane"){
									$post_id = $dbBasket['id'];
									require __dir__.'/tane-body.php';
								}
								elseif($dbBasket['type'] === "nae"){
									$post_id = $dbBasket['id'];
									require __dir__.'/nae-body.php';
								}
							endforeach;
						else :
							if(!empty($_POST['keyword'])): ?>
								<div>
									検索に関連する投稿がありませんでした。
								</div>
								<?php else : ?>
									<div>
										まだ投稿がありません。
									</div>

								<?php endif; ?>
							<?php endif; ?>
					</section>
				<?php endif; ?>
			<?php endif; ?>

		</div>
	</div>
*/ ?>
</article>