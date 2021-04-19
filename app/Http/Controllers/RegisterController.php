<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegisterController extends Controller
{
	public function index(){
		return view('register');
	}

	public function register(Request $request){

		$name = $_POST['name'];
		$u_id = $_POST['u_id'];
		$email = $_POST['email'];
		$pass = $_POST['pass'];
		$pass2 = $_POST['pass2'];
		if(!empty($_POST['terms'])){
			$terms = $_POST['terms'];
		}else{
			$terms = "";
		}
		if(!empty($_POST['privacypolicy'])){
			$privacypolicy = $_POST['privacypolicy'];
		}else{
			$privacypolicy = "";
		}

		// 未入力チェック
		validRequired($name, 'name');
		validRequired($u_id, 'u_id');
		validRequired($email, 'email');
		validRequired($pass, 'pass');
		validRequired($pass2, 'pass2');
		validRequired($terms, 'terms');
		validRequired($privacypolicy, 'privacypolicy');

		if(empty($err_msg)){
			// ユーザー名文字数チェック
			validMaxLen($name, 'name', 15);

			// ユーザーid文字数チェック
			validMaxLen($u_id, 'u_id', 15);
			// ユーザーid重複チェック
			validUserIdDup($u_id);

			// emailの形式チェック
			validEmail($email, 'email');
			// emailの最大文字数チェック
			validMaxLen($email, 'email');
			// email重複チェック
			validEmailDup($email);

			// パスワードチェック
			validPass($pass, 'pass');

			if(empty($err_msg)){
				// パスワードとパスワード（再入力）が合っているかのチェック
				validMatch($pass, $pass2, 'pass2');

				if(empty($err_msg)){
					try{
						// DB接続
						$pdo = dbConnect();
						$sql = 'INSERT INTO users (id, name, u_id, email, pass, login_time, created_date) VALUES (null, :name, :u_id, :email, :pass, :login_time, :created_date)';
						$data = array(
							':name' => $name, ':u_id' => $u_id, ':email' => $email, ':pass' => password_hash($pass, PASSWORD_DEFAULT),
							':login_time' => date('Y-m-d H:i:s'), ':created_date' => date('Y-m-d H:i:s')
						);
						// クエリ実行
						$stmt = queryPost($pdo, $sql, $data);

						// クエリ成功の場合
						if($stmt){
							// ログイン有効期限（デフォルトは1時間）
							$sesLimit = 60*60;
							// ログイン日時を現在日時に更新
							$_SESSION['login_date'] = time();
							$_SESSION['login_limit'] = $sesLimit;
							// ユーザーIDを格納
							$_SESSION['user_id'] = $u_id;
							$user_id = $pdo->lastInsertId();

							try{
								$sql2= 'insert into user_details(user_id) values(:user_id)';
								$data2 = array(':user_id' => $user_id);
								$stmt2 = queryPost($pdo, $sql2, $data2);
								// クエリ成功の場合

								// メールを送信
								$to = $email;
								$from = 'info@o-rchards.com';
								$title = 'Orchardsへの登録が完了しました';
								$body = <<<EOT
Orchardsへのご登録ありがとうございます。
ぜひ当サイトをご自身のために活用し、
暮らしにお役立てください。

////////////////////////////////////////
ご登録内容

お名前: $name
ユーザーid: $u_id
メールアドレス: $email
パスワード: ****(非公開の内容です)
////////////////////////////////////////

ログインのためにはユーザーidとパスワードが必要です。
またアカウントページから追加のユーザー情報を記入できます。

今後ともOrchardsをよろしくお願いいたします。

Orchards運営

このメールは自動送信です
EOT;
								$result = mailSubmit($to, $from, $title, $body);

								return redirect('account.php?user_id='.$_SESSION['user_id']);
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
		return view('regiter', ['err_msg' => $err_msg]);
	}

}
