@extends('layout.format')

@section('title')
    Add Teacher
@endsection

@section('Header')
    @parent
@endsection

@section('Content')
    <form action="{{ route('admin.teachers.store') }}" method="POST">
        @csrf

        <input type="text" name="fname" value="{{ old('fname') }}" placeholder="FIRST NAME">
        <input type="text" name="mname" value="{{ old('mname') }}" placeholder="MIDDLE NAME">
        <input type="text" name="lname" value="{{ old('lname') }}" placeholder="LAST NAME">
        <input type="email" name="email" value="{{ old('email') }}" placeholder="EMAIL">
        <input type="text" name="contact_no" value="{{ old('contact_no') }}" placeholder="CONTACT NUMBER">
        <input type="submit" name="submit" value="submit">
        <a class="submit-like-link" href="{{ route('admin.teachers.index') }}">Back</a>
    </form>
@endsection

@section('Footer')
    @parent
@endsection
