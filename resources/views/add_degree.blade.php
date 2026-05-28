@extends('layout.format')

@section('title')
    Add Degree
@endsection

@section('Header')
    @parent
@endsection

@section('Content')

    <form action="/degrees" method="POST">
        @csrf
        <input type="text" name="degree_title" value="{{ old('degree_title') }}" placeholder="DEGREE TITLE"/>
        <input type="submit" value="Submit"/>
        <a href="{{ url('/degrees') }}" class="submit-like-link">Back</a>
    </form>

@endsection

@section('Footer')
    @parent
@endsection
