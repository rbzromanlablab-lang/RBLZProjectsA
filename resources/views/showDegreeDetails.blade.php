@extends('layout.format')

@section('title')
    Degree Details
@endsection

@section('Header')
    @parent
@endsection

@section('Content')
    <p class="details-line">This is the details of the degree!</p>
    <p class="details-line">Degree Title: {{ $degree->degree_title }}</p>
    <a href="{{ url('/degrees') }}" class="submit-like-link">Back</a>

@endsection

@section('Footer')
    @parent
@endsection
