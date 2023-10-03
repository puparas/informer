@php
    $uniqTabId = $post->id.$tabKey;
    $colors = [
        3 => ['bg-danger  border border-top-1 text-light fw-bold', 'bg-light border border-top-1'],
        2 => ['bg-warning  border border-top-1  fw-bold', 'bg-light border border-top-1'],
        1 => ['bg-light border-body border border-top-1 fw-bold', 'bg-light border-body border border-top-1']
    ];
    $daysToDel = null;
    if($post->deleted_at){
        $daysToDel = $post->deleted_at->diffInDays(now()->subMonth());
        $daysToDel = $daysToDel . getDayVariant($daysToDel);
    }
@endphp
<div class="accordion mt-3 position-relative " id="accordionExample">
    <ul class="nav nav-tabs meta-data mx-1">
        <li class="nav-item border">
            <a class="nav-link p-0 px-2 disabled border-bottom-0" aria-current="page" href="#">Автор: {{$post->user?->name ?? 'Господин никто'}}</a>
        </li>
        <li class="nav-item border">
            <a class="nav-link p-0 px-2 disabled border-bottom-0" href="#">Дата создания: {{$post->created_at->format('d.m.y')}}</a>
        </li>

    </ul>
    @if($daysToDel)
        <div class="forDel forDelPost">
            <p class="text-light">{{ __('БУДЕТ УДАЛЕНО ЧЕРЕЗ ') . $daysToDel }}</p>
            <button onclick="dialog('{{route('post.restore', $post->id)}}', 'POST')" type="button" class="btn btn-sm text-light bg-danger bg-gradient bg-opacity-75">Восстановить</button>
        </div>
    @endif
    <div class=" border-2 accordion-item Small shadow-sm">
        <h2 class="accordion-header" id="heading{{$uniqTabId}}">
            <button class=" accordion-button collapsed {{$colors[$post->priority][0]}} bg-gradient" style="--bs-bg-opacity: .7;" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{$uniqTabId}}" aria-expanded="false" aria-controls="collapse{{$uniqTabId}}">
                {{$post->title}}
            </button>
        </h2>
        <div id="collapse{{$uniqTabId}}" class="{{$colors[$post->priority][1]}} accordion-collapse collapse" style="--bs-bg-opacity: .7;" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
            <div class="accordion-body text-body">
                {!! $post->content !!}
            </div>
        </div>

        <div class="p-1 bg-body  px-2 d-flex align-items-center justify-content-between" >
            @if($post->user?->id == $user?->id)
                <div class="btn-group ">
                    <button onclick="getModalForm('{{route('post.edit', $post->id)}}')" type="button" class="btn btn-sm btn-secondary">Редактировать</button>
                    <button type="button" class="btn btn-sm btn-danger dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="visually-hidden">Выпадашка</span>
                    </button>
                    <ul class="dropdown-menu p-0">
                        <li><a href="#" onclick="dialog('{{route('post.destroy', $post->id)}}')" class="dropdown-item" >Удалить</a></li>
                    </ul>
                </div>
            @endif
            @if($tabKey != 'private' && $tabKey != 'user')
                <button type="button" class="btn btn-sm btn-info mx-2" onclick="copyToClipboard(this)" data-link="{{request()->root()}}/informer/{{$post->project->id}}?post=heading{{$post->id}}{{$tabKey}}&tab={{$tabKey}}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-share-fill" viewBox="0 0 16 16">
                        <path d="M11 2.5a2.5 2.5 0 1 1 .603 1.628l-6.718 3.12a2.499 2.499 0 0 1 0 1.504l6.718 3.12a2.5 2.5 0 1 1-.488.876l-6.718-3.12a2.5 2.5 0 1 1 0-3.256l6.718-3.12A2.5 2.5 0 0 1 11 2.5z"/>
                    </svg>
                </button>
            @endif
            @if(isset($search))
                    <a target="_blank" class="nav-link p-0 px-2 border-bottom-0" href="{{route('informer.show', $post->project->id)}}">На страницу проекта</a>
            @endif
            <div class="btn-group btn-group-sm ms-auto">
                <button data-bs-toggle="collapse" href="#collapse{{$post->id}}{{$tabKey}}comments" role="button" aria-expanded="false" aria-controls="collapseExample" type="button" class="btn btn-sm btn-secondary">Комментарии ({{$post->comments->count()}})</button>
                <button type="button" class="btn btn-sm btn-success dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
                    <span class="visually-hidden">Выпадашка</span>
                </button>
                <ul class="dropdown-menu p-0">
                    <li><a href="#" onclick="getModalForm('{{route('comment.create', $post->id)}}')" class="dropdown-item" >Добавить комментарий</a></li>
                </ul>
            </div>
        </div>
    </div>
    @include('comment.comments')
</div>
