@extends('layout.format')

@section('title')
    Add Student
@endsection

@section('Header')
    @parent
@endsection

@section('Content')

    <div id="ajax-message" class="alert" style="display: none;"></div>

    <div id="student-form">
        @csrf
         <input type="hidden" id="student-id" name="student_id">
         <input type="text" id="fname" name="fname" value="{{ old('fname') }}" placeholder="FIRST NAME"/>
         <input type="text" id="mname" name="mname" value="{{ old('mname') }}" placeholder="MIDDLE NAME"/>
         <input type="text" id="lname" name="lname" value="{{ old('lname') }}" placeholder="LAST NAME"/>
         <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="EMAIL"/>
         <input type="text" id="contact_no" name="contact_no" value="{{ old('contact_no') }}" placeholder="CONTACT NUMBER"/>
         {{-- <select name="degree_id">
            <option value="1">BSIT</option>
            <option value="2">BSHM</option>
            <option value="3">BSOA</option>
         </select> <br> --}}
         <select id="degree_id" name="degree_id">
            <option value="">Select Degree</option>
            @foreach($degrees as $degree)
                <option value="{{ $degree->id }}" {{ old('degree_id') == $degree->id ? 'selected' : '' }}>{{ $degree->degree_title }}</option>
            @endforeach
         </select>
         <button id="student-submit" type="button">Add Student</button>
         <a href="{{ url('/students') }}" class="submit-like-link">Back</a>
    </div>
   
@endsection
    
@section('Footer')
    @parent
@endsection
