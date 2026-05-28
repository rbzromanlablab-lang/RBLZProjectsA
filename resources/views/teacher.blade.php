@extends('layout.format')

@section('title')
    Teachers
@endsection

@section('Header')
    <h1>Teachers</h1>
@endsection

@section('Content')
    <a class="page-link" href="{{ route('admin.teachers.create') }}">Add Teacher</a>

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
@endsection

@section('Footer')
    @parent
@endsection
