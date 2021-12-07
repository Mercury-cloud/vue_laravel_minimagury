<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;


class StorePostRequest extends FormRequest
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
                'name' => 'required',
                'email' => 'required|email',
                //パスに{user}があればパスワード不要
                'password' => ($this->user) ? '' : 'required'  
            ]; 
    }

    public function attributes()
    {
            return [
                'name' => '名前',
                'email' => 'メールアドレス',
                'password' => 'パスワード'
            ];
    }
        
}
//新規登録のルート名ならば
//if ($this->route()->named('manage.user.add.post')) {}