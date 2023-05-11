@if (count($tasks) > 0)
<ul class="media-list">
@foreach ($tasks as $task)
    <li class="media">
        <div class="media-left">
            <!--<img class="media-object img-rounded" src="<?php//{{ Gravatar::src($user->email, 50) }}?>" alt="">-->
        </div>
        <div class="media-body">
            <div>
                {{ $user->tasks }}
            </div>
            <div>
                <p>{!! link_to_route('users.show', 'View profile', ['id' => $user->id]) !!}</p>
            </div>
        </div>
    </li>
@endforeach
</ul>

@endif