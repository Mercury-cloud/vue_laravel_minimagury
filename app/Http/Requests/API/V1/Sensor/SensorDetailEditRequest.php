<?php

namespace App\Http\Requests\API\V1\Sensor;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class SensorDetailEditRequest extends FormRequest
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
            'sensor_id' => 'required|numeric',
            'type' => 'required|string',
            'name' => 'required|string',
            'precision' => 'required|numeric',
            'precision_type' => Rule::in(['float', 'int']),
            'unit' => 'required|string',
            'description' => 'string',
            'measuring_range_lower_limit' => 'numeric',
            'measuring_range_upper_limit' => 'numeric',
            'lower_limit' => 'numeric',
            'lower_limit_inequality_sign' => 'string',
            'lower_limit_alert_text' => 'string',
            'upper_limit' => 'numeric',
            'upper_limit_inequality_sign' => 'string',
            'upper_limit_alert_text' => 'string',
            'is_alert' => 'boolean',
            'alert_text' => 'string',
        ];
    }


    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json( ["errors" => '不正なリクエストです', 'validations' => $validator->errors()], 422 )
        );
    }
}
