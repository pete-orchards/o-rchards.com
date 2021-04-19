<?php

// セッションファイルの置き場を変更(30日は削除されない デフォルト有効期限は24分)
//session_save_path("/var/tmp/");
// ガーベージコレクションが削除するセッションの有効期限を設定
ini_set('session.gc_maxlifetime', 60*60*24*30);
// ブラウザを閉じても削除されないようにクッキー自体の有効期限を延ばす
ini_set('session.cookie_lifetime', 60*60*24*30);
// セッション使用
session_start();
// セッションIDを新しく発行(なりすまし対策)
session_regenerate_id();


// エラーメッセージ
define('MSG01', '入力必須です');
define('MSG02', '半角英数字で入力してください');
define('MSG03', 'パスワード(再入力)が合っていません');
define('MSG04', '文字以上で入力してください');
define('MSG05', 'E-mailの形式で入力してください');
define('MSG06', '文字以内で入力してください');
define('MSG07', 'エラーが発生しました。しばらく経ってからやり直してください');
define('MSG08', 'ユーザー名またはパスワードが違います');
define('MSG09', 'そのEmailは既に登録されています');
define('MSG10', '現在のパスワードが間違っています');
define('MSG11', '現在のパスワードと同じです');
define('MSG12', '文字で入力してください');
define('MSG13', '正しくありません');
define('MSG14', '有効期限が切れています');
define('MSG15', 'そのユーザーidは既に使用されています');
define('MSG16', 'そのタネはあなたの投稿ではありません');
define('MSG17', '投稿が存在しませんでした');
// 成功時メッセージ
define('SUC01', '投稿しました');
define('SUC02', 'プロフィールを変更しました');
define('SUC03', 'パスワードを変更しました');
define('SUC04', 'メールを送信しました、ご確認ください');
define('SUC05', '削除しました');
define('SUC06', '新しいパスワードでログインしてください');


// DBへの接続準備(HelperServiceProvider@Registerで参照してくれるのでrequire不要)
//require __dir__.'/dbconnect.php';

//日本時間設定
date_default_timezone_set('Japan');

/*

$pdo = new PDO('mysql:dbname=test;host=localhost;charset=utf8', $user, $pass, [
PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
PDO::ATTR_EMULATE_PREPARES => false,
]);

*/

// SQL実行関数
function queryPost($pdo, $sql, $data){
// クエリ作成
	$stmt = $pdo->prepare($sql);
// SQL文を実行
	if(!$stmt->execute($data)){
//debug('クエリ失敗しました。');
//debug('失敗したSQL：'.print_r($stmt,true));
		$err_msg['common'] = MSG07;
		return 0;
	}
//debug('クエリ成功');
	return $stmt;
}




//管理者セッションスタート
function adminSession(){
	$name=$pass='';
	if(isset($_SESSION['admin'])){
		$name=$_SESSION['admin']['name'];
		$pass=$_SESSION['admin']['pass'];
	}
}

/* バリデーション */

// 未入力チェック
function validRequired($str, $key){
	if($str === ''){
		global $err_msg;
		$err_msg[$key] = MSG01;
	}
}
// 最大文字数チェック
function validMaxLen($str, $key, $max = 255){
$str = str_replace("\r\n", "", $str); //改行を削除
if(mb_strlen($str) > $max){
	global $err_msg;
	$err_msg[$key] = $max.MSG06;
}
}
// 最小文字数チェック
function validMinLen($str, $key, $min = 6){
	if(mb_strlen($str) < $min){
		global $err_msg;
		$err_msg[$key] = $min.MSG04;
	}
}
// email形式チェック
function validEmail($str, $key){
	if(!preg_match("/^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/", $str)){
		global $err_msg;
		$err_msg[$key] = MSG05;
	}
}
// email重複チェック
function validEmailDup($email){
	global $err_msg;
	try{
		$pdo = dbConnect();
		$sql = 'SELECT count(*) FROM users WHERE email = :email';
		$data = array(':email' => $email);
// クエリ実行
		$stmt = queryPost($pdo, $sql, $data);
// クエリ結果の値を取得
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
//debug('クエリ結果の中身'.print_r($result,true));

		if(!empty(array_shift($result))){
			$err_msg['email'] = MSG09;
		}
	}catch(Exception $e){
//error_log('エラー発生：'. $e->getMessage());
		$err_msg['common'] = MSG07;
	}

}
function validUserIdDup($u_id){
	global $err_msg;
	try{
		$pdo = dbConnect();
		$sql = 'SELECT count(*) FROM users WHERE u_id = :u_id';
		$data = array(':u_id' => $u_id);
// クエリ実行
		$stmt = queryPost($pdo, $sql, $data);
// クエリ結果の値を取得
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
//debug('クエリ結果の中身'.print_r($result,true));

		if(!empty(array_shift($result))){
			$err_msg['u_id'] = MSG15;
		}
	}catch(Exception $e){
//error_log('エラー発生：'. $e->getMessage());
		$err_msg['common'] = MSG07;
	}
}


