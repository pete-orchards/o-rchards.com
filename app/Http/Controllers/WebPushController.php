<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;

class WebPushController extends Controller
{
    public function __construct() {

        $this->middleware('auth');  // 要ログイン

    }

    public function create() {

        return view('webpush');

    }

    public function store(Request $request) {

        $user = Auth::user();
        $endpoint = $request->endpoint;
        $key = $request->key;
        $token = $request->token;
        $user->updatePushSubscription($endpoint, $key, $token);

        return ['result' => true];
    }
}