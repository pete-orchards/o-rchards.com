<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AccountEditController extends Controller
{
	public function edit(Request $request){
		$pdo = dbConnect();
		$dbUserData = getUser($_SESSION['user_id']);

		$name = $_POST['name'];
		$u_id = $_POST['u_id'];
		$prof_comment = $_POST['prof_comment'];
		$url = $_POST['url'];
		$location = $_POST['location'];

		$user_id = $_SESSION['user_id'];
		$id = $dbUserData['id'];

		validRequired($name, 'name');
		validRequired($u_id, 'u_id');

		if(empty($err_msg)){
			// ユーザー名文字数チェック
			validMaxLen($name, 'name', 15);
			// ユーザーid文字数チェック
			validMaxLen($u_id, 'u_id', 15);
			// コメント文字数チェック
			validMaxLen($prof_comment, 'prof_comment', 255);
			// url文字数チェック
			validMaxLen($url, 'url', 255);
			// 地域文字数チェック
			validMaxLen($location, 'location', 50);

			// ユーザーid重複チェック
			if($u_id !== $_SESSION['user_id']){validUserIdDup($u_id);}

			//url、location、prof_commentのバリデーション処理

			if(empty($err_msg)){
				try{
					// DB接続
					$sql = 'UPDATE users set name = :name, u_id = :u_id where u_id = :user_id';
					$data = array(
						':name' => $name,
						':u_id' => $u_id,
						':user_id' => $user_id
					);
					// クエリ実行
					$stmt = queryPost($pdo, $sql, $data);

					// クエリ成功の場合
					if($stmt){

						try{
							$sql2= 'UPDATE user_details set prof_comment = :prof_comment, location = :location, url = :url where user_id = :id';
							$data2 = array(
								':prof_comment' => $prof_comment,
								':location' => $location,
								':url' => $url,
								':id' => $id
							);
							$stmt2 = queryPost($pdo, $sql2, $data2);
							// クエリ成功の場合
							$success = 1;
							// ユーザーIDを格納
							$_SESSION['user_id'] = $u_id;
							header("Location:account.php?user_id=". $_SESSION['user_id']. "&item=1&suc=1");
							exit;
						}
						catch(Exception $e){
							$err_msg['common'] = MSG07;
						}
					}
				}
				catch(Exception $e){
					$err_msg['common'] = MSG07;
				}
			}
		}

	}

	public function icon_edit(){
		$pdo = dbConnect();

		if(!empty($_POST)){
			$prof_img = (!empty($_FILES['prof_img']['name'])) ? uploadIcon($_FILES['prof_img'], 'prof_img') : '';
			$user_id = $_POST['user_id'];

			if(!empty($prof_img)){
				try{
					// DB接続
					$sql = 'UPDATE user_details SET prof_img =:prof_img WHERE user_id = :user_id';
					$data = array(':prof_img' => $prof_img, ':user_id' => $user_id);
					
					// クエリ実行
					$stmt = queryPost($pdo, $sql, $data);

					if(!empty($stmt)){
						$success = 1;
					}
					return redirect("account.php?user_id=". $_SESSION['user_id']);

				}
				catch(Exception $e){
					$err_msg['common'] = MSG07;
				}
			}
		}
	}
}