// 半角英数字チェック
function validHalf($str, $key){
	if(!preg_match("/^[a-zA-Z0-9]+$/", $str)){
		global $err_msg;
		$err_msg[$key] = MSG02;
	}
}
// 同値チェック
function validMatch($str1, $str2, $key){
	if($str1 !== $str2){
		global $err_msg;
		$err_msg[$key] = MSG03;
	}
}
// 固定長チェック
function validLength($str, $key, $len = 8){
	if(mb_strlen($str) !== $len){
		global $err_msg;
		$err_msg[$key] = $len . MSG12;
	}
}
// パスワードチェック
function validPass($str, $key){
// 半角英数字チェック
	validHalf($str, $key);
// 最小文字数チェック
	validMinLen($str, $key);
// 最大文字数チェック
	validMaxLen($str, $key);
}
// エラーメッセージ表示
function getErrMsg($key){
	global $err_msg;
	if(!empty($err_msg[$key])){
		echo $err_msg[$key];
	}
}
//フォーム入力保持
function getFormData($str, $flg = false){
	if($flg){
		$method = $_GET;
	}else{
		$method = $_POST;
	}
	global $dbFormData;
// ユーザーデータがある場合
	if(!empty($dbUserData)){
//フォームのエラーがある場合
		if(!empty($err_msg[$str])){
//POSTにデータがある場合
			if(isset($method[$str])){
				return h($method[$str]);
			}else{
				return h($dbUserData[$str]);
			}
		}else{
// POSTにデータがあり、DBの情報と違う場合
			if(isset($method[$str]) && $method[$str] !== $dbUserData[$str]){
				return h($method[$str]);
			}else{
// 変更しない
				return h($dbUserData[$str]);
			}
		}
	}else{
		if(isset($method[$str])){
			return h($method[$str]);
		}
	}
}

/* データ取得系 */

function getUser($u_id){

	try{
		$pdo = dbConnect();
		$sql = 'SELECT * FROM users JOIN user_details ON users.id = user_details.user_id WHERE u_id = :u_id';
		$data = array(':u_id' => $u_id);
		$stmt = queryPost($pdo, $sql, $data);

		if($stmt){
			return $stmt->fetch(PDO::FETCH_ASSOC);
		}else{
			return false;
		}
	}catch(Exception $e){
	}
}

function getPostUser($id){

	try{
		$pdo = dbConnect();
		$sql = 'SELECT * FROM users JOIN user_details ON users.id = user_details.user_id WHERE id = :id';
		$data = array(':id' => $id);
		$stmt = queryPost($pdo, $sql, $data);

		if($stmt){
			return $stmt->fetch(PDO::FETCH_ASSOC);
		}else{
			return false;
		}
	}catch(Exception $e){
	}
}


/* Post */

function getPostList(){
//全てのタネを取得(投稿時間降順)
//debug('全ての投稿情報を取得します。')
	try{
		$pdo = dbConnect();
		$sql = 'SELECT * FROM posts ORDER BY id DESC';
		$data = array();
//debug('SQL:'.$sql);
//クエリ実行
		$stmt = queryPost($pdo, $sql, $data);
		if($stmt){
// クエリ結果のデータを全レコード返す
			return $stmt->fetchAll();
		}else{
			return false;
		}
	}catch(Exception $e){
//error_log('エラー発生：'. $e->getMessage());
	}
}


