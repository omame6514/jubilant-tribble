@extends('layouts.app')

@section('content')
    <h1>{{ $user->name }} のタスク編集ページ</h1>

    {!! Form::model($task, ['route' => ['tasks.update', $task->id], 'method' => 'put']) !!}
        <?php //dd($task->id) ?>

        {!! Form::label('content', 'メッセージ:') !!}
        {!! Form::text('content') !!}
        
        {!! Form::label('status', '進捗状況:') !!}
        {!! Form::text('status') !!}
        
        

        {!! Form::submit('更新') !!}

    {!! Form::close() !!}
    
    {!! Form::open(['route' => ['tasks.destroy', $task->id], 'method' => 'delete']) !!}
        {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-xs']) !!}
    {!! Form::close() !!}

@endsection