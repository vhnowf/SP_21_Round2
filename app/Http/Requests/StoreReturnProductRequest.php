<?php

namespace App\Http\Requests;

use App\Models\ReturnProduct;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreReturnProductRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('returnproduct_create');
    }

    public function rules()
    {
        return [
            'product_quantity'    => [
                'required',
                'integer',
            ],
            'name'               => [
                'string',
                'required',
            ],
            'email'               => [
                'string',
                'required',
            ],
            'phone'               => [
                'string',
                'required',
            ],
            'order_id'               => [
                'string',
                'required',
            ],
            'product_name'               => [
                'string',
                'required',
            ],
            'product_code'               => [
                'string',
                'required',
            ],
            'reason'               => [
                'string',
                'required',
            ],
           
        ];
    }
}
