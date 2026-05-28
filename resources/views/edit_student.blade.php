@extends('layout.format')

@section('title')
    Edit Student
@endsection

@section('Header')
    @parent
@endsection

@section('Content')

    <form action="/students/{{ $student->id }}" method="POST">
        @csrf
        @method('PUT')
        <input type="text" name="fname" value="{{ old('fname', $student->fname) }}" placeholder="FIRST NAME"/>
        <input type="text" name="mname" value="{{ old('mname', $student->mname) }}" placeholder="MIDDLE NAME"/>
        <input type="text" name="lname" value="{{ old('lname', $student->lname) }}" placeholder="LAST NAME"/>
        <input type="email" name="email" value="{{ old('email', $student->email) }}" placeholder="EMAIL"/>
        <input type="text" name="contact_no" value="{{ old('contact_no', $student->contactno) }}" placeholder="CONTACT NUMBER"/>
        {{-- <select name="degree_id">
            <option value="1" {{ $student->degree_id == 1 ? 'selected' : '' }}>BSIT</option>
            <option value="2" {{ $student->degree_id == 2 ? 'selected' : '' }}>BSHM</option>
            <option value="3" {{ $student->degree_id == 3 ? 'selected' : '' }}>BSOA</option>
        </select> <br> --}}
        <select name="degree_id">
            @foreach($degrees as $degree)
                <option value="{{ $degree->id }}" {{ old('degree_id', $student->degree_id) == $degree->id ? 'selected' : '' }}>
                    {{ $degree->degree_title }}
                </option>
            @endforeach
        </select>
        <input type="submit" name="submit" value="Update Student"/>
    </form>

@endsection

@section('Footer')
    @parent
@endsection
