@extends('master')

@section('title')
    School Boards - Student - {{ $student->name }}
@endsection

@section('content')
    <div class="container">
        <div class="mt-5"></div>
        <h2>#{{$student->id}} - {{ $student->name }}</h2>


        <h3 class="text-center">Grades</h3>
        <table class="table table-hover">
            <tr>
                <th>Grade</th>
            </tr>
            @forelse($student->grades as $grade)
                <tr>
                    <td>{{ $grade->grade }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="100">There's currently no data</td>
                </tr>
            @endforelse
        </table>

        <a href="{{ route('schoolboard.generate', [$student->schoolboard, $student]) }}" class="btn btn-success" target="_blank">Generate Report</a>
        <div class="mb-5"></div>
    </div>
@endsection