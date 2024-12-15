@php
  $show_header = 1;
  $header_button = "login";
@endphp
@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}" />
@endsection

@section('content')
<div class="account__content">
  <div class="account-section__title">
    <h2>Register</h2>
  </div>
  <form class="account-form" action="/register" method="post">
    @csrf
    <div class="account-form__group">
      <div class="account-form__title">
        <span class="account-form__label">お名前</span>
      </div>
      <div class="account-form__input">
        <input type="text" name="name" placeholder="例: 山田　太郎" value="{{old('name')}}"/>
        <div class="form__error">
          @error('name')
          {{ $message }}
          @enderror
        </div>
      </div>
    </div>
    <div class="account-form__group">
      <div class="account-form__title">
        <span class="account-form__label">メールアドレス</span>
      </div>
      <div class="account-form__input">
        <input type="text" name="email" placeholder="例: text@example.com" value="{{old('email')}}"/>
        <div class="form__error">
          @error('email')
          {{ $message }}
          @enderror
        </div>
      </div>
    </div>
    <div class="account-form__group">
      <div class="account-form__title">
        <span class="account-form__label">パスワード</span>
      </div>
      <div class="account-form__input">
        <input type="password" name="password" placeholder=" 例: coachtech1106"/>
        <div class="form__error">
          @error('password')
          {{ $message }}
          @enderror
        </div>
      </div>
    </div>
    <div class="account-form__button">
      <button class="account-form__button-submit" pe="submit">登録</button>
    </div>
  </form>
</div>
@endsection