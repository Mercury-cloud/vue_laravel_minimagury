<?php

namespace App\Http\Requests\API\V1\Scene;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class ConditionEditRequest extends FormRequest
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
            'name' => 'required|string|unique:scene_conditions',
            'scene_id' => 'required|numeric',
            'type' => ['required', Rule::in(['numeric', 'timer'])],
            'sensor_id' => 'numeric',
            'sensor_detail_id' => 'numeric',
            'aggregation_type' => Rule::in(['single', 'double', 'triple']),
            'threshold' => 'numeric',
            'wind_direction' => Rule::in(['above', 'below']),
            'start_time' => 'string',
            'end_time' => 'string',
            'monday' => 'boolean',
            'tuesday' => 'boolean',
            'wednesday' => 'boolean',
            'thursday' => 'boolean',
            'friday' => 'boolean',
            'saturday' => 'boolean',
            'sunday' => 'boolean',
        ];
    }


    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json( ["errors" => '不正なリクエストです', 'validations' => $validator->errors()], 422 )
        );
    }
}
