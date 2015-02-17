<?php namespace App\Http\Requests;

use App\Http\Requests\Request;
use Auth;

class ItemsFormRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
        if ( $this->method == 'PATCH' || $this->method == 'GET' || $this->method == 'DELETE') {
            return $this->route('items')->shop->user_id == Auth::id();
        }

		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
        if ($this->method == 'POST' || $this->method == 'PATCH') {
            return [
                'name'  => 'required|min:2|max:32',
                'intro' => 'required|min:3|max:100',
                //'amount' => 'required',
                //'geo_id' => 'required',
                //'original_price' => 'required',
                //'shop_id' => 'required',
                //'original_price' => 'required',
                //'post_price' => 'required',
                //'phone_number' => 'required'

            ];
        }

        return [];
	}

}
