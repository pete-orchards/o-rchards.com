<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MiConfirmController extends Controller
{
	public function mi_confirm(Request $request){
		require resource_path().'/views/auth.php';
			$pdo = dbConnect();

		if(!empty($_SESSION['user_id'])){
			$user = getUser($_SESSION['user_id']);
		}

	//画像ファイルの移動
		if(!empty($_FILES['img']['name'][0])){
			foreach ($_FILES['img']['name'] as $key => $value)
			{
				$file[$key] = [
					"name" => $_FILES['img']['name'][$key],
					"type" => $_FILES['img']['type'][$key],
					"tmp_name" => $_FILES['img']['tmp_name'][$key],
					"error" => $_FILES['img']['error'][$key],
					"size" => $_FILES['img']['size'][$key],
				];
				$img[] = (!empty($file[$key]['name'])) ? uploadImgConfirm($file[$key], 'img') : '';
			}
		}

		$income_name = filter_input(INPUT_POST,"income_name",FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
		
		$income_amount = filter_input(INPUT_POST,"income_amount",FILTER_VALIDATE_INT, FILTER_REQUIRE_ARRAY);
		$income_volume = filter_input(INPUT_POST,"income_volume",FILTER_VALIDATE_INT, FILTER_REQUIRE_ARRAY);
		$cost_name = filter_input(INPUT_POST,"cost_name",FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
		$cost_amount = filter_input(INPUT_POST,"cost_amount",FILTER_VALIDATE_INT, FILTER_REQUIRE_ARRAY);
		$cost_volume = filter_input(INPUT_POST,"cost_volume",FILTER_VALIDATE_INT, FILTER_REQUIRE_ARRAY);

		$total_income = (int)"";
		$total_cost = (int)"";
		foreach ($income_amount as $key => $value) {
			
			$income_subtotal[] = $income_amount[$key] * $income_volume[$key];
			$total_income = $total_income + $income_subtotal[$key];
		}
		foreach ($cost_amount as $key => $value) {
			
			$cost_subtotal[] = $cost_amount[$key] * $cost_volume[$key];
			$total_cost = $total_cost + $cost_subtotal[$key];
		}
		$total = $total_income - $total_cost;

		$pagetitle = "Orchards - ミの確認";
		//htmlヘッダ
		require __dir__.'/header.php';
	}

}
