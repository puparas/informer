@extends('layouts.app', [
    'title' => 'Проект: '.$project->title,
    'createButtonRoute' => 'post.create',
    'project_id' => $project->id,
    'modalClass' => 'modal-lg',
    'project_description' => $project->description,
    'projecrUrlWithoutSchema' => $projecrUrlWithoutSchema
    ])

@section('content')
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        @foreach($tabs as $tabKey => $tab)
            <li  class="nav-item" role="presentation" id="hide_{{$tabKey}}">
                <button
                    class="nav-link text-dark {{$tabKey == 'user' ? 'active': ''}}" id="{{$tabKey}}"
                    data-bs-toggle="tab"
                    data-bs-target="#{{$tabKey}}-pane"
                    type="button"
                    role="tab"
                    aria-controls="home-tab-pane"
                    aria-selected="true">{{__($tabKey)}}
                </button>
            </li>
        @endforeach
    </ul>
    <div class="tab-content" id="myTabContent">
        @foreach($tabs as $tabKey => $tab)
            <div class="hide_{{$tabKey}} tab-pane fade show {{$tabKey == 'user' ? 'active': ''}}" id="{{$tabKey}}-pane" role="tabpanel" aria-labelledby="{{$tabKey}}" tabindex="0">
                @if($tab->count())
                    @foreach($tab as $post)
                        @include('post.post', ['post' => $post, 'user' => $user, 'tabKey' => $tabKey])
                    @endforeach
                @else
                    <div class="d-flex justify-content-center  align-items-center ">
                        <p class="fs-2 text-black-50" >Пока здесь нет записей</p>
                    </div>
                @endif
            </div>
        @endforeach
    </div>
@endsection


