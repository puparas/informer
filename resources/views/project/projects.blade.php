@extends('layouts.app', ['title' => 'Проекты', 'createButtonRoute' => 'informer.create',
    'modalClass' => 'modal-lg',])

@section('content')
{{--    {{dd($projects)}}--}}
@if(isset($projects))
<div class="row">
{{--    <div class="col-md-12">--}}
{{--        <h4>Мои проекты</h4>--}}
{{--    </div>--}}
    @foreach($projects as $project)
        @include('project.project')
    @endforeach
</div>
@endif
@endsection
