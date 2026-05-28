@extends('layout.format')

@section('title')
    Students
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
        <select id="degree_id" name="degree_id">
            <option value="">Select Degree</option>
            @foreach($degrees as $degree)
                <option value="{{ $degree->id }}" {{ old('degree_id') == $degree->id ? 'selected' : '' }}>
                    {{ $degree->degree_title }}
                </option>
            @endforeach
        </select>
        <button id="student-submit" type="button">Add Student</button>
        <button id="cancel-edit" type="button" style="display: none;">Cancel Edit</button>
    </div>

   <table id="students-table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Full Name</th>
            <th>Degree</th>
            <th>Email</th>
            <th>Contact</th>
            <th colspan="3">Action</th>

        </tr>
    </thead>
    <tbody id="students-table-body">
        @forelse($students as $student)
            <tr id="student-row-{{ $student->id }}">
                <td>{{ $student['id'] }} <br> </td>
                <td>{{ $student['lname'] }}, {{ $student['fname'] }} {{ $student['mname'] }} <br> </td>
                {{-- <td>
                    {{ $student['degree_id'] == 1 ? 'BSIT' : ($student['degree_id'] == 2 ? 'BSHM' : 'BSOA') }}
                    <br>
                </td> --}}
                <td>{{ $student->degree->degree_title ?? 'No Degree' }} <br> </td>
                <td>{{ $student['email'] }} <br> </td>
                <td>{{ $student['contactno'] }}</td>
                <td> <a href="/students/{{$student['id']}}"> View </a> </td>
                <td>
                    <button
                        class="edit-student"
                        type="button"
                        data-id="{{ $student->id }}"
                        data-fname="{{ $student->fname }}"
                        data-mname="{{ $student->mname }}"
                        data-lname="{{ $student->lname }}"
                        data-email="{{ $student->email }}"
                        data-contact-no="{{ $student->contactno }}"
                        data-degree-id="{{ $student->degree_id }}"
                    >
                        Edit
                    </button>
                </td>
                <td>
                    <button class="delete-student" type="button" data-url="/students/{{$student['id']}}">
                        Delete
                    </button>
                </td>
                
            </tr>
        @empty
            <tr>
                <td colspan="3">No student!</td>
            </tr>
        @endforelse
    </tbody>
</table>

<div id="students-pagination">
    {{$students->links()}}
</div>

@endsection
    
@section('Footer')
    @parent
@endsection
