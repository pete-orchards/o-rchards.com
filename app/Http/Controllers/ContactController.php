<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreContact;
use App\Contact;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactReceived;
use Log;

class ContactController extends Controller
{
	public function create(){
		return view('contact');
	}

	public function store(StoreContact $request){
		$contact = new Contact([
			'name' => $request->input('name'),
			'email' => $request->input('email'),
			'message' => $request->input('message'),
		]);
		$contact->save();

		Mail::to($request->input('email'))->send(new ContactReceived($contact));
		Log::info('
			お問合せがありました。内容を確認して対応してください。
			お名前: '.$contact->name.'様,
			メールアドレス: 管理者ページより確認
			内容: '.$contact->message.','
		);
		return redirect()->route('contact')->with('result', 'received');

	}
}
