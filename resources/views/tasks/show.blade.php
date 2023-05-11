@extends('layouts.app')

@section('content')
    <div class="row">
        <aside class="col-xs-4">
            <h3>{{ $user->name }}のタスク一覧ページ</h3>
        </aside>
        <div class="col-xs-8">
            <table width="200">
                <th>id</th>
                <th>ステータス</th>
                <th>内容</th>
            </table>
        </div>
        <div class="col-xs-8">
            @if (count($user->tasks) > 0)
                @if(Auth::id() == $user->id)
                    @foreach ($tasks as $task)
                        <li>{!! link_to_route("tasks.edit",$user->id,["id" => $task->id ]) !!}タスクID:{{$task->id }} : {{ $task->status }} > {{ $task->content }}</li>
                    @endforeach
                @else
                     @foreach ($tasks as $task)
                        <li>{{ $task->id }} : {{ $task->status }} > {{ $task->content }}</li>
                    @endforeach
                @endif
            @endif
        </div>
        <div>
            @if (Auth::id() == $user->id)
                    {!! link_to_route("tasks.create","新規タスクの追加",["id" => $user->id]) !!}
                    <?php
                        //{!! Form::open(['route' => ['tasks.create', $user->id]]) !!}
                            //{!! Form::submit('新規タスクの追加', ['class' => 'btn btn-primary btn-xs']) !!}
                        //{!! Form::close() !!}
                    ?>
            @endif
        </div>
    </div>
@endsection