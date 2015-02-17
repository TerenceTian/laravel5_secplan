<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class OrdersFormRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
        if ( $this->method == 'PATCH' || $this->method == 'GET' || $this->method == 'DELETE') {
            return $this->route('orders')->buyer_id == Auth::id();
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
                //'name'  => 'required|min:2|max:100',
                //'intro' => 'required|min:3|max:100'
            ];
        }

        return [];
	}

}
