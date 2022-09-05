<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class checkOutRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            //
            'user_name'=> 'required',
            'phone_number'=>'required',
            'address'=>'required'
        ];
    }

    public function messages()
    {
        return [
            'user_name.required'=> 'Không Được Để Trống Họ Và Tên !',
            'phone_number.required'=> 'Không Được Để Trống Số Điện Thoại !',
            'address.required'=> 'Không Được Để Trống Địa Chỉ Nhận Hàng !',
        ];
    }
}
