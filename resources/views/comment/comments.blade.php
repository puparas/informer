{{--{{dd($post->comments)}}--}}


<div class="comments d-flex align-items-end flex-column">
    @foreach($post->comments as $comment)
        <div class="collapse my-1" id="collapse{{$post->id}}{{$tabKey}}comments">
            <ul class="nav nav-tabs meta-data mx-1">
                <li class="nav-item border">
                    <a class="nav-link p-0 px-1 disabled border-bottom-0" aria-current="page" href="#">Автор: {{$comment->user->name}}</a>
                </li>
                <li class="nav-item border">
                    <a class="nav-link p-0 px-1 disabled border-bottom-0" href="#">Дата создания: {{$comment->created_at->format('d.m.y')}}</a>
                </li>
            </ul>
            <div class="card card-body p-2">
                {{$comment->comment}}
                @if($user->id == $comment->user->id)
                    <div class="d-flex justify-content-end">
                        <div class="btn-group btn-group-sm">
                            <button onclick="getModalForm('{{route('comment.edit', $comment->id)}}')"
                                    data-bs-toggle="collapse"
                                    role="button"
                                    aria-expanded="false"
                                    aria-controls="collapseExample"
                                    type="button"
                                    class="p-1 btn btn-sm btn-secondary">Редактировать</button>
                            <button type="button" class="p-1 btn btn-sm btn-danger dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
                                <span class="visually-hidden">Выпадашка</span>
                            </button>
                            <ul class="dropdown-menu p-0">
                                <li><a onclick="dialog('{{route('comment.destroy', $comment->id)}}')" href="#" class="dropdown-item" >Удалить</a></li>
                            </ul>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    @endforeach

</div>
