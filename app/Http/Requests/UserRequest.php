<?php

namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\User;



class UserRequest extends FormRequest
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
    public function rules(User $user)
    {
       
        return [
            'lastName' => 'required|max:50|alpha',
            'firstName' => 'required|max:50|alpha',
            'middleName' => 'required|max:50|alpha',
            'email' => 'required|email',
                    Rule::unique('users')->ignore($user->id),
            'phone' => 'required|min:5|max:25|regex:[(\s*)?(\+)?([- _():=+]?\d[- _():=+]?){10,14}(\s*)?]',
            'password' => 'required|min:6|max:50|regex:/\w/',
            'passwordUntil' => 'date',
            'counter_id' => 'required|integer|exists:counters,id',
        ];
    }

    public function messages()
    {
        return [
            'required' => 'Поле обязательно для заполнения',
            'integer' => 'Поле содержит целое число',
            'email.unique' => 'Пользователь с таким именем уже существует',
            'email.max' => 'Не более 50 символов',
            'counter_id.exists' => 'Нет доступа к таблице Контрагентов',
            'password.min' => 'Не менее 6 символов',
            'alpha' => 'Допускаются только буквы',
            'phone.regex' => 'Поле содержит цифры 0-9, символы: +()-',
            'password.regex' => 'Пароль состоит из букв и цифр',
        ];
    }
}
