<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TheaterFormRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'photo_filename' => 'sometimes|image|mimes:png,jpg|max:4096', // maxsize = 4Mb
            'rows' => 'required|integer|min:1|max:26',
            'cols' => 'required|integer|min:1',
        ];
    }

    public function authorize()
    {
        return true;
    }
}
