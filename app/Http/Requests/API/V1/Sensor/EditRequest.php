<?php

namespace App\Http\Requests\API\V1\Sensor;

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
            'name' => 'required|string|unique:sensors',
            'type' => 'required|string',
            'user_id' => 'numeric',
            'field_id' => 'numeric',
            'description' => 'string',
            'aggregation_type' => Rule::in(['single', 'double', 'triple']),
            'is_alert' => 'boolean',
            'alert_text' => 'string',
            'alert_text3' => 'string',
            'latest_value_text' => 'string',
            'latest_value' => 'string',
            'latest_value2_text' => 'string',
            'latest_value2' => 'string',
            'latest_value3_text' => 'string',
            'latest_value3' => 'string',
        ];
    }


    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json( ["errors" => '不正なリクエストです', 'validations' => $validator->errors()], 422 )
        );
    }
}
