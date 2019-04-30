<?php

namespace ongoingcloud\laravelcrud\Http\Requests\Languagetranslet;

use Illuminate\Foundation\Http\FormRequest;
use ongoingcloud\laravelcrud\General\HandlePermission;

class OnlyLanguagetransletRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {        
        return HandlePermission::authorize('only_languagetranslet');
    }

    /**
     * Get the validation rules that ongoingcloud\laravelcrudly to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
       
            ];
    }
}