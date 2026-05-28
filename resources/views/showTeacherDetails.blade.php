@extends('layout.format')

@section('title')
    Show Teacher Details
@endsection

@section('Header')
    @parent
@endsection

@section('Content')
    <p class="details-line">This is the details of the teacher!</p>
    <p class="details-line">First Name: {{ $teacher->fname }}</p>
    <p class="details-line">Middle Name: {{ $teacher->mname }}</p>
    <p class="details-line">Last Name: {{ $teacher->lname }}</p>
    <p class="details-line">Email: {{ $teacher->email }}</p>
    <p class="details-line">Contact Number: {{ $teacher->contactno }}</p>

    <a class="submit-like-link" href="{{ route('admin.teachers.index') }}">Back</a>
@endsection

@section('Footer')
    @parent
@endsection
