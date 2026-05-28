@extends('layout.format')

@section('title')
    Teacher Dashboard
@endsection

@section('Header')
    <h1>Teacher Dashboard</h1>
@endsection

@section('Content')
    <p>Welcome, {{ auth()->user()->name }}.</p>

    <div class="dashboard-grid">
        <div class="panel">
            <h3>Account Type</h3>
            <p>Teacher</p>
        </div>
        <div class="panel">
            <h3>Email</h3>
            <p>{{ auth()->user()->email }}</p>
        </div>
    </div>
@endsection
