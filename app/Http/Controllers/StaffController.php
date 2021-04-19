<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StaffController extends Controller
{
	public function index($id = ''){
		$member = ['junota', 'mika', 'pete', 'osushi'];
		if(!empty($id)){
			if(!in_array($id, $member)){
				return redirect()->route('staff');
			}
		}
		$param = [
			'id' => $id,
		];

		if(!empty($id)){
			if($id == 'osushi'){
				$name = "おすし";
			}elseif($id == 'junota'){
				$name = "太田潤";
			}elseif($id == 'mika'){
				$name = "ミカ";
			}elseif($id == 'pete'){
				$name = "ピート";
			}
			$param['name'] = $name;
		}
		return view('staff', $param);
	}
}
