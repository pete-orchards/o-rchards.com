<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\User;
use App\UserDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class EditUser extends FormRequest
{
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
		return [
		'name' => 'bail|required|max:15',
		'user_id' => [
			'bail',
			'required',
			'max:30',
			Rule::unique('App\User')
				->ignore(Auth::id())
				->where(function($query){
				return $query->where('deleted_at', NULL);
				}),
		],
		'prof_comment' => 'max:255',
		'prof_img' => 'bail|image|max:10000000',
		'location' => 'bail|max:50',
		'url' => 'bail|nullable|max:255|url',
		];
	}
	protected function prepareForValidation()
	{
		if($this->prof_comment == NULL){
			unset($this->prof_comment);
		}
		if($this->url == NULL){
			unset($this->url);
		}
		if($this->location == NULL){
			unset($this->location);
		}
		unset($this->_token);
	}
}
