<?php


namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;


class WeatherGetRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'city' => ['required_without_all:lat,lon', 'string', 'max:255'],
            'lat' =>  ['required_without:city', 'string'],
            'lon' =>  ['required_without:city', 'string'],
        ];
    }

    /**
     * Get the error messages that apply to the request parameters.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'city.required'         => 'City field is required',
            'city.string'          => 'City is not a valid string',
            'city.max:255'          => 'City can not be more than 255 character',           
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json(['success' => false, 'errors' => $validator->errors()], 422));
    }
}