function getPostListByUserId($user_id){
	try{
		$pdo = dbConnect();
		$sql = 'SELECT * FROM posts WHERE user_id = :user_id AND delete_flg IS NULL ORDER BY id DESC';
		$data = array(
			':user_id' => $user_id
		);
		$stmt = queryPost($pdo, $sql, $data);
		if($stmt){
			return $stmt->fetchAll();
		}else{
			return false;
		}
	}catch(Exception $e){
	}
}

function getPostListByUserIdByType($user_id, $type){
	try{
		$pdo = dbConnect();
		$sql = 'SELECT * FROM posts WHERE user_id = :user_id AND type = :type AND delete_flg IS NULL ORDER BY id DESC';
		$data = array(
			':user_id' => $user_id,
			':type' => $type
		);
		$stmt = queryPost($pdo, $sql, $data);
		if($stmt){
			return $stmt->fetchAll();
		}else{
			return false;
		}
	}catch(Exception $e){
	}
}


function countPostGood($post_id){
	try{
		$pdo = dbConnect();
		$sql = 'SELECT * FROM post_goods WHERE post_id = :post_id';
		$data = array(':post_id' => $post_id);

		$stmt = queryPost($pdo, $sql, $data);

		if(!empty($stmt)){
			$result = $stmt->fetchAll();
			return $count = count($result);
		}else{
			return $result = '';
		}
	}catch(Exception $e){

	}
}

function getUserPostGood($user_id, $post_id){
	try{
		$pdo = dbConnect();
		$sql = 'SELECT * FROM post_goods WHERE user_id = :user_id AND post_id = :post_id ';
		$data = array('user_id' => $user_id, ':post_id' => $post_id);

		$stmt = queryPost($pdo, $sql, $data);

		if(!empty($stmt)){
			return $stmt->fetch(PDO::FETCH_ASSOC);
		}else{
			return false;
		}
	}catch(Exception $e){

	}
}

function getUserPostGoodAll($user_id){
	try{
		$pdo = dbConnect();
		$sql = 'SELECT * FROM post_goods WHERE user_id = :user_id ORDER BY post_time DESC';
		$data = array(':user_id' => $user_id);

		$stmt = queryPost($pdo, $sql, $data);

		if($stmt){
			$sql = 'SELECT * FROM post WHERE id = :id';

			foreach ($stmt->fetchAll() as $row) {
				$data = array(':id' => $row['post_id']);
				$stmt2 = queryPost($pdo, $sql, $data);
				$result[] = $stmt2->fetch(PDO::FETCH_ASSOC);
			}

			if(!empty($result)){
				return $result;
			}else{
				return false;
			}

		}else{
			return false;
		}
	}catch(Exception $e){

	}
}

function getUserBasket($user_id, $post_id){
	try{
		$pdo = dbConnect();
		$sql = 'SELECT * FROM user_baskets WHERE user_id = :user_id AND post_id = :post_id';
		$data = array('user_id' => $user_id, ':post_id' => $post_id);

		$stmt = queryPost($pdo, $sql, $data);

		if(!empty($stmt)){
			return $stmt->fetch(PDO::FETCH_ASSOC);
		}else{
			return $result = '';
		}
	}catch(Exception $e){

	}
}

function getUserBasketAll($user_id){
	try{
		$pdo = dbConnect();
		$sql = 'SELECT * FROM user_baskets JOIN posts ON user_baskets.post_id = posts.id WHERE user_baskets.user_id = :user_id ORDER BY post_time DESC';
		$data = array(':user_id' => $user_id);

		$stmt = queryPost($pdo, $sql, $data);

		if($stmt){
			$result = $stmt->fetchAll();
			foreach ($result as $key => $dbBasket){
				if($dbBasket['type']== 'tane'){
					$post = getOneTane($dbBasket['post_id']);
					$result[$key] = array_merge($result[$key], $post);
				}elseif($dbBasket['type']== 'nae'){
					$post = getOneNae($dbBasket['post_id']);
					$result[$key] = array_merge($result[$key], $post);
				}elseif($dbBasket['type']== 'mi'){
					$post = getOneMi($dbBasket['post_id']);
					$result[$key] = array_merge($result[$key], $post);
				}
			}
			return $result;
		}else{
			return false;
		}
	}catch(Exception $e){

	}
}

