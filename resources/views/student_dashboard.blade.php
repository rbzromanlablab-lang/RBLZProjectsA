@extends('layout.format')

@section('title')
    Student Dashboard
@endsection

@section('Header')
    <h1>Student Dashboard</h1>
@endsection

@section('Content')
    <p>Welcome, {{ auth()->user()->name }}.</p>

    <div class="dashboard-grid">
        <div class="panel">
            <h3>Account Type</h3>
            <p>Student</p>
        </div>
        <div class="panel">
            <h3>Email</h3>
            <p>{{ auth()->user()->email }}</p>
        </div>
    </div>

    <h2 class="section-title">Student List</h2>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Full Name</th>
                <th>Degree</th>
                <th>Email</th>
                <th>Contact</th>
            </tr>
        </thead>
        <tbody>
            @forelse($students as $student)
                <tr>
                    <td>{{ $student->id }}</td>
                    <td>{{ $student->lname }}, {{ $student->fname }} {{ $student->mname }}</td>
                    <td>{{ $student->degree->degree_title ?? 'No Degree' }}</td>
                    <td>{{ $student->email }}</td>
                    <td>{{ $student->contactno }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">No student!</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{ $students->links() }}
@endsection
