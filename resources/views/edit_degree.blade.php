@extends('layout.format')

@section('title')
    Edit Degree
@endsection

@section('Header')
    @parent
@endsection

@section('Content')

    <form action="/degrees/{{ $degree->id }}" method="POST">
        @csrf
        @method('PUT')
        <input type="text" name="degree_title" value="{{ old('degree_title', $degree->degree_title) }}" placeholder="DEGREE TITLE"/>
        <input type="submit" value="Update Degree"/>
        <a href="{{ url('/degrees') }}" class="submit-like-link">Back</a>
    </form>

@endsection

@section('Footer')
    @parent
@endsection