function validPostExist($post_id, $reference){
	global $err_msg;
	try{
		$pdo = dbConnect();
		$sql = 'SELECT * FROM posts WHERE id = :id';
		$data = array(':id' => $post_id);
// クエリ実行
		$stmt = queryPost($pdo, $sql, $data);
// クエリ結果の値を取得
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
//debug('クエリ結果の中身'.print_r($result,true));

		if(empty($result)){
			$err_msg['reference'] = MSG17;
		}
	}catch(Exception $e){
//error_log('エラー発生：'. $e->getMessage());
		$err_msg['common'] = MSG07;
	}
}

function getPostParent($post_id){
	try{
		$pdo = dbConnect();
		$sql = 'SELECT * FROM post_references JOIN posts ON post_references.ancestor_id = posts.id WHERE descendant_id = :descendant_id AND path_length = :path_length';
		$data = array(':descendant_id' => $post_id, ':path_length' => '1');

		$stmt = queryPost($pdo, $sql, $data);

		if($stmt){
			return $stmt->fetch(PDO::FETCH_ASSOC);
		}else{
			return false;
		}
	}catch(Exception $e){

	} 
}

function getPostChild($post_id){
	try{
		$pdo = dbConnect();
		$sql = 'SELECT * FROM post_references JOIN posts ON post_references.descendant_id = posts.id WHERE ancestor_id = :ancestor_id AND path_length = :path_length';
		$data = array(':ancestor_id' => $post_id, ':path_length' => '1');

		$stmt = queryPost($pdo, $sql, $data);

		if($stmt){
			return $stmt->fetchAll();
		}else{
			return false;
		}
	}catch(Exception $e){

	}
}

function countPostReference($post_id){
	try{
		$pdo = dbConnect();
		$sql = 'SELECT * FROM post_references WHERE ancestor_id = :ancestor_id OR descendant_id = :descendant_id AND path_length = :path_length';
		$data = array(':ancestor_id' => $post_id, ':descendant_id' => $post_id, ':path_length' => '1');

		$stmt = queryPost($pdo, $sql, $data);

		if(!empty($stmt)){
			$result = $stmt->fetchAll();
			return $count = count($result) - 1;
		}else{
			return $result = '';
		}
	}catch(Exception $e){

	}
}


function getReferenceAll($post_id){
	try{
		$pdo = dbConnect();
		$sql = 'SELECT * FROM post_references WHERE descendant_id = :descendant_id ORDER BY path_length DESC';
		$data = array(
			':descendant_id' => $post_id,
		);

		$stmt = queryPost($pdo, $sql, $data);

		if($stmt){
			return $stmt->fetchAll();
		}else{
			return false;
		}
	}catch(Exception $e){

	}
}

function getPostIdFromPostTypeId($post_type_id, $post_type){}

