@extends('layout.format')

@section('title')
    Degrees
@endsection

@section('Header')
    @parent
@endsection

@section('Content')
    <a class="page-link" href="/degrees/create">Add Degree</a>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Degree Title</th>
                <th colspan="3"> Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($degrees as $degree)
                <tr>
                    <td>{{ $degree->id }}</td>
                    <td>{{ $degree->degree_title }}</td>
                    <td><a href="/degrees/{{ $degree->id }}">View</a></td>
                    <td><a href="/degrees/{{ $degree->id }}/edit">Edit</a></td>
                    <td>
                        <form class="action-form" action="/degrees/{{ $degree->id }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="submit" value="Delete">
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3">No degree record!</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{ $degrees->links() }}

@endsection

@section('Footer')
    @parent
@endsection
