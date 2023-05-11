<ul class="media-list">
@foreach ($tasks as $task)
    <?php $user = $task->user; ?>
    <li class="media">
        <div class="media-body">
            <div>
                <p>{!! nl2br(e($task->content)) !!}</p>
            </div>
        </div>
    </li>
@endforeach
</ul>
{!! $tasks->render() !!}