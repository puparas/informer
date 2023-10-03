@php
    $daysToDel = null;
    if($project->deleted_at){
        $daysToDel = $project->deleted_at->diffInDays(now()->subMonth()) . getDayVariant($daysToDel);
    }
    $owner = $project->users->contains($user->id);
@endphp
<div class="col-md-4 ">
    <div class=" shadow card border-dark text-bg-{{ $owner ? 'success' : 'secondary'}} mb-3 bg-gradient bg-opacity-75 position-relative" >
        @if($daysToDel)
            <div class="forDel">
                <p class="text-light">{{ __('БУДЕТ УДАЛЕНО ЧЕРЕЗ ') . $daysToDel }}</p>
                <button onclick="dialog('{{route('informer.restore', $project->id)}}', 'POST')" type="button" class="btn btn-sm text-light bg-danger bg-gradient bg-opacity-75">Восстановить</button>
            </div>
        @endif
        <div class="card-header bg-transparent border-light">
            <a target="_blank" class="text-white" href="{{$project->url}}">
                <small>{{Str::limit($project->url, 40)}}
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-bar-right" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M6 8a.5.5 0 0 0 .5.5h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L12.293 7.5H6.5A.5.5 0 0 0 6 8Zm-2.5 7a.5.5 0 0 1-.5-.5v-13a.5.5 0 0 1 1 0v13a.5.5 0 0 1-.5.5Z"/>
                    </svg>
                </small>
            </a>

        </div>
        <div class="card-body">
            <h5 class="card-title"><a class="text-white" href="{{route('informer.show', $project->id)}}">{{$project->title}}</a></h5>
            <p class="card-text">{{$project->description ?? __('defaultDescription')}}</p>
        </div>
            @if($owner)
                <div class="btn-group float-end">
                    <button onclick="window.location.href='{{route('informer.show', $project->id)}}'" type="button" class="btn btn-sm btn-secondary">Перейти к заметкам</button>
            @else
                <div class="btn-group float-end">
                    <button onclick="dialog('{{route('informer.chosen', $project->id)}}', 'POST')" type="button" class="btn btn-sm btn-warning">В избранные</button>
{{--                <div class="btn-group float-end">--}}
{{--                    <button onclick="dialog('{{route('informer.chosen', $project->id)}}', 'POST')" type="button" class="btn btn-warning">В избранные</button>--}}
{{--                </div>--}}
            @endif
                    <button type="button" class="btn btn-sm btn-danger dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="visually-hidden">Выпадашка</span>
                    </button>
                    @include('project.dropdownButtons')
                </div>
    </div>
</div>
