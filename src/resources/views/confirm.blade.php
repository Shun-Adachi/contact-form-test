@php
  $show_header = 1;
  $header_button = "";
@endphp

@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/confirm.css') }}" />
@endsection

@section('content')
<div class="contact-form__content">
  <div class="section__title">
    <h2>Confirm</h2>
  </div>
  <form class="form" action="/thanks" method="post">
    @csrf
    <div class="confirm-table">
      <table class="confirm-table__inner">
        <tr class="confirm-table__row">
          <th class="confirm-table__header">お名前</th>
          <td class="confirm-table__text">
            <input type="text" name="name" value="山田　太郎" readonly />
          </td>
        </tr>
        <tr class="confirm-table__row">
          <th class="confirm-table__header">性別</th>
          <td class="confirm-table__text">
            <input type="text" name="gender" value="男性" readonly />
          </td>
        </tr>
        <tr class="confirm-table__row">
          <th class="confirm-table__header">メールアドレス</th>
          <td class="confirm-table__text">
            <input type="email" name="email" value="test@example.com" readonly />
          </td>
        </tr>
        <tr class="confirm-table__row">
          <th class="confirm-table__header">電話番号</th>
          <td class="confirm-table__text">
            <input type="tel" name="tel" value="08012345678" readonly />
          </td>
        </tr>
        <tr class="confirm-table__row">
          <th class="confirm-table__header">住所</th>
          <td class="confirm-table__text">
            <input type="text" name="address" value="東京都渋谷区千駄ヶ谷1-2-3" readonly />
          </td>
        </tr>
        <tr class="confirm-table__row">
          <th class="confirm-table__header">建物名</th>
          <td class="confirm-table__text">
            <input type="text" name="building" value="千駄ヶ谷マンション101" readonly />
          </td>
        </tr>
        <tr class="confirm-table__row">
          <th class="confirm-table__header">お問い合わせの種類</th>
          <td class="confirm-table__text">
            <input type="text" name="category" value="商品の交換について" readonly />
          </td>
        </tr>
        <tr class="confirm-table__row" >
          <th class="confirm-table__header">お問い合わせ内容</th>
          <td class="confirm-table__text" >

             <textarea  id="autoResizeTextarea" class="text_area" readonly >
このテキストエリアは readonly 属性が設定されています。
ユーザーはこの内容を編集することができませんが、コピーすることは可能です。
ユーザーはこの内容を編集することができませんが、コピーすることは可能です。
            </textarea>
            <script>
              const textarea = document.getElementById('autoResizeTextarea');

              // 高さを自動調整する関数
              function adjustHeight() {
                textarea.style.height = 'auto'; // 高さをリセット
                textarea.style.height = textarea.scrollHeight + 'px'; // 必要な高さを設定
              }

              // テキストエリアの初期化時と入力時に高さを調整
              textarea.addEventListener('input', adjustHeight);

              // 初期化時に高さを調整
              adjustHeight();
            </script>
          </td>
        </tr>
      </table>
    </div>
    <div class="form__button">
      <button class="form__button-submit" type="submit" formaction="/thanks">送信</button>
      <button class="form__button--cancel" type="/index" formaction="/index">修正</button>
    </div>
  </form>
</div>
@endsection