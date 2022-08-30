<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'name'=> 'required',
            'price'=> 'required',
            'moTaNgan'=> 'required',
            'moTaSP'=> 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required'=> 'Không Được Để Trống Tên Sản Phẩm !',
            'price.required'=> 'Không Được Để Trống Giá Sản Phẩm !',
            'moTaNgan.required'=> 'Không Được Để Trống Mô Tả Ngắn !',
            'moTaSP.required'=> 'Không Được Để Trống Mô Tả Sản Phẩm !',
        ];
    }
}
