<?php
/**
 * Created by PhpStorm.
 * User: rafael.delacruz
 * Date: 2/20/18
 * Time: 10:27 AM
 */

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidateRequest extends FormRequest  {

    public function authorize(){
        return true;
    }

    public function rules(){
        return  [
            'task_name' => 'required|max:255',
            'description' => 'required'
        ];
    }
} 