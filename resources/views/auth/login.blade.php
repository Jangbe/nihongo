@extends('layout.auth')
@section('name', 'Login')
@section('title', 'Login')
@section('body')
<form action="" method="post">
    @csrf
    <div class="input-field">
        <i class="material-icons prefix">account_circle</i>
        <label for="user_id">User Id</label>
        <input type="text" name="user_id" id="user_id" autocomplete="off">
    </div>
    <div class="input-field">
        <i class="material-icons prefix">lock</i>
        <label for="pass">Password</label>
        <input type="password" name="password" id="pass">
    </div>
    <button class="btn col s12">Login</button>
</form>
@endsection
