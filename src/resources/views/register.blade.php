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
  <form class="account-form" action="/admin" method="post">
    @csrf
    <div class="account-form__group">
      <div class="account-form__group-title">
        <span class="account-form__label--emali">お名前</span>
      </div>
      <div class="account-form__input--text">
        <input type="text" name="name" placeholder="例: 山田　太郎" value=""/>
      </div>
    </div>
    <div class="account-form__group">
      <div class="account-form__group-title">
        <span class="account-form__label--emali">メールアドレスメールアドレス</span>
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
      <button class="account-form__button-submit" pe="submit">登録</button>
    </div>
  </form>
</div>
@endsection