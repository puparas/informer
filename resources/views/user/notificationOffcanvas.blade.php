@php
    $colors = [
        3 => 'bg-danger',
        2 => 'bg-warning',
        1 => 'bg-light'
    ];
@endphp
<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasExampleLabel">Уведомления</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <div>
            Уведомления о новых заметках в проектах к которым вы имеете отношение
        </div><br>
        <ol class="list-group list-group-numbered">
            @foreach(Auth::user()->notifications as $notification)
                <li class="list-group-item d-flex justify-content-between align-items-start">
                    <div class="ms-2 me-auto">
                        <div class="fw-bold">
                           Проект: {{$notification->data['project']['title']}} ({{$notification->data['project']['url']}})
                        </div>
                        <a target="_blank" href="{{route('informer.show', $notification->data['project']['id'])}}?post=heading{{$notification->data['post']['id']}}{{$notification->data['role_slug']}}&tab={{$notification->data['role_slug']}}">{{$notification->data['post']['title']}}</a>
                    </div>
                    <span class="text-dark badge {{$colors[$notification->data['post']['priority']]}} rounded-pill">!</span>
                </li>
            @endforeach
        </ol>
    </div>
</div>