function getPostSearch($keyword, $type){

	$num = postTypeCount($type);
	try{
		$pdo = dbConnect();

		if($num == 1){
			$sql = "
				SELECT * FROM posts
				LEFT OUTER JOIN tanes ON posts.id = tanes.post_id
				WHERE tanes.body LIKE :keyword ESCAPE '!'
				AND posts.delete_flg IS NULL
				ORDER BY posts.id DESC
			";
		}elseif($num == 2){
			$sql = "
				SELECT * FROM posts
				LEFT OUTER JOIN naes ON posts.id = naes.post_id
				WHERE naes.body LIKE :keyword ESCAPE '!'
				AND delete_flg IS NULL
				ORDER BY posts.id DESC
			";
		}elseif($num == 3){
			$sql = "
				SELECT * FROM posts
				LEFT OUTER JOIN tanes ON posts.id = tanes.post_id
				LEFT OUTER JOIN naes ON posts.id = naes.post_id
				WHERE (tanes.body LIKE :keyword ESCAPE '!'
								OR naes.body LIKE :keyword ESCAPE '!')
				AND delete_flg IS NULL
				ORDER BY posts.id DESC
			";
		}elseif($num == 4){
			$sql = "
				SELECT * FROM posts
				LEFT OUTER JOIN mis ON posts.id = mis.post_id
				WHERE mis.body LIKE :keyword ESCAPE '!'
				AND delete_flg IS NULL
				ORDER BY posts.id DESC
			";
		}elseif($num == 5){
			$sql = "
				SELECT * FROM posts
				LEFT OUTER JOIN tanes ON posts.id = tanes.post_id
				LEFT OUTER JOIN mis ON posts.id = mis.post_id
				WHERE (tanes.body LIKE :keyword ESCAPE '!'
								OR mis.body LIKE :keyword ESCAPE '!')
				AND delete_flg IS NULL
				ORDER BY posts.id DESC
			";
		}elseif($num == 6){
			$sql = "
				SELECT * FROM posts
				LEFT OUTER JOIN naes ON posts.id = naes.post_id
				LEFT OUTER JOIN mis ON posts.id = mis.post_id
				WHERE (naes.body LIKE :keyword ESCAPE '!'
								OR mis.body LIKE :keyword ESCAPE '!')
				AND delete_flg IS NULL
				ORDER BY posts.id DESC
			";
		}else{
			$sql = "
				SELECT * FROM posts
				LEFT OUTER JOIN tanes ON posts.id = tanes.post_id
				LEFT OUTER JOIN naes ON posts.id = naes.post_id
				LEFT OUTER JOIN mis ON posts.id = mis.post_id
				WHERE (tanes.body LIKE :keyword ESCAPE '!'
								OR naes.body LIKE :keyword ESCAPE '!'
								OR mis.body LIKE :keyword ESCAPE '!')
				AND delete_flg IS NULL
				ORDER BY posts.id DESC
			";
		}
// クエリ実行
		$stmt = $pdo->prepare($sql);
//エスケープバインド
		$stmt->bindValue(':keyword', '%' . preg_replace('/(?=[!_%])/', '!', $keyword) . '%', PDO::PARAM_STR);

		if(!$stmt->execute()){
			$err_msg['common'] = MSG07;
			return false;
		}
		if($stmt){
			return $stmt->fetchAll();
		}else{
			return false;
		}
	}catch(Exception $e){
	}
}


/* タネ */

function getTane($user_id){
//そのユーザーが投稿したタネを検索


	try{
		$pdo = dbConnect();
		$sql = 'SELECT * FROM tanes WHERE user_id = :user_id ORDER BY post_time DESC';
		$data = array(':user_id' => $user_id);

// クエリ実行
		$stmt = queryPost($pdo, $sql, $data);

		if($stmt){
			return $stmt->fetchAll();
		}else{
			return false;
		}
	}catch(Exception $e){
//error_log('エラー発生：'.$e->getMessage());
	}
}

function getOneTane($post_id){
//特定のタネを取得
	try{
		$pdo = dbConnect();
		$sql = 'SELECT * FROM tanes WHERE post_id = :post_id';
		$data = array(':post_id' => $post_id);
		$stmt = queryPost($pdo, $sql, $data);

		if($stmt){
			return $stmt->fetch(PDO::FETCH_ASSOC);

		}else{
			return false;
		}
	}catch(Exception $e){
	}
}

function getOneTaneByTaneId($tane_id){
	try{
		$pdo = dbConnect();
		$sql = 'SELECT * FROM tanes WHERE tane_id = :tane_id';
		$data = array(':tane_id' => $tane_id);
		$stmt = queryPost($pdo, $sql, $data);

		if($stmt){
			return $stmt->fetch(PDO::FETCH_ASSOC);

		}else{
			return false;
		}
	}catch(Exception $e){
	}
}

/* ナエ */

function getNae($user_id){
//そのユーザーが投稿したナエを検索
	try{
		$pdo = dbConnect();
		$sql = 'SELECT * FROM naes WHERE user_id = :user_id ORDER BY post_time DESC';
		$data = array(':user_id' => $user_id);

// クエリ実行
		$stmt = queryPost($pdo, $sql, $data);

		if($stmt){
			return $stmt->fetchAll();
		}else{
			return false;
		}
	}catch(Exception $e){
//error_log('エラー発生：'.$e->getMessage());
	}
}

