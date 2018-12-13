@extends('master')

@section('title')
    School Boards
@endsection

@section('content')
    <div class="container">
        <div class="mt-5"></div>
        <h2 class="text-center">School boards</h2>
        <table class="table table-hover">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>View</th>
            </tr>
            @forelse($schoolboards as $schoolboard)
                <tr>
                    <td>{{ $schoolboard->id }}</td>
                    <td>{{ $schoolboard->name }}</td>
                    <td><a href="{{ route('student.index', [$schoolboard->id]) }}" class="btn btn-primary"><i class="far fa-eye"></i></a></td>
                </tr>
                @empty
                <tr>
                    <td colspan="100">There's currently no data</td>
                </tr>
            @endforelse
        </table>
        <div class="mb-5"></div>
    </div>
@endsection