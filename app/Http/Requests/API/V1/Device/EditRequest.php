<?php

namespace App\Http\Requests\API\V1\Device;

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
            'name' => 'required|string|unique:devices',
            'type' => ['required', Rule::in(['switch', 'air_conditioner'])],
            'user_id' => 'required|numeric',
            'field_id' => 'required|numeric',
            'icon' => 'string',
            'description' => 'string',
            'timer' => 'boolean',
            'temperature' => 'numeric',
            'mode' => Rule::in(['cooling', 'heating', 'dehumidifier', 'auto', 'ventilation']),
            'air_flow' => Rule::in(['low', 'mid', 'high', 'auto', 'power']),
            'wind_direction' => Rule::in(['vertical', 'horizontal', 'auto']),
            'status' => Rule::in(['ON', 'OFF']),
            'schedule' => 'string',
            'upper_limit' => 'numeric',
            'upper_limit_inequality_sign' => 'string',
            'upper_limit_alert_text' => 'string',
            'lower_limit' => 'numeric',
            'lower_limit_inequality_sign' => 'string',
            'lower_limit_alert_text' => 'string',
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