function getNaeIncome($nae_id){
	try{
		$pdo = dbConnect();
		$sql = 'SELECT * FROM nae_incomes WHERE nae_id = :nae_id';
		$data = array(':nae_id' => $nae_id);

// クエリ実行
		$stmt = queryPost($pdo, $sql, $data);

		if($stmt){
			return $stmt->fetchAll();
		}else{
			return false;
		}
	}catch(Exception $e){
//error_log('エラー発生：'.$e->getMessage());
	}
}
function getNaeCost($nae_id){
	try{
		$pdo = dbConnect();
		$sql = 'SELECT * FROM nae_costs WHERE nae_id = :nae_id';
		$data = array(':nae_id' => $nae_id);

// クエリ実行
		$stmt = queryPost($pdo, $sql, $data);

		if($stmt){
			return $stmt->fetchAll();
		}else{
			return false;
		}
	}catch(Exception $e){
//error_log('エラー発生：'.$e->getMessage());
	}
}
function getNaeImg($nae_id){
	try{
		$pdo = dbConnect();
		$sql = 'SELECT * FROM nae_imgs WHERE nae_id = :nae_id';
		$data = array(':nae_id' => $nae_id);

// クエリ実行
		$stmt = queryPost($pdo, $sql, $data);

		if($stmt){
			return $stmt->fetchAll();
		}else{
			return false;
		}
	}catch(Exception $e){
//error_log('エラー発生：'.$e->getMessage());
	}
}

function getOneNae($post_id){
//特定のナエを取得

//debug('全ての投稿情報を取得します。');
	try{
		$pdo = dbConnect();
		$sql = 'SELECT * FROM naes WHERE post_id = :post_id';
		$data = array(':post_id' => $post_id);
//debug('SQL:'.$sql);

// クエリ実行
		$stmt = queryPost($pdo, $sql, $data);
/*
		if($stmt){
			$result = $stmt->fetch(PDO::FETCH_ASSOC);
			$income = getNaeIncome($result['nae_id']);
			$cost = getNaeCost($result['nae_id']);
			$img = getNaeImg($result['nae_id']);
			$post = array_merge($result, $income, $cost, $img);
		}
*/
			if($stmt){
			// クエリ結果のデータを全レコード返す
				return $stmt->fetch(PDO::FETCH_ASSOC);

			}else{
				return false;
			}
	}catch(Exception $e){
	//error_log('エラー発生：'. $e->getMessage());
	}

}

function getOneNaeByNaeId($nae_id){
	try{
		$pdo = dbConnect();
		$sql = 'SELECT * FROM naes WHERE nae_id = :nae_id';
		$data = array(':nae_id' => $nae_id);
		$stmt = queryPost($pdo, $sql, $data);

		if($stmt){
			return $stmt->fetch(PDO::FETCH_ASSOC);

		}else{
			return false;
		}
	}catch(Exception $e){
	}
}


/* ミ */

function getMi($user_id){
//そのユーザーが投稿したナエを検索
	try{
		$pdo = dbConnect();
		$sql = 'SELECT * FROM mis WHERE user_id = :user_id ORDER BY post_time DESC';
		$data = array(':user_id' => $user_id);

// クエリ実行
		$stmt = queryPost($pdo, $sql, $data);

		if($stmt){
			return $stmt->fetchAll();
		}else{
			return false;
		}
	}catch(Exception $e){
//error_log('エラー発生：'.$e->getMessage());
	}
}

function getMiIncome($mi_id){
	try{
		$pdo = dbConnect();
		$sql = 'SELECT * FROM mi_incomes WHERE mi_id = :mi_id';
		$data = array(':mi_id' => $mi_id);

// クエリ実行
		$stmt = queryPost($pdo, $sql, $data);

		if($stmt){
			return $stmt->fetchAll();
		}else{
			return false;
		}
	}catch(Exception $e){
//error_log('エラー発生：'.$e->getMessage());
	}
}
function getMiCost($mi_id){
	try{
		$pdo = dbConnect();
		$sql = 'SELECT * FROM mi_costs WHERE mi_id = :mi_id';
		$data = array(':mi_id' => $mi_id);

// クエリ実行
		$stmt = queryPost($pdo, $sql, $data);

		if($stmt){
			return $stmt->fetchAll();
		}else{
			return false;
		}
	}catch(Exception $e){
//error_log('エラー発生：'.$e->getMessage());
	}
}
function getMiImg($mi_id){
	try{
		$pdo = dbConnect();
		$sql = 'SELECT * FROM mi_imgs WHERE mi_id = :mi_id';
		$data = array(':mi_id' => $mi_id);

// クエリ実行
		$stmt = queryPost($pdo, $sql, $data);

		if($stmt){
			return $stmt->fetchAll();
		}else{
			return false;
		}
	}catch(Exception $e){
//error_log('エラー発生：'.$e->getMessage());
	}
}

