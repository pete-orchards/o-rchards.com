<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//ホーム画面
//ルートディレクトリへのアクセスはリダイレクト
Route::get('home', 'HomeController@index')->name('home');
Route::get('/', function(){
	return redirect()->route('home');
})->name('/');
Route::get('', function(){
	return redirect()->route('home');
});

//検索結果 クエリ文字列を使うためgetメソッド
Route::get('search', 'HomeController@search')->name('search');

//ユーザーページ
Route::get('user/{user_id?}', 'UserController@index')->name('user');
//ユーザー本人用ページ
Route::get('user/home/{user_id}/{view?}', 'UserHomeController@index')->name('user/home')
->middleware('verified');
//ユーザー情報変更 postメソッド
Route::post('user/home/{user_id}/edit', 'UserHomeController@save')
->middleware('verified');
Route::post('user/home/{user_id}/prof_img', 'UserHomeController@img')
->middleware('verified');

//タネ
Route::resource('tane', 'TaneController')
->only(['create', 'store', 'show']);

//ナエ
Route::resource('nae', 'NaeController')
->only(['create', 'store', 'show', 'edit', 'update']);

//ミ
Route::resource('mi', 'MiController')
->only(['create', 'store', 'show', 'edit', 'update']);

//通知
Route::get('notification', 'NotificationController@index')
->middleware('auth')
//通知の既読処理
->middleware('receive.notification')
->name('notification');

//Auth(認証、ユーザー登録機能)の設定　ログイン、レジスターなど
//vendor\laravel\framework\src\Illuminate\Routing\Rounter内で設定されている
Auth::routes([
	'verify' => true
]);
Route::get('register/detail', 'RegisterDetailController');

//フッター記載のページ
Route::get('news', 'NewsController@index')->name('news');
Route::get('terms', 'TermsController@index')->name('terms');
Route::get('privacy-policy', 'PrivacyPolicyController@index')->name('privacy-policy');
//スタッフページ、idがなければ4人のページ、あれば個別ページ
Route::get('staff/{id?}', 'StaffController@index')->name('staff');
//contact改修中...
Route::get('contact', 'ContactController@create')->name('contact');
Route::post('contact', 'ContactController@store');

//ヘルプ改修中...
Route::get('help/{item?}/{id?}', 'HelpController@index')->name('help');

//アイディア募集
Route::get('idea_theme/{id}', 'IdeaThemeController@show')->name('idea_theme');

//会員登録内でiframeタグで呼び出すための利用規約、プライバシーポリシー(もっとスマートなやり方にしたい)
Route::get('terms-body.php', function () {
return view("components.terms.body");
});
Route::get('privacy-policy-body.php', function () {
return view("components.privacy-policy.body");
});

//ajax
Route::namespace('Ajax')->group(function () {
	Route::post('ajax_form-img-upload', 'FormImgUploadController');
	Route::post('ajax_good', 'AjaxGoodController')->middleware('auth');
	Route::post('ajax_basket', 'AjaxBasketController')->middleware('auth');
	Route::post('ajax_delete', 'AjaxDeleteController');
	Route::get('ajax_auth', 'AjaxAuthController');
	Route::post('ajax_user_notification_config', 'AjaxUserNotificationConfigController');
	Route::post('ajax/get/nae', 'GetNaeController')->middleware('auth');
	Route::post('ajax/get/mi', 'GetMiController')->middleware('auth');
});


//管理者ページ、管理者権限が必要なグループ
Route::middleware(['auth','can:isAdmin'])
->prefix('admin')
->name('admin.')
->namespace('Admin')
->group(function(){
	Route::get('/', function(){
		return redirect()->route('admin.home');
	})->name('/');
	Route::get('home', 'HomeController@index')->name('home');
	Route::get('logs', 'AnalyticsController@logs')->name('logs');
	Route::get('log_search_words', 'AnalyticsController@log_search_words')->name('log_search_words');
	//リソースコントローラ
	//ニュースCRUD
	Route::resource('news', 'NewsController');
	//テーマ企画CRUD
	Route::resource('idea_theme', 'IdeaThemeController');
	//テーマ企画結果CRUD
	Route::resource('idea_theme_result', 'IdeaThemeResultController')
	->except(['index']);
	//テーマ企画表彰された投稿のCRUD
	Route::resource('idea_theme.posts', 'IdeaThemePostsController')
	->only(['index', 'store', 'update', 'destroy']);
	//受賞者へのメール作成・送信
	Route::resource('idea_theme.posts.mail', 'IdeaThemePostsMailController')
	->only(['create', 'store']);
});

//mailableテスト
Route::middleware(['auth','can:isAdmin'])
->group(function(){
	Route::get('mailable/good', function () {
		$good = App\Good::where('deleted_at', NULL)->first();
		$user = $good->post->user;
		return new App\Mail\NotificationGood($user, $good);
	});
	Route::get('mailable/basket', function () {
		$user_basket = App\UserBasket::where('deleted_at', NULL)->first();
		$user = $user_basket->post->user;
		return new App\Mail\NotificationBasket($user, $user_basket);
	});
	Route::get('mailable/reference', function () {
		$reference = App\PostReference::where('path_length', '<>', 0)->first();
		$user = $reference->descendant_post->user;
		return new App\Mail\NotificationReference($user, $reference);
	});
	Route::get('mailable/contact', function () {
		$contact = App\Contact::first();
		return new App\Mail\ContactReceived($contact);
	});
	Route::get('mailable/idea_theme_post/auto', function () {
		$idea_theme_post = App\IdeaThemePost::first();
		return new App\Mail\IdeaThemePost($idea_theme_post);
	});
	Route::get('mailable/admin/idea_theme_post', function () {
		$idea_theme_post = App\IdeaThemePost::first();
		$text = 'はすみさん 

こんにちは。
オーチャーズ運営です。 

先日はオーチャーズのテーマ企画「春から○○はじめます！」へのご応募ありがとうございました。 

選考の結果、あなたの投稿が「猫の皿賞」に選ばれました。おめでとうございます。 

つきましては、賞品として猫の皿からスプーンを1本贈らせて頂きますので、お名前とご住所をお教え頂ければと存じます。 

また、新しい企画テーマの募集も開始しましたので、そちらへも奮ってご応募ください、
よろしくお願い致します。



オーチャーズ運営
https://o-rchards.com



◼️木工ユニット猫の皿
2020年より岐阜県恵那市で木工作家として活動を始めた二人組です。製作依頼は随時受け付けておりますので、お気軽にお声がけ下さい。https://neconosara.thebase.in/';
	$test2 = 'きらくやさん 

こんにちは。
オーチャーズ運営です。 

先日はオーチャーズのテーマ企画「春から○○はじめます！」へのご応募ありがとうございました。 

選考の結果、あなたの投稿が「いいね賞タネ部門」に選ばれました。おめでとうございます。 

先日、新しい企画テーマの募集も開始しましたので、そちらへも奮ってご応募ください、
よろしくお願い致します。


オーチャーズ運営
https://o-rchards.com';
		return new App\Mail\Admin\IdeaThemePost($idea_theme_post, $text);
	});
});