<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use App\Models\Category;
use Symfony\Component\HttpFoundation\StreamedResponse;

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
        //名前取得
        $last_name =  $request->input(['last_name']);
        $first_name =  $request->input(['first_name']);
        $name =  $last_name . '　' . $first_name;

        $gender = $request->input(['gender']);
        $gender_item = $this->getGenderItem($gender);

        //電話番号結合
        $tel_1 = $request->input(['tel_1']);
        $tel_2 = $request->input(['tel_2']);
        $tel_3 = $request->input(['tel_3']);
        $tel = $tel_1 . $tel_2 . $tel_3;

        //カテゴリ名取得
        $category_id = $request->input(['category_id']);
        $category = Category::where('id', $request->input(['category_id']))->first();

        //パラメータ
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
        // Contactを取得し、カテゴリ情報を付加
        $contacts = Contact::with('category')->paginate(7);
        $categories = Category::all();
        return view('admin',compact('contacts','categories'));
    }

    // 削除処理
    public function destroy(Request $request)
    {
        Contact::find($request->id)->delete();
        return redirect('/admin')->with('message', '問い合わせを削除しました');
    }

    // 検索処理
    public function search(Request $request)
    {
        //性別：全てを選択した場合の処理
        $gender_key = $this->getGenderKey($request->gender);

        $contacts = contact::with('category')
            ->CategorySearch($request->category_id)
            ->GenderSearch($gender_key)
            ->KeywordSearch($request->keyword)
            ->DateSearch($request->date)
            ->paginate(7);

        $categories = Category::all();

        $search_params = [
            'keyword' => $request->keyword,
            'gender' => $request->gender,
            'category_id' => $request->category_id,
            'date' => $request->date,
        ];
        return view('admin', compact('contacts', 'categories', 'search_params'));
    }

    // CSVエクスポート処理
    public function export(Request $request)
    {

        //性別：全てを選択した場合の処理
        $gender_key = $this->getGenderKey($request->gender);

        //CSV エクスポート
        $contacts = contact::with('category')
            ->CategorySearch($request->category_id)
            ->GenderSearch($gender_key)
            ->KeywordSearch($request->keyword)
            ->DateSearch($request->date)
            ->get();

        $this->exportCsv($contacts);

        //検索処理
        $contacts = contact::with('category')
            ->CategorySearch($request->category_id)
            ->GenderSearch($gender_key)
            ->KeywordSearch($request->keyword)
            ->DateSearch($request->date)
            ->paginate(7);

        $categories = Category::all();

        $search_params = [
            'keyword' => $request->keyword,
            'gender' => $request->gender,
            'category_id' => $request->category_id,
            'date' => $request->date,
        ];
        return view('admin', compact('contacts', 'categories', 'search_params'));
    }

    // CSVエクスポート処理
    protected function exportCsv($contacts)
    {
        $response = new StreamedResponse(function () use ($contacts) {
            $handle = fopen('php://output', 'w');

            // CSVヘッダー
            fputcsv($handle, ['ID', '姓', '名', '性別', 'メールアドレス', '電話番号', '住所', '建物名', 'お問い合わせの種類', 'お問い合わせ内容']);

            // データをCSVに追加
            foreach ($contacts as $row) {
               $gender_item = $this->getGenderItem($row->gender);

                fputcsv($handle, [
                    $row->id,
                    $row->last_name,
                    $row->first_name,
                    $gender_item,
                    $row->email,
                    $row->tel,
                    $row->address,
                    $row->building,
                    $row->category->content,
                    $row->detail,
                ]);
            }

            fclose($handle);
        });

        // レスポンスヘッダーを設定
        $response->headers->set('Content-Type', 'text/csv; charset=UTF-8');
        $response->headers->set('Content-Disposition', 'attachment; filename="search_results.csv"');

        // 出力と同時に終了（これ以降の処理は続行されない）
        $response->send();
    }

    // 性別取得
    protected function getGenderItem($gender)
    {
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
        return($gender_item);
    }

    // 性別取得
    protected function getGenderKey($gender)
    {
        if ($gender === "all"){
            $gender_key = NULL;
        }else{
            $gender_key = $gender;
        }
        return($gender_key);
    }
}
