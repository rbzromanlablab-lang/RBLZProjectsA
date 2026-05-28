@extends('layout.format')

@section('title')
    Show Details
@endsection

@section('Header')
    @parent
@endsection

@section('Content')
    <p class="details-line">This is the details of the student!</p>
   <p class="details-line">First Name: {{$student->fname}}</p>
   <p class="details-line">Middle Name: {{$student->mname}}</p>
   <p class="details-line">Last Name: {{$student->lname}}</p>
   {{-- Degree:{{ $student->degree_id == 1 ? 'BSIT' : ($student->degree_id == 2 ? 'BSHM' : 'BSOA') }} <br> --}}
   <p class="details-line">Degree: {{ $student->degree->degree_title ?? 'No Degree' }}</p>
   <p class="details-line">Email: {{$student->email}}</p>
   <p class="details-line">Contact Number: {{$student->contactno}}</p>


@endsection
    
@section('Footer')
    @parent
@endsection
