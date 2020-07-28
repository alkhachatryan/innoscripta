<?php

namespace App\Http\Requests\Products;

use App\Product;
use App\Rules\InTableColumnsRule;
use Illuminate\Foundation\Http\FormRequest;

class GetProductsRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'limit' => ['sometimes', 'numeric', 'min:1', 'max:500'],
            'filter' => ['sometimes', 'in:asc,desc'],
            'sort_by' => ['sometimes', new InTableColumnsRule(with(new Product())->getTable())]
        ];
    }
}
