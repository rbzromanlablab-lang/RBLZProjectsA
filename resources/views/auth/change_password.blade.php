@extends('layout.format')

@section('title')
    Change Password
@endsection

@section('Header')
    <h1>Change Password</h1>
@endsection

@section('Content')
    <p class="details-line">Please change your password before continuing.</p>

    <form action="{{ route('password.update') }}" method="POST">
        @csrf

        <input type="password" name="old_password" placeholder="OLD PASSWORD" required>
        <input type="password" name="password" placeholder="NEW PASSWORD" required>
        <input type="password" name="password_confirmation" placeholder="CONFIRM PASSWORD" required>

        <input type="submit" value="Change Password">
    </form>
@endsection
