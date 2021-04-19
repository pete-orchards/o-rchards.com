<article class="account-main profile-container">

	<?php if(!empty($success)) : ?>
	<div class="update-notice">
		更新しました
	</div>
	<?php elseif(!empty($err_msg)) : ?>
	<div class="update-notice">
		<?= $err_msg['prof_img'] ?>
	</div>
	<?php endif; ?>

	<div class="err_msg">
		<?= getErrMsg('common'); ?>
	</div>

		<div class="account-header">
			<img class="ac_prof_img" src="<?= showProf($dbUserData['prof_img']) ?>">

			<div class="textbox">
				<div class="account-name">
					<p><?= $dbUserData['name'] ?></p>
					<small>@<?= $dbUserData['u_id'] ?></small>
				</div>
			</div>
		</div>

		<br>

		<?php if($icon_page_flag === 0) : ?>

		<div class="icon-edit-wrapper">
			<form action="account_icon_edit" method="post" enctype="multipart/form-data">
				<p><input type="file" name="prof_img" class="js-iconview"></p>
				<input class="button" type="submit" name="btn_icon_submit" value="変更する">
				<input type="hidden" name="user_id" value="<?= $dbUserData['id']?>">
			</form>
		</div>

		<?php elseif ($icon_page_flag === 1) : ?>

		<?php else : ?>
			エラーが発生しました
		<?php endif; ?>

</article>