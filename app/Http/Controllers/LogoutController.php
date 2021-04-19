<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LogoutController extends Controller
{
    public function index(){
		$_SESSION['user_id'] = array();
		session_destroy();
		return redirect('/');
    }
}
