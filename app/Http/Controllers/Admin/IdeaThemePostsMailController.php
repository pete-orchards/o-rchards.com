<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\IdeaTheme;
use App\IdeaThemePost;
use App\Mail\Admin\IdeaThemePost as IdeaThemePostMail;
use Illuminate\Support\Facades\Mail;

class IdeaThemePostsMailController extends Controller
{
	public function create(IdeaTheme $idea_theme, $idea_theme_post_id)
	{
		$idea_theme_post = IdeaThemePost::find($idea_theme_post_id);
		$post = $idea_theme_post->post;

//		$render = (new IdeaThemePostMail($idea_theme_post))->render();
		$param = [
			'idea_theme' => $idea_theme,
			'idea_theme_post' => $idea_theme_post,
			'idea_theme_post_id' => $idea_theme_post_id,
			'post' => $post,
//			'render' => $render,
		];
		return view('admin.idea_theme_posts.mail.create', $param);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request, IdeaTheme $idea_theme, $idea_theme_post_id)
	{
		$text = $request->input('text');
		$idea_theme_post = IdeaThemePost::find($idea_theme_post_id);
		$mail = $idea_theme_post->post->user->email;
		//5時間後
		$when = now();
		$message = (new IdeaThemePostMail($idea_theme_post, $text))
		->onQUeue('emails');
		//メールを遅延ディスパッチ
		Mail::to($mail)->later($when, $message);

		return redirect()->route('admin.idea_theme.posts.mail.create', ['idea_theme' => $idea_theme->id, 'post' => $idea_theme_post_id,]);
	}}