function getOneMi($post_id){
//特定のナエを取得

//debug('全ての投稿情報を取得します。');
	try{
		$pdo = dbConnect();
		$sql = 'SELECT * FROM mis WHERE post_id = :post_id';
		$data = array(':post_id' => $post_id);
//debug('SQL:'.$sql);

// クエリ実行
		$stmt = queryPost($pdo, $sql, $data);
/*
		if($stmt){
			$result = $stmt->fetch(PDO::FETCH_ASSOC);
			$income = getMiIncome($result['mi_id']);
			$cost = getMiCost($result['mi_id']);
			$img = getMiImg($result['mi_id']);
			$post = array_merge($result, $income, $cost, $img);
		}
*/
			if($stmt){
			// クエリ結果のデータを全レコード返す
				return $stmt->fetch(PDO::FETCH_ASSOC);

			}else{
				return false;
			}
	}catch(Exception $e){
	//error_log('エラー発生：'. $e->getMessage());
	}

}

function getOneMiByMiId($mi_id){
	try{
		$pdo = dbConnect();
		$sql = 'SELECT * FROM mis WHERE mi_id = :mi_id';
		$data = array(':mi_id' => $mi_id);
		$stmt = queryPost($pdo, $sql, $data);

		if($stmt){
			return $stmt->fetch(PDO::FETCH_ASSOC);

		}else{
			return false;
		}
	}catch(Exception $e){
	}
}


// 画像処理
function uploadIcon($file, $key){
//debug('画像アップロード処理開始');
//debug('FILE情報：'.print_r($file,true));

	if(isset($file['error']) && is_int($file['error'])){
		try{
			switch($file['error']){
				case UPLOAD_ERR_OK: //OK
				break;
				case UPLOAD_ERR_NO_FILE: //ファイル未選択の場合
				throw new RuntimeException('ファイルが選択されていません');
				case UPLOAD_ERR_INI_SIZE: //php.ini定義の最大サイズが超過した場合
				case UPLOAD_ERR_FORM_SIZE: //フォーム定義の最大サイズが超過した場合
				throw new RuntimeException('ファイルサイズが大きすぎます');
				default:
				throw new RuntimeException('その他のエラーが発生しました');
			}
			// upload画像が指定した拡張子と合っているか
			$type =@exif_imagetype($file['tmp_name']);
			if(!in_array($type, [IMAGETYPE_GIF, IMAGETYPE_JPEG, IMAGETYPE_PNG], true)){
				throw new RuntimeException('画像形式が未対応です');
			}
			//ファイル名をハッシュ化しパスを生成
			$path = sha1_file($file['tmp_name']).image_type_to_extension($type);
			if(!move_uploaded_file($file['tmp_name'], storage_path('app/public/img/prof/').$path)){
				throw new RuntimeException('ファイル保存時にエラーが発生しました');
			}
			//保存したファイルパスのパーミッションを変更する
			chmod(storage_path('app/public/img/prof/').$path,0644);

			//debug('ファイルは正常にアップロードされました');
			//debug('ファイルパス：'.$path);
			return $path;
		}catch(RuntimeException $e){
		//debug($e->getMessage());
			global $err_msg;
			$err_msg[$key] = $e->getMessage();
		}
	}
}

// 画像処理
function uploadImgConfirm($file, $key){
//debug('画像アップロード処理開始');
//debug('FILE情報：'.print_r($file,true));

	if(isset($file['error']) && is_int($file['error'])){
		try{
			switch($file['error']){
				case UPLOAD_ERR_OK: //OK
				break;
				case UPLOAD_ERR_NO_FILE: //ファイル未選択の場合
				throw new RuntimeException('ファイルが選択されていません');
				case UPLOAD_ERR_INI_SIZE: //php.ini定義の最大サイズが超過した場合
				case UPLOAD_ERR_FORM_SIZE: //フォーム定義の最大サイズが超過した場合
				throw new RuntimeException('ファイルサイズが大きすぎます');
				default:
				throw new RuntimeException('その他のエラーが発生しました');
			}
			// upload画像が指定した拡張子と合っているか
			$type =@exif_imagetype($file['tmp_name']);
			if(!in_array($type, [IMAGETYPE_GIF, IMAGETYPE_JPEG, IMAGETYPE_PNG], true)){
				throw new RuntimeException('画像形式が未対応です');
			}
			//ファイル名をハッシュ化しパスを生成
			$path = sha1_file($file['tmp_name']).image_type_to_extension($type);
			if(!move_uploaded_file($file['tmp_name'], storage_path('app/public/media/confirm/').$path)){
				throw new RuntimeException('ファイル保存時にエラーが発生しました');
			}
			//保存したファイルパスのパーミッションを変更する
			chmod(storage_path('app/public/media/confirm/').$path,0644);

			//debug('ファイルは正常にアップロードされました');
			//debug('ファイルパス：'.$path);
			return $path;
		}catch(RuntimeException $e){
		//debug($e->getMessage());
			global $err_msg;
			$err_msg[$key] = $e->getMessage();
		}
	}
}

