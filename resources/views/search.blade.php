@extends('layouts.app', [
    'title' => 'Найденные посты',
    'modalClass' => 'modal-lg',])

@section('content')
    @foreach($posts as $post)
{{--        {{dump($post->role_id)}}--}}
        @php
//        dd($post->role_id, $user->id);
            if($post->role_id == $user->id){
                $tabKey = 'private';
            }elseif($post->role_id == '666'){
                $tabKey = 'user';
            }elseif($post->role_id == '777'){
                $tabKey = 'all';
                dd($tabKey);
            }else{
                $tabKey = $user->roles->where('id', $post->role_id)->first()->slug;
            }
        @endphp
        @include('post.post', ['post' => $post, 'user' => $user, 'tabKey', 'search' => true])
    @endforeach
@endsection
