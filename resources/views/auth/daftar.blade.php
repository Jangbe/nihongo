@extends('layout.auth')
@section('title', 'Daftar')
@section('name', 'Daftar')
@section('body')
<form action="" method="post">
    @csrf
    <div class="input-field">
        <i class="material-icons prefix">account_circle</i>
        <label for="user_id">User Id</label>
        <input type="hidden" name="user" value="{{$id}}">
        <input type="text" id="user_id" disabled value="{{$id}}">
    </div>
    <div class="input-field">
        <i class="material-icons prefix">account_circle</i>
        <label for="user">Nama Lengkap</label>
        <input type="text" name="nama" id="user" autocomplete="off">
    </div>
    <div class="input-field">
        <i class="material-icons prefix">lock</i>
        <label for="pass">Password</label>
        <input type="password" name="pass" id="pass">
    </div>
    <div class="input-field">
        <i class="material-icons prefix">lock</i>
        <label for="cpass">Confirm Password</label>
        <input type="password" name="confirm" id="cpass">
    </div>
    <button class="btn col s12">Daftar</button>
</form>
@endsection
