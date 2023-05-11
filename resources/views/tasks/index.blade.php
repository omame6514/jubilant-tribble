@extends('layouts.app')

@section('content')
    @include('tasks.tasks', ['tasks' => $tasks])
@endsection