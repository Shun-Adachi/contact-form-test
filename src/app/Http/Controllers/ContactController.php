<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use App\Models\Category;

class ContactController extends Controller
{
    // インデックスページ表示
    public function index(Request $request)
    {
        $contact = $request->session()->get('contact');
        session()->forget('contact');
        if (!isset($contact)) {
            $contact = [
                'name' => '',
                'gender' => '',
                'email' => '',
                'tel_1' => '',
                'tel_2' => '',
                'tel_3' => '',
                'address' => '',
                'building' => '',
                'category_id' => '',
                'detail' => '',
            ];
        }
        $categories = Category::all();
        return view('index',compact('contact', 'categories'));
    }

    // 確認ページ表示
    public function confirm(ContactRequest $request)
    {
        $last_name =  $request->input(['last_name']);
        $first_name =  $request->input(['first_name']);
        $name =  $last_name . '　' . $first_name;

        $gender = $request->input(['gender']);
        switch($gender){
            case 1:
                $gender_item = '男性';
                break;
            case 2:
                $gender_item = '女性';
                break;
            case 3:
                $gender_item = 'その他';
                break;
            default:
                $gender_item = '男性';
                break;
        }

        $tel_1 = $request->input(['tel_1']);
        $tel_2 = $request->input(['tel_2']);
        $tel_3 = $request->input(['tel_3']);
        $tel = $tel_1 . $tel_2 . $tel_3;

        $category_id = $request->input(['category_id']);
        $category = Category::where('id', $request->input(['category_id']))->first();

        $contact = [
            'name' => $name,
            'last_name'=> $last_name,
            'first_name'=> $first_name,
            'gender' => $gender,
            'gender_item' => $gender_item,
            'email' => $request->input(['email']),
            'tel' => $tel,
            'tel_1' => $tel_1,
            'tel_2' => $tel_2,
            'tel_3' => $tel_3,
            'address' => $request->input(['address']),
            'building' => $request->input(['building']),
            'category_id' => $category->id,
            'category_content' => $category->content,
            'detail' => $request->input(['detail']),
        ];

        return view('/confirm',compact('contact'));
    }

    // 問い合わせ情報保存処理
    public function store(Request $request)
    {
        $action = $request->input('action');

        //保存
        if ($action === 'submit'){
            $contact = [
                'category_id' => $request->input(['category_id']),
                'last_name' => $request->input(['last_name']),
                'first_name' => $request->input(['first_name']),
                'gender' => $request->input(['gender']),
                'email' => $request->input(['email']),
                'tel' => $request->input(['tel']),
                'address' => $request->input(['address']),
                'building' => $request->input(['building']),
                'detail' => $request->input(['detail']),
            ];
            Contact::create($contact);
            return redirect('/thanks');
        }
        //キャンセル
        elseif ($action === 'cancel') {
            $contact = [
                'last_name' => $request->input(['last_name']),
                'first_name' => $request->input(['first_name']),
                'gender' => $request->input(['gender']),
                'email' => $request->input(['email']),
                'tel_1' => $request->input(['tel_1']),
                'tel_2' => $request->input(['tel_2']),
                'tel_3' => $request->input(['tel_3']),
                'address' => $request->input(['address']),
                'building' => $request->input(['building']),
                'category_id' => $request->input(['category_id']),
                'detail' => $request->input(['detail']),
            ];
            $request->session()->put('contact', $contact);
            return redirect('/');
        }

        //不明な操作
        return back()->withErrors(['action' => '無効な操作です']);
    }

    // thanksページ表示
    public function thanks()
    {
        return view('thanks');
    }

    // adminページ表示
    public function admin()
    {
        return view('admin');
    }

}
