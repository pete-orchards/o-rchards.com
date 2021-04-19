<?php

namespace App\Http\Controllers\Ajax;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FormImgUploadController extends Controller
{
    public function __invoke(File $file){
    	/**
		 * ファイルを受信する
		 *
		 * @author M.Katsube <katsubemakito@gmail.com>
		 */

		//-------------------------------------------------
		// 定数
		//-------------------------------------------------
		// $_FILESのキー
		define('KEY', 'avatar');

		// 最大ファイルサイズ
		define('MAX_SIZE', (30 * 1024) );

		// 画像を保存するディレクトリ
		define('SAVE_DIR', 'img/uploads');

		// エラーメッセージ
		// https://www.php.net/manual/ja/features.file-upload.errors.php
		define('ERROR_MSG', [
		  UPLOAD_ERR_INI_SIZE   => 'Over file size (php.ini -> upload_max_filesize)',
		  UPLOAD_ERR_FORM_SIZE  => 'Over file size (HTML -> MAX_FILE_SIZE)',
		  UPLOAD_ERR_PARTIAL    => 'Not Complete',    // 一部しかアップロードされてない
		  UPLOAD_ERR_NO_FILE    => 'Not Ipload',      // アップロードされていない
		  UPLOAD_ERR_NO_TMP_DIR => 'InternalServerError(1)',  // 一時ディレクトリが存在しない
		  UPLOAD_ERR_CANT_WRITE => 'InternalServerError(2)',  // 書き込みエラー
		  UPLOAD_ERR_EXTENSION  => 'InternalServerError(3)'   // モジュールによる停止
		]);

		//-------------------------------------------------
		// Validation
		//-------------------------------------------------
		// ファイルが渡されているか
		if( ! isset($_FILES[KEY]) ){
		  sendResult(false, 'Empty file data');
		  exit(1);
		}
		// 何らかのエラーが発生しているか
		if( (isset($_FILES[KEY]['error'])) && ($_FILES[KEY]['error'] !== UPLOAD_ERR_OK) ){
		  sendResult(false, 'Exception ' . ERROR_MSG[$_FILES[KEY]['error']]);
		  exit(1);
		}
		// アップロードされたファイルを指しているか (not /etc/passwd...)
		if( ! is_uploaded_file( $_FILES[KEY]['tmp_name'] ) ){
		  sendResult(false, 'Internal Server Error');
		  exit(1);
		}
		// ファイルサイズが30k未満か
		if( $_FILES[KEY]['size'] > MAX_SIZE ){
		  sendResult(false, 'Too large file');
		  exit(1);
		}
		// MIME TYPEが画像形式か(JPEG,PNG,GIF)
		$mime = getMimeType( $_FILES[KEY]['tmp_name']);  // 画像形式を取得
		if( getMimeType( $_FILES[KEY]['tmp_name']) === null ){
		  sendResult(false, 'Not Allow file type');
		  exit(1);
		}

		//-------------------------------------------------
		// サーバへ保存
		//-------------------------------------------------
		// ファイル名を作成
		$filename = sprintf('%s.%s', makeFileName(), $mime);

		// 一時ディレクトリから移動
		$result = move_uploaded_file(
		  $_FILES[KEY]['tmp_name'],
		  sprintf('%s/%s', SAVE_DIR, $filename)
		);

		//-------------------------------------------------
		// 結果を返却
		//-------------------------------------------------
		if( $result !== false ){
		  sendResult(true, $filename);
		}
		else{
		  // 書き込みエラー
		  sendResult(false, 'InternalServerError(4)');
		}

		/**
		 * 結果をJSON形式で返却
		 *
		 * @param  boolean $status 成功:true, 失敗:false
		 * @param  mixed   $data   ブラウザに返却するデータ
		 * @return void
		 */
		function sendResult($status, $data){
		  // CORS (必要に応じて指定)
		  header('Access-Control-Allow-Origin: *');
		  header('Access-Control-Allow-Headers: *');

		  header('Content-type: application/json');
		  echo json_encode([
		    "status" => $status,
		    "result" => $data
		  ]);
		}

		/**
		 * 画像のファイル形式を返却する
		 *
		 * @param string $path 対象ファイルのパス
		 * @return mixed
		 */
		function getMimeType($path){
		  list($width, $height, $mime, $attr) = getimagesize($path);
		  switch($mime){
		    case IMAGETYPE_JPEG:
		      return('jpeg');
		    case IMAGETYPE_PNG:
		      return('png');
		    case IMAGETYPE_GIF:
		      return('gif');
		    default:
		      return(null);
		  }
		}

		/**
		 * ファイル名を生成する
		 *
		 * @return string
		 */
		function makeFileName(){
		  return( sha1(uniqid()) );  // 実際にはもう少し複雑にした方が安全
		}
    }
}
