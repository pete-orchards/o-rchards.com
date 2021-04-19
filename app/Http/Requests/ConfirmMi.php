<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Mi;
use App\MiIncome;
use App\MiCost;
use App\MiImg;
use App\Tag;

class ConfirmMi extends FormRequest
{
	/**
	* The key to be used for the view error bag.
	*
	* @var string
	*/
	protected $errorBag = "mi";

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return array_merge(Mi::$rules, MiIncome::$rules, MiCost::$rules, MiImg::$rules, Tag::$rules,);
	}

	public function messages()
	{
		return array_merge(Mi::$messages, MiIncome::$messages, MiCost::$messages, MiImg::$messages, Tag::$messages,);
	}

	protected function prepareForValidation()
	{
		if($this->filled('tag')){
			$this->merge([
				'tags' => explode(",", $this->input('tag')),
			]);
		}
	}

	/**
	 * バリデータインスタンスの設定
	 *
	 * @param  \Illuminate\Validation\Validator  $validator
	 * @return void
	 */
	public function withValidator($validator)
	{
		$validator->after(function ($validator) {
			//タグのエラーメッセージはここで設定(上記だと配列でネストされてしまうため)
			if (!$this->has('tags')) {
				return false;
			}
			foreach($this->tags as $tag){
				if(mb_strlen($tag) > 100){
					$validator->errors()->add('tag', 'タグが100文字を超えています');
					break;
				}
			}
		});
	}
}
