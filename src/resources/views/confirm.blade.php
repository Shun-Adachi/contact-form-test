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
  <form class="form" action="/confirm/create" method="post">
    @csrf
    <div class="confirm-table">
      <table class="confirm-table__inner">
        <tr class="confirm-table__row">
          <th class="confirm-table__header">お名前</th>
          <td class="confirm-table__text">
            <input type="text"
                   name="name"
                   value="{{$contact['name']}}"
                   readonly />
          </td>
        </tr>
        <tr class="confirm-table__row">
          <th class="confirm-table__header">性別</th>
          <td class="confirm-table__text">
            <input type="text"
                   name="gender_item"
                   value="{{$contact['gender_item']}}"
                   readonly />
          </td>
        </tr>
        <tr class="confirm-table__row">
          <th class="confirm-table__header">メールアドレス</th>
          <td class="confirm-table__text">
            <input type="email"
                   name="email"
                   value="{{$contact['email']}}"
                   readonly />
          </td>
        </tr>
        <tr class="confirm-table__row">
          <th class="confirm-table__header">電話番号</th>
          <td class="confirm-table__text">
            <input type="tel"
                   name="tel"
                   value="{{$contact['tel']}}"
                   readonly />
          </td>
        </tr>
        <tr class="confirm-table__row">
          <th class="confirm-table__header">住所</th>
          <td class="confirm-table__text">
            <input type="text"
                   name="address"
                   value="{{$contact['address']}}"
                   readonly />
          </td>
        </tr>
        <tr class="confirm-table__row">
          <th class="confirm-table__header">建物名</th>
          <td class="confirm-table__text">
            <input type="text"
                   name="building"
                  value="{{$contact['building']}}"
                  readonly />
          </td>
        </tr>
        <tr class="confirm-table__row">
          <th class="confirm-table__header">お問い合わせの種類</th>
          <td class="confirm-table__text">
            <input type="text"
                   name="category_content"
                   value="{{$contact['category_content']}}"
                   readonly />
          </td>
        </tr>
        <tr class="confirm-table__row" >
          <th class="confirm-table__header">お問い合わせ内容</th>
          <td class="confirm-table__text" >
            <textarea id="autoResizeTextarea"
                      class="text_area"
                      name='detail'
                      readonly >{{$contact['detail']}}</textarea>
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
    <div class="confirm-form__button">
      <input type="hidden" name="last_name" value="{{$contact['last_name']}}"/>
      <input type="hidden" name="first_name" value="{{$contact['first_name']}}"/>
      <input type="hidden" name="gender" value="{{$contact['gender']}}"/>
      <input type="hidden" name="tel_1" value="{{$contact['tel_1']}}"/>
      <input type="hidden" name="tel_2" value="{{$contact['tel_2']}}"/>
      <input type="hidden" name="tel_3" value="{{$contact['tel_3']}}"/>
      <input type="hidden" name="category_id" value="{{$contact['category_id']}}"/>
      <button class="confirm-form__button-submit"
              name="action"
              value="submit"
              type="submit">送信</button>
      <button class="confirm-form__button--cancel"
              name="action"
              value="cancel"
              type="submit">修正</button>
    </div>
  </form>
</div>
@endsection