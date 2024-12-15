@php
  $show_header = 1;
  $header_button = "";
@endphp

@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}" />
@endsection

@section('content')
<div class="contact-form__content">
  <div class="section__title">
    <h2>Contact</h2>
  </div>
  <form class="contact-form" action="/confirm" method="post">
    @csrf
    <!-- お名前 -->
    <div class="contact-form__group">
      <div class="contact-form__group-title">
        <span class="contact-form__label--item">お名前</span>
        <span class="contact-form__label--required">※</span>
      </div>
      <div class="contact-form__group-content">
        <div class="contact-form__input--text-lastname">
          <input type="text"
                 name="last_name"
                 placeholder="例: 山田"
                 value="{{old('last_name', $contact['last_name'] ?? '')}}"/>
          <div class="form__error">
            @error('last_name')
            {{ $message }}
            @enderror
          </div>
        </div>
        <div class="contact-form__input--text-firstname">
          <input type="text"
                 name="first_name"
                 placeholder="例: 太郎"
                 value="{{old('first_name', $contact['first_name'] ?? '')}}"/>
          <div class="form__error">
            @error('first_name')
            {{ $message }}
            @enderror
          </div>
        </div>
      </div>
    </div>
    <!-- 性別 -->
    <div class="contact-form__group">
      <div class="contact-form__group-title">
        <span class="contact-form__label--item">性別</span>
        <span class="contact-form__label--required">※</span>
      </div>
      <div class="contact-form__group-content">
        <div class="contact-form__input--radio">
          <label class="contact-form__label--item">
            <input type="radio"
                   name="gender"
                   value="1"
                   {{ old('gender', $contact['gender'] ?? '') == '1' ? 'checked' : '' }}> 男性
          </label>
        <div class="form__error">
          @error('gender')
          {{ $message }}
          @enderror
        </div>
        </div>
        <div class="contact-form__input--radio">
          <label class="contact-form__label--item">
            <input type="radio"
                   name="gender"
                   value="2"
                   {{ old('gender', $contact['gender'] ?? '') == '2' ? 'checked' : '' }}> 女性
          </label>
        </div>
        <div class="contact-form__input--radio">
          <label class="contact-form__label--item">
            <input type="radio"
                   name="gender"
                   value="3"
                   {{ old('gender', $contact['gender'] ?? '') == '3' ? 'checked' : '' }}> その他
          </label>
        </div>

      </div>
    </div>
    <!-- メールアドレス -->
    <div class="contact-form__group">
      <div class="contact-form__group-title">
        <span class="contact-form__label--item">メールアドレス</span>
        <span class="contact-form__label--required">※</span>
      </div>
      <div class="contact-form__group-content">
        <div class="contact-form__input--text">
          <input type="text"
                 name="email"
                 placeholder="例: test@example.com"
                 value="{{old('email', $contact['email'] ?? '')}}"/>
          <div class="form__error">
            @error('email')
            {{ $message }}
            @enderror
          </div>
        </div>
      </div>
    </div>
    <!-- 電話番号 -->
    <div class="contact-form__group">
      <div class="contact-form__group-title">
        <span class="contact-form__label--item">電話番号</span>
        <span class="contact-form__label--required">※</span>
      </div>
      <div class="contact-form__group-content">
        <div class="contact-form__input--text-tel">
          <input type="text"
                 name="tel_1"
                 placeholder="080"
                 value="{{old('tel_1', $contact['tel_1'] ?? '')}}"/>
          <div class="form__error">
            @if($errors->has('tel_1'))
            {{$errors->first('tel_1')}}
            @elseif($errors->has('tel_2'))
            {{$errors->first('tel_2')}}
            @elseif($errors->has('tel_3'))
            {{$errors->first('tel_3')}}
            @endif
          </div>
        </div>
        <div class="contact-form__tel-dash">
          <span class="contact-form__label--item">-</span>
        </div>
        <div class="contact-form__input--text-tel">
          <input type="text"
                 name="tel_2"
                 placeholder="1234"
                 value="{{old('tel_2', $contact['tel_2'] ?? '')}}"/>
        </div>
        <div class="contact-form__tel-dash">
          <span class="form__label--item">-</span>
        </div>
        <div class="contact-form__input--text-tel">
          <input type="text"
                 name="tel_3"
                 placeholder="5678"
                 value="{{old('tel_3', $contact['tel_3'] ?? '')}}"/>
        </div>
      </div>
    </div>
    <!-- 住所 -->
    <div class="contact-form__group">
      <div class="contact-form__group-title">
        <span class="contact-form__label--item">住所</span>
        <span class="contact-form__label--required">※</span>
      </div>
      <div class="contact-form__group-content">
        <div class="contact-form__input--text">
          <input type="text"
                 name="address"
                 placeholder="例: 東京都渋谷区千駄ヶ谷1-2-3"
                 value="{{old('address', $contact['address'] ?? '')}}"/>
          <div class="form__error">
            @error('address')
            {{ $message }}
            @enderror
          </div>
        </div>
      </div>
    </div>
    <!-- 建物名 -->
    <div class="contact-form__group">
      <div class="contact-form__group-title">
        <span class="contact-form__label--item">建物名</span>
      </div>
      <div class="contact-form__group-content">
        <div class="contact-form__input--text">
          <input type="text"
                 name="building"
                 placeholder="例: 千駄ヶ谷マンション101"
                 value="{{old('building', $contact['building'] ?? '')}}"/>
        </div>
      </div>
    </div>
    <!-- お問い合わせの種類 -->
    <div class="contact-form__group">
      <div class="contact-form__group-title">
        <span class="contact-form__label--item">お問い合わせの種類</span>
        <span class="contact-form__label--required">※</span>
      </div>
      <div class="contact-form__group-content">
        <div class="contact-form__select">
          <select name="category_id">
            <option value="">選択してください</option>
            @foreach ($categories as $category)
            <option value="{{ $category->id }}"
                    {{ old('category_id', $contact['category_id'] ?? '') == $category->id ? 'selected' : '' }}>
            {{ $category->content }}
            </option>
            @endforeach
          </select>
          <div class="form__error">
            @error('category_id')
            {{ $message }}
            @enderror
          </div>
        </div>
      </div>
    </div>
    <!-- お問い合わせ内容 -->
    <div class="contact-form__group">
      <div class="contact-form__group-title">
        <span class="contact-form__label--item">お問い合わせ内容</span>
        <span class="contact-form__label--required">※</span>
      </div>
      <div class="contact-form__group-content">
        <div class="contact-form__textarea">
          <textarea name="detail"
                    placeholder="お問い合わせ内容をご記載ください">{{old('detail', $contact['detail'] ?? '')}}</textarea>
          <div class="form__error">
            @error('detail')
            {{ $message }}
            @enderror
          </div>
        </div>
      </div>
    </div>
    <div class="contact-form__button">
      <button class="contact-form__button-submit" type="submit">確認画面</button>
    </div>
  </form>
</div>
@endsection