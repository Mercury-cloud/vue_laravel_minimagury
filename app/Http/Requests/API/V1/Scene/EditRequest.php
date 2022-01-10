<?php

namespace App\Http\Requests\API\V1\Scene;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class EditRequest extends FormRequest
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
            'name' => 'required|string|unique:scenes',
            'device_id' => 'required|numeric',
            'detail' => 'string',
            'power' => 'boolean',
            'temperature' => 'numeric',
            'mode' => Rule::in(['cooling', 'heating', 'dehumidifier', 'auto', 'ventilation']),
            'air_flow' => Rule::in(['low', 'mid', 'high', 'auto', 'power']),
            'wind_direction' => Rule::in( ['vertical', 'horizontal', 'auto'])
        ];
    }


    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json( ["errors" => '不正なリクエストです', 'validations' => $validator->errors()], 422 )
        );
    }
}
