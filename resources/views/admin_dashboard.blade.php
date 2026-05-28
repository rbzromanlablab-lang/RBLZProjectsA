@extends('layout.format')

@section('title')
    Admin Dashboard
@endsection

@section('Header')
    <h1>Admin Dashboard</h1>
@endsection

@section('Content')
    <p>Welcome, {{ auth()->user()->name }}. You can add student and teacher accounts here.</p>

    <div class="dashboard-grid">
        <div class="panel">
            <h3>Add User</h3>
            <form action="{{ route('admin.users.store') }}" method="POST">
                @csrf

                <label for="name">Name</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}" required>

                <label for="email">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required>

                <label for="password">Password</label>
                <input id="password" type="password" name="password" required>

                <label for="role">Role</label>
                <select id="role" name="role" required>
                    <option value="student" @selected(old('role') === 'student')>Student</option>
                    <option value="teacher" @selected(old('role') === 'teacher')>Teacher</option>
                </select>

                <input type="submit" value="Add User">
            </form>
        </div>

        <div class="panel">
            <h3>Users</h3>
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ ucfirst($user->role) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="panel student-list-panel">
        <h3>Student List</h3>

        <table>
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
            <tbody>
                @forelse($students as $student)
                    <tr>
                        <td>{{ $student->id }}</td>
                        <td>{{ $student->lname }}, {{ $student->fname }} {{ $student->mname }}</td>
                        <td>{{ $student->degree->degree_title ?? 'No Degree' }}</td>
                        <td>{{ $student->email }}</td>
                        <td>{{ $student->contactno }}</td>
                        <td><a href="/students/{{ $student->id }}">View</a></td>
                        <td><a href="/students/{{ $student->id }}/edit">Edit</a></td>
                        <td>
                            <form class="action-form" action="/students/{{ $student->id }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <input type="submit" name="delete" value="Delete">
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8">No student!</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="panel record-list-panel">
        <h3>Teacher List</h3>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Contact</th>
                    <th colspan="3">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($teachers as $teacher)
                    <tr>
                        <td>{{ $teacher->id }}</td>
                        <td>
                            @if($teacher->lname || $teacher->fname)
                                {{ $teacher->lname }}, {{ $teacher->fname }} {{ $teacher->mname }}
                            @else
                                {{ $teacher->name }}
                            @endif
                        </td>
                        <td>{{ $teacher->email }}</td>
                        <td>{{ $teacher->contactno }}</td>
                        <td><a href="{{ route('admin.teachers.show', $teacher) }}">View</a></td>
                        <td><a href="{{ route('admin.teachers.edit', $teacher) }}">Edit</a></td>
                        <td>
                            <form class="action-form" action="{{ route('admin.teachers.destroy', $teacher) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <input type="submit" name="delete" value="Delete">
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7">No teacher!</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
