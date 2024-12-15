@php
  $show_header = 1;
  $header_button = "logout";
@endphp

@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}" />
@endsection

@section('content')
@if (session('message'))
<div class="alert__message--success">
  {{session('message')}}
</div>
@endif
<div class="search-form__content">
  <!-- タイトル -->
  <div class="section__title">
    <h2>Admin</h2>
  </div>
  <!-- 検索フォーム -->
  <form class="search-form" action="/admin/search">
    @csrf
    <div class="search-form__item">
      <input class="search-form__input-text"
             type="text"
             placeholder="名前やメールアドレスをいれてください"
             name="keyword"
             value="{{$search_params['keyword'] ?? ''}}" />
      <select name="gender" class="search-form__select--gender">
        <option value="" >性別</option>
        <option value="all" {{($search_params['gender'] ?? '') == "all" ? 'selected' : '' }}>全て</option>
        <option value="1" {{($search_params['gender'] ?? '') == 1 ? 'selected' : '' }}>男性</option>
        <option value="2" {{($search_params['gender'] ?? '') == 2 ? 'selected' : '' }}>女性</option>
        <option value="3" {{($search_params['gender'] ?? '') == 3 ? 'selected' : '' }}>その他</option>
      </select>
      <select class="search-form__select--category" name="category_id">
        <option value="">お問い合わせの種類</option>
        @foreach ($categories as $category)
        <option value="{{ $category->id }}"
                {{($search_params['category_id'] ?? '') == $category->id ? 'selected' : '' }}>
          {{ $category->content }}
        </option>
        @endforeach
      </select>
      <input type="date"
             name ="date"
             class="search-form__input-date"
             value="{{$search_params['date'] ?? ''}}">
      <div class="search-form__button">
        <button class="search-form__button-submit"
                type="submit"
                formaction="/admin/search">検索
        </button>
      </div>
      <div class="search-form__button">
         <a href="/admin" class="search-form__button-reset">リセット</a>
      </div>
    </div>
    <div class="table-controls">
      <div class="export__button">
        <button type="submit"
                class="export__button-submit"
                formaction="/admin/export">エクスポート</button>
      </div>
      <div class="pagination-outline">
        {{ $contacts->links('pagination::bootstrap-4') }}
      </div>
    </div>
  </form>
  <!-- テーブルコンテンツ -->
  <div class="admin-table">
    <table class="admin-table__inner">
      <tbody>
      <tr class="admin-table__row">
        <th class="admin-table__header--name">お名前</th>
        <th class="admin-table__header--gender">性別</th>
        <th class="admin-table__header--email">メールアドレス</th>
        <th class="admin-table__header--category">お問い合わせの種類</th>
        <th class="admin-table__header--blank"></th>
      </tr>
      @foreach ($contacts as $contact)
      <tr class="admin-table__row">
        @php $name = $contact['last_name']. ' '.$contact['first_name'] @endphp
        <td class="admin-table__content--name">{{$name}}</td>
        @if($contact['gender'] === 1)
          @php $gender_item = "男性" @endphp
        @elseif($contact['gender'] === 2)
          @php $gender_item = "女性" @endphp
        @elseif($contact['gender'] === 3)
          @php $gender_item = "その他" @endphp
        @else
          @php $gender_item = "男性" @endphp
        @endif
        <td class="admin-table__content--gender">{{$gender_item}}</td>
        <td class="admin-table__content--email">{{$contact['email']}}</td>
        <td class="admin-table__content--category">{{$contact->category->content}}</td>
        <td class="admin-table__button">
          <button id="openModalBtn-{{ $loop->index }}"
                  class="admin-table__button-submit"
                  data-id="{{ $contact->id }}"
                  data-name="{{ $name }}"
                  data-gender="{{ $gender_item }}"
                  data-tel="{{ $contact->tel }}"
                  data-address="{{ $contact->address }}"
                  data-building="{{ $contact->building }}"
                  data-category="{{$contact->category->content}}"
                  data-detail="{{ $contact->detail }}" >
                  詳細</button>
        </td>
      </tr>
      @endforeach
    </tbody>
    </table>
  </div>
  <!-- モーダル -->
  <div id="myModal" class="modal">
    <div class="modal-content">
      <button class="close-btn-top" id="closeModalTopBtn">&times;</button>
      <div class="modal-table">
        <table class="modal-table__inner">
          <tr class="modal-table__row">
            <th class="modal-table__header">お名前</th>
            <td class="modal-table__content" id="modal-name"></td>
          </tr>
          <tr class="modal-table__row">
            <th class="modal-table__header">性別</th>
            <td class="modal-table__content" id="modal-gender"></td>
          </tr>
          <tr class="modal-table__row">
            <th class="modal-table__header"></th>
            <td class="modal-table__content" id="modal-email"></td>
          </tr>
          <tr class="modal-table__row">
            <th class="modal-table__header">電話番号</th>
            <td class="modal-table__content" id="modal-tel"></td>
          </tr>
          <tr class="modal-table__row">
            <th class="modal-table__header">住所</th>
            <td class="modal-table__content" id="modal-address"></td>
          </tr>
          <tr class="modal-table__row">
            <th class="modal-table__header">建物名</th>
            <td class="modal-table__content" id="modal-building"></td>
          </tr>
          <tr class="modal-table__row">
            <th class="modal-table__header">お問い合わせの種類</th>
            <td class="modal-table__content" id="modal-category"></td>
          </tr>
          <tr class="modal-table__row">
            <th class="modal-table__header">お問い合わせ内容</th>
            <td class="modal-table__content">
              <textarea  id="modal-detail" class="text_area" readonly >
                </textarea>
              </td>
            </tr>
        </table>
      </div>
      <form class="remove-form"  action="/admin/delete" method="post">
        @csrf
        @method('DELETE')
        <input type="hidden" id="modal-id" name="id" value=""/>
        <button class="remove-btn" id="removeBtn"  type="submit">削除</button>
      </form>
    </div>
  </div>
  <!-- モーダルスクリプト -->
  <script>
    // JavaScriptでモーダルの開閉を制御
    const buttons = document.querySelectorAll('.admin-table__button-submit');
    const removeBtn = document.getElementById('removeBtn');
    const closeModalTopBtn = document.getElementById('closeModalTopBtn');
    const modal = document.getElementById('myModal');

    // 各ボタンにクリックイベントを設定
    buttons.forEach(button => {
      button.addEventListener('click', function () {
        // ボタンのdata-*属性から値を取得
        const id = this.getAttribute('data-id');
        const name = this.getAttribute('data-name');
        const gender = this.getAttribute('data-gender');
        const email = this.getAttribute('data-email');
        const tel = this.getAttribute('data-tel');
        const address = this.getAttribute('data-address');
        const category = this.getAttribute('data-category');
        const detail = this.getAttribute('data-detail');
        // モーダルの要素に値をセット
        document.getElementById('modal-id').value = id;
        document.getElementById('modal-name').textContent = name;
        document.getElementById('modal-gender').textContent = gender;
        document.getElementById('modal-email').textContent = email;
        document.getElementById('modal-tel').textContent = tel;
        document.getElementById('modal-address').textContent = address;
        document.getElementById('modal-category').textContent = category;
        document.getElementById('modal-detail').textContent = detail;
        // モーダルを表示
        document.getElementById('myModal').style.display = 'flex';
      });
    });

    // モーダルを閉じる
    removeBtn.addEventListener('click', () => {
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
  </script>
</div>
@endsection