<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Nae;
use App\NaeIncome;
use App\NaeCost;
use App\NaeImg;
use App\Tag;

class PostNae extends FormRequest
{
	/**
	* The key to be used for the view error bag.
	*
	* @var string
	*/
	protected $errorBag = "nae";

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
		return array_merge(Nae::$rules, NaeIncome::$rules, NaeCost::$rules, Tag::$rules,);
	}

	/**
	 * 定義済みバリデーションルールのエラーメッセージ取得
	 *
	 * @return array
	 */
	public function messages()
	{
		return array_merge(Nae::$messages, NaeIncome::$messages, NaeCost::$messages, Tag::$messages,);
	}

	protected function getRedirectUrl()
	{
		return route('form/nae');
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
