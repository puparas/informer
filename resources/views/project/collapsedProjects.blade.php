<dvi class="row">
    <div class="com-md-12">
        <a class="" data-bs-toggle="collapse" href="#{{$id}}" role="button" aria-expanded="false" aria-controls="{{$id}}">
            <h4 class="text-dark">{{$title}}</h4>
        </a>
    </div>
</dvi>
<div class="collapse" id="{{$id}}">
    <div class="row">
        @foreach($projects as $project)
            @include('project.project', ['type' => $type])
        @endforeach
    </div>
</div>