// 画像処理
function uploadImg($file, $key){
//debug('画像アップロード処理開始');
//debug('FILE情報：'.print_r($file,true));

	if(isset($file['error']) && is_int($file['error'])){
		try{
			switch($file['error']){
				case UPLOAD_ERR_OK: //OK
				break;
				case UPLOAD_ERR_NO_FILE: //ファイル未選択の場合
				throw new RuntimeException('ファイルが選択されていません');
				case UPLOAD_ERR_INI_SIZE: //php.ini定義の最大サイズが超過した場合
				case UPLOAD_ERR_FORM_SIZE: //フォーム定義の最大サイズが超過した場合
				throw new RuntimeException('ファイルサイズが大きすぎます');
				default:
				throw new RuntimeException('その他のエラーが発生しました');
			}
			// upload画像が指定した拡張子と合っているか
			$type =@exif_imagetype($file['tmp_name']);
			if(!in_array($type, [IMAGETYPE_GIF, IMAGETYPE_JPEG, IMAGETYPE_PNG], true)){
				throw new RuntimeException('画像形式が未対応です');
			}
			//ファイル名をハッシュ化しパスを生成
			$path = 'img/uploads/'.sha1_file($file['tmp_name']).image_type_to_extension($type);

			if(!move_uploaded_file($file['tmp_name'], $path)){
				throw new RuntimeException('ファイル保存時にエラーが発生しました');
			}
			//保存したファイルパスのパーミッションを変更する
			chmod($path,0644);

			//debug('ファイルは正常にアップロードされました');
			//debug('ファイルパス：'.$path);
			return $path;
		}catch(RuntimeException $e){
		//debug($e->getMessage());
			global $err_msg;
			$err_msg[$key] = $e->getMessage();
		}
	}
}

/* 表示時エスケープ */

function showImg($file){
	if(empty($file)){
		return 'img/account.jpeg';
	}else{
		return 'storage/media/uploads/'.$file;
	}
}

function showProf($file){
	if(empty($file)){
		return 'img/account.jpeg';
	}else{
		return 'storage/img/prof/'.$file;
	}
}

function nullEscape($data){
	if(empty($data)){
		return "未設定";
	}else{
		return $data;
	}
}


//画像アセットパス
function showImgAsset($file){
	if(empty($file)){
		return public_path('img/'). $file;
	}else{
		return "img/". $file;
	}
}

//post_typeを数値に変換
function postTypeCount($type){
/*post_type[
	[0] => "tane",
	[1] => "nae",
	[2] => "mi"
]
のような形式を想定
*/
	$num = 0;

	if(in_array("tane", $type)){$num = $num + 1;}
	if(in_array("nae", $type)){$num = $num + 2;}
	if(in_array("mi", $type)){$num = $num + 4;}

	return $num;
}


//便利系

//htmlエスケープ
function h($string){
	return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}

//数値チェック
function noCheck($no, $miss = 1){
	if(preg_match('/^[1-9][0-9]*$/', $no)){
		return (int)$no;
	}else{
		return $miss;
	}
}

//メール送信
function mailSubmit($to, $from, $title, $body){
	mb_language("Japanese");
	mb_internal_encoding("UTF-8");

	if(mb_send_mail($to, $title, $body, "From: ".$from)){
		return true;
	} else {
		return false;
	}
}

function console_log($data){
	echo '<script>';
	echo 'console.log('. json_encode( $data ) .')';
	echo '</script>';
}

?>