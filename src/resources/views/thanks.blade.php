@php
  $show_header = 0;
  $show_header_button = "";
@endphp

@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/thanks.css') }}" />
@endsection

@section('content')
<div class="thanks__content" method='get'>
  <div class="thanks__heading">
    <h2>お問い合わせありがとうございました</h2>
  </div>
  <div class="thanks__button">
    <form action="/">
      <button class="thanks__button-submit">HOME
      </button>
    </form>
  </div>
</div>
@endsection
