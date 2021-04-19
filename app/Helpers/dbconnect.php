<?php

function dbConnect(){
	$dsn = 'mysql:dbname=o-rchards;host=localhost;charset=utf8';
	$user = 'staff';
	$password = 'password';
	$options = array(
		PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_EMULATE_PREPARES => false,

		/*

		// SQL実行失敗時にはエラーコードのみ設定
		PDO::ATTR_ERRMODE => PDO::ERRMODE_SILENT,
		// デフォルトフェッチモードを連想配列形式に設定
		PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
		// バッファードクエリを使う(一度に結果セットをすべて取得し、サーバー負荷を軽減)
		// SELECTで得た結果に対してもrowCountメソッドを使えるようにする
		PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => true,

		*/

	);
	// PDOオブジェクト生成（DBへ接続）
	$pdo = new PDO($dsn, $user, $password, $options);
	return $pdo;
}

?>