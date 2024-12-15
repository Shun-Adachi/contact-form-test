<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
                'first_name' => ['required', 'string', 'max:255'],
                'last_name' => ['required', 'string', 'max:255'],
                'gender' => ['required', 'integer', 'min:-128', 'max:127'],
                'email' => ['required', 'email', 'string', 'max:255'],
                'tel_1' => ['required', 'digits_between:1,5'],
                'tel_2' => ['required', 'digits_between:1,5'],
                'tel_3' => ['required', 'digits_between:1,5'],
                'address' => ['required', 'string', 'max:255'],
                'building' => ['max:255'],
                'category_id' => ['required', 'integer'],
                'detail' => ['required', 'string', 'max:120'],
        ];
    }

    public function messages()
    {
        return [
            'category_id.required' => 'カテゴリを選択してください',
            'category_id.integer' => 'カテゴリを選択してください',
            'category_id.min' => 'カテゴリを選択してください',
            'category_id.max' => 'カテゴリを選択してください',

            'last_name.required' => '姓を入力してください',
            'last_name.string' => '姓を入力してください',
            'last_name.max' => '255文字以内で入力してください',

            'first_name.required' => '名を入力してください',
            'first_name.string' => '名を入力してください',
            'first_name.max' => '255文字以内で入力してください',

            'gender.required' => '性別を選択してください',
            'gender.integer' => '性別を選択してください',
            'gender.min' => '性別を選択してください',
            'gender.max' => '性別を選択してください',

            'email.required' => 'メールアドレスを入力してください',
            'email.email' => 'メールアドレスはメール形式で入力してください',
            'email.string' => 'メールアドレスを入力してください',
            'email.max' => '255文字以内で入力してください',

            'tel_1.required' => '電話番号を入力してください',
            'tel_1.digits_between' => '電話番号は5桁までの数字で入力してください',

            'tel_2.required' => '電話番号を入力してください',
            'tel_2.digits_between' => '電話番号は5桁までの数字で入力してください',

            'tel_3.required' => '電話番号を入力してください',
            'tel_3.digits_between' => '電話番号は5桁までの数字で入力してください',

            'address.required' => '住所を入力してください',
            'address.string' => '住所を入力してください',
            'address.max' => '255文字以内で入力してください',

            'building.max' => '255文字以内で入力してください',

            'category_id.required' => 'お問い合わせの種類を選択してください',
            'category_id.integer' => 'お問い合わせの種類を選択してください',

            'detail.required' => 'お問い合わせ内容を入力してください',
            'detail.string' => 'お問い合わせ内容を入力してください',
            'detail.max' => 'お問合せ内容は120文字以内で入力してください',
        ];
    }

}
