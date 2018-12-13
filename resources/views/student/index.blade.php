@extends('master')

@section('title')
    School Boards - Students
@endsection

@section('content')
    <div class="container">
        <div class="mt-5"></div>
        <h2 class="text-center">Students</h2>


        <table class="table table-hover">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Grades</th>
                <th>View</th>
            </tr>
            @forelse($students as $student)
                <tr>
                    <td>{{ $student->id }}</td>
                    <td>{{ $student->name }}</td>
                    <td>{{ $student->grades->count() }}</td>
                    <td><a href="{{ route('student.view', [request()->route()->parameters['schoolboard_id'], $student->id]) }}" class="btn btn-primary"><i class="far fa-eye"></i></a></td>
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