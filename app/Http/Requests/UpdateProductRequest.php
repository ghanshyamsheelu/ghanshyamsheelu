<?php

namespace App\Http\Requests;

use App\Product;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    public function authorize()
    {
        return \Gate::allows('product_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'required',
            ],
            'categories' =>[
                'required',
            ],
            'description' =>[
                'required',
            ],
            'photo' =>[
                'required',
                'mimes:jpeg,png,bmp',
                'max:500|dimensions:max_width=100,max_height=100',
            ],
        ];
    }
}
