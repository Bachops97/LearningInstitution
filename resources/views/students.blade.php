<!-- resources/views/students/index.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h1>All Students</h1>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Age</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($students as $student)
                <tr>
                    <td>{{ $student->id }}</td>
                    <td>{{ $student->name }}</td>
                    <td>{{ $student->age }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
