@extends('layout.format')

@section('title')
    Login
@endsection

@section('Header')
    <h1>Login</h1>
@endsection

@section('Content')
    <form action="{{ route('login.submit') }}" method="POST">
        @csrf

        <label for="email">Email</label>
        <input id="email" type="email" name="email" value="{{ old('email') }}" required>

        <label for="password">Password</label>
        <input id="password" type="password" name="password" required>

        <input type="submit" value="Login">
    </form>

    <script>
        history.replaceState(null, '', "{{ route('login') }}");
        history.pushState(null, '', "{{ route('login') }}");

        window.addEventListener('popstate', function () {
            history.pushState(null, '', "{{ route('login') }}");
        });
    </script>
@endsection
