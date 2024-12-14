@php
  $show_header = 1;
  $header_button = "register";
@endphp

@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/login.css') }}" />
@endsection

@section('content')
<div class="account__content">
  <div class="account-section__title">
    <h2>Login</h2>
  </div>
  <form class="account-form" action="/login" method="post">
    @csrf
    <div class="account-form__group">
      <div class="account-form__group-title">
        <span class="account-form__label--emali">メールアドレス</span>
      </div>
      <div class="account-form__input--text">
        <input type="email" name="email" placeholder="例: text@example.com" value=""/>
      </div>
    </div>
    <div class="account-form__group">
      <div class="account-form__group-title">
        <span class="account-form__label--password">パスワード</span>
      </div>
      <div class="account-form__input--text">
        <input type="password" name="password" placeholder=" 例: coachtech1106"/>
      </div>
    </div>
    <div class="account-form__button">
      <button class="account-form__button-submit" type="submit">ログイン</button>
    </div>
  </form>
</div>
@endsection