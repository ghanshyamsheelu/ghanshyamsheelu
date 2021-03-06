<?php

namespace App\Http\Requests;

use App\Product;
use Illuminate\Foundation\Http\FormRequest;

class StoreAppointmentRequest extends FormRequest
{
    public function authorize()
    {
        return \Gate::allows('product_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'required',
            ],
            'date' =>[

            ],
            'time' =>[

            ],
            'comment' =>[

            ],
        ];
    }
}
