@extends('layout.format')

@section('title')
    Edit Teacher
@endsection

@section('Header')
    @parent
@endsection

@section('Content')
    <form action="{{ route('admin.teachers.update', $teacher) }}" method="POST">
        @csrf
        @method('PUT')

        <input type="text" name="fname" value="{{ old('fname', $teacher->fname) }}" placeholder="FIRST NAME" required>
        <input type="text" name="mname" value="{{ old('mname', $teacher->mname) }}" placeholder="MIDDLE NAME">
        <input type="text" name="lname" value="{{ old('lname', $teacher->lname) }}" placeholder="LAST NAME" required>
        <input type="email" name="email" value="{{ old('email', $teacher->email) }}" placeholder="EMAIL" required>
        <input type="text" name="contact_no" value="{{ old('contact_no', $teacher->contactno) }}" placeholder="CONTACT NUMBER" required>
        <input type="password" name="password" placeholder="NEW PASSWORD">

        <input type="submit" name="submit" value="Update Teacher">
        <a class="submit-like-link" href="{{ route('admin.teachers.index') }}">Back</a>
    </form>
@endsection

@section('Footer')
    @parent
@endsection
