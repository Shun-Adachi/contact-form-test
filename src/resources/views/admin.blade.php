@php
  $show_header = 1;
  $header_button = "logout";
@endphp

@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}" />
@endsection

@section('content')
<div class="contact-form__content">
  <div class="section__title">
    <h2>Admin</h2>
  </div>
    <div class="admin-table">
      <table class="confirm-table__inner">
        <tr class="confirm-table__row">
          <th class="admin-table__header--name">お名前</th>
          <th class="admin-table__header--gender">性別</th>
          <th class="admin-table__header--email">メールアドレス</th>
          <th class="admin-table__header--category">お問い合わせの種類</th>
          <th class="admin-table__header--blank"></th>
        </tr>
        <tr class="admin-table__row">
          <td class="admin-table__content--name">山田　太郎</td>
          <td class="admin-table__content--gender">男性</td>
          <td class="admin-table__content--email">test@example.com</td>
          <td class="admin-table__content--category">商品の交換について</td>
          <td class="admin-table__content--button">
            <button id="openModalBtn" class="admin-table__button-submit">詳細</button>
          </td>
        </tr>
      </table>
    </div>
  <!-- モーダル -->
  <div id="myModal" class="modal">
    <div class="modal-content">
      <!-- 右上の閉じるボタン -->
      <button class="close-btn-top" id="closeModalTopBtn">&times;</button>
      <div class="modal-table">
        <table class="modal-table__inner">
          <tr class="modal-table__row">
            <th class="modal-table__header">お名前</th>
            <td class="modal-table__content">山田　太郎</td>
          </tr>
          <tr class="modal-table__row">
            <th class="modal-table__header">性別</th>
            <td class="modal-table__content">男性</td>
          </tr>
          <tr class="modal-table__row">
            <th class="modal-table__header">メールアドレス</th>
            <td class="modal-table__content">test@example.com</td>
          </tr>
          <tr class="modal-table__row">
            <th class="modal-table__header">電話番号</th>
            <td class="modal-table__content">08012345678</td>
          </tr>
          <tr class="modal-table__row">
            <th class="modal-table__header">住所</th>
            <td class="modal-table__content">東京都渋谷区千駄ヶ谷1-2-3</td>
          </tr>
          <tr class="modal-table__row">
            <th class="modal-table__header">建物名</th>
            <td class="modal-table__content">千駄ヶ谷マンション</td>
          </tr>
          <tr class="modal-table__row">
            <th class="modal-table__header">お問い合わせの種類</th>
            <td class="modal-table__content">商品の交換について</td>
          </tr>
          <tr class="modal-table__row">
            <th class="modal-table__header">お問い合わせ内容</th>
            <td class="modal-table__content">
              <textarea  id="autoResizeTextarea" class="text_area" readonly >
このテキストエリアは readonly 属性が設定されています。
ユーザーはこの内容を編集することができませんが、コピーすることは可能です。
ユーザーはこの内容を編集することができませんが、コピーすることは可能です。
              </textarea>
            </td>
          </tr>
        </table>
      </div>
      <button class="close-btn" id="closeModalBtn">削除</button>
    </div>
  </div>
    <script>
    // JavaScriptでモーダルの開閉を制御
    const openModalBtn = document.getElementById('openModalBtn');
    const closeModalBtn = document.getElementById('closeModalBtn');
    const closeModalTopBtn = document.getElementById('closeModalTopBtn');
    const modal = document.getElementById('myModal');

    // モーダルを表示する
    openModalBtn.addEventListener('click', () => {
      modal.style.display = 'flex';
    });

    // モーダルを閉じる
    closeModalBtn.addEventListener('click', () => {
      modal.style.display = 'none';
    });


    // モーダルを閉じる（右上ボタン）
    closeModalTopBtn.addEventListener('click', () => {
      modal.style.display = 'none';
    });

    // モーダルの外側をクリックした場合も閉じる
    window.addEventListener('click', (event) => {
      if (event.target === modal) {
        modal.style.display = 'none';
      }
    });

    const textarea = document.getElementById('autoResizeTextarea');

    // 高さを自動調整する関数
    function adjustHeight() {
    textarea.style.height = 'auto'; // 高さをリセット
    textarea.style.height = textarea.scrollHeight + '200px'; // 必要な高さを設定
              }
    // テキストエリアの初期化時と入力時に高さを調整
    textarea.addEventListener('input', adjustHeight);
    // 初期化時に高さを調整
    adjustHeight();
  </script>
</div>
@endsection