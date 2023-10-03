<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @php
        $isInFrame = app('request')->input('iframe') == "Y"
    @endphp
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="/favicon.ico">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <meta id="csrf" content="{{ csrf_token() }}">
    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/6.3.2/tinymce.min.js"></script>
    @vite('resources/js/app.js')
    @if($isInFrame)
        <link rel="stylesheet" href="{{ URL::asset('frame.css') }}" />
    @endif
</head>
<body>
<div class="preloaderWrapper">
    <div class="loader"></div>
</div>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ $isInFrame ? '#' : route('informer.index')}}">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="112px" height="16px" viewBox="0 0 110 16" version="1.1">
                        <g id="surface1">
                            <path style=" stroke:none;fill-rule:nonzero;fill:rgb(0.784314%,27.058824%,93.333333%);fill-opacity:1;" d="M -0.121094 0.59375 C -0.121094 0.542969 -0.113281 0.492188 -0.09375 0.445312 C -0.0742188 0.398438 -0.0429688 0.355469 -0.0078125 0.320312 C 0.0273438 0.28125 0.0703125 0.253906 0.117188 0.234375 C 0.164062 0.214844 0.214844 0.203125 0.265625 0.203125 L 6.082031 0.203125 C 7.25 0.199219 8.375 0.65625 9.207031 1.476562 C 10.039062 2.300781 10.511719 3.421875 10.523438 4.59375 C 10.523438 6.472656 9.28125 8.007812 7.507812 8.722656 L 10.300781 13.917969 C 10.339844 13.976562 10.359375 14.046875 10.359375 14.117188 C 10.363281 14.191406 10.34375 14.261719 10.308594 14.320312 C 10.273438 14.382812 10.21875 14.433594 10.15625 14.464844 C 10.09375 14.5 10.023438 14.515625 9.953125 14.511719 L 7.816406 14.511719 C 7.75 14.515625 7.683594 14.5 7.628906 14.46875 C 7.570312 14.433594 7.523438 14.386719 7.492188 14.328125 L 4.785156 8.910156 L 2.527344 8.910156 L 2.527344 14.125 C 2.523438 14.226562 2.484375 14.324219 2.410156 14.398438 C 2.335938 14.46875 2.238281 14.511719 2.136719 14.511719 L 0.265625 14.511719 C 0.164062 14.511719 0.0625 14.46875 -0.0078125 14.398438 C -0.0820312 14.324219 -0.121094 14.226562 -0.121094 14.125 Z M 5.863281 6.726562 C 6.941406 6.726562 7.878906 5.785156 7.878906 4.640625 C 7.863281 4.113281 7.648438 3.609375 7.269531 3.238281 C 6.894531 2.867188 6.390625 2.660156 5.863281 2.660156 L 2.546875 2.660156 L 2.546875 6.726562 Z M 5.863281 6.726562 "/>
                            <path style=" stroke:none;fill-rule:nonzero;fill:rgb(0.784314%,27.058824%,93.333333%);fill-opacity:1;" d="M 14.148438 0.59375 C 14.148438 0.492188 14.1875 0.390625 14.261719 0.320312 C 14.335938 0.246094 14.433594 0.203125 14.535156 0.203125 L 22.820312 0.203125 C 22.871094 0.203125 22.921875 0.214844 22.96875 0.234375 C 23.015625 0.253906 23.058594 0.28125 23.09375 0.320312 C 23.128906 0.355469 23.15625 0.398438 23.175781 0.445312 C 23.195312 0.492188 23.207031 0.542969 23.207031 0.59375 L 23.207031 2.265625 C 23.207031 2.316406 23.195312 2.367188 23.175781 2.414062 C 23.15625 2.460938 23.128906 2.503906 23.09375 2.542969 C 23.058594 2.578125 23.015625 2.605469 22.96875 2.625 C 22.921875 2.644531 22.871094 2.65625 22.820312 2.65625 L 16.800781 2.65625 L 16.800781 6.011719 L 21.824219 6.011719 C 21.925781 6.011719 22.019531 6.054688 22.09375 6.128906 C 22.164062 6.199219 22.207031 6.296875 22.207031 6.398438 L 22.207031 8.097656 C 22.207031 8.199219 22.167969 8.296875 22.09375 8.371094 C 22.023438 8.445312 21.925781 8.484375 21.824219 8.484375 L 16.800781 8.484375 L 16.800781 12.058594 L 22.828125 12.058594 C 22.929688 12.058594 23.027344 12.101562 23.097656 12.171875 C 23.171875 12.246094 23.210938 12.34375 23.210938 12.445312 L 23.210938 14.125 C 23.210938 14.226562 23.171875 14.324219 23.097656 14.398438 C 23.027344 14.46875 22.929688 14.511719 22.828125 14.511719 L 14.535156 14.511719 C 14.433594 14.511719 14.335938 14.46875 14.261719 14.398438 C 14.1875 14.324219 14.148438 14.226562 14.148438 14.125 Z M 14.148438 0.59375 "/>
                            <path style=" stroke:none;fill-rule:nonzero;fill:rgb(0.784314%,27.058824%,93.333333%);fill-opacity:1;" d="M 26.890625 0.59375 C 26.890625 0.542969 26.902344 0.492188 26.917969 0.445312 C 26.9375 0.398438 26.96875 0.355469 27.003906 0.320312 C 27.039062 0.28125 27.082031 0.253906 27.128906 0.234375 C 27.175781 0.214844 27.226562 0.203125 27.277344 0.203125 L 29.148438 0.203125 C 29.25 0.207031 29.347656 0.25 29.421875 0.324219 C 29.492188 0.394531 29.535156 0.492188 29.539062 0.59375 L 29.539062 12.0625 L 34.726562 12.0625 C 34.832031 12.0625 34.929688 12.105469 35 12.175781 C 35.074219 12.25 35.113281 12.347656 35.113281 12.453125 L 35.113281 14.125 C 35.113281 14.226562 35.074219 14.324219 35 14.398438 C 34.929688 14.46875 34.832031 14.511719 34.726562 14.511719 L 27.277344 14.511719 C 27.226562 14.511719 27.175781 14.5 27.128906 14.480469 C 27.082031 14.460938 27.039062 14.433594 27.003906 14.398438 C 26.96875 14.363281 26.941406 14.320312 26.921875 14.273438 C 26.902344 14.226562 26.890625 14.175781 26.890625 14.125 Z M 26.890625 0.59375 "/>
                            <path style=" stroke:none;fill-rule:nonzero;fill:rgb(0.784314%,27.058824%,93.333333%);fill-opacity:1;" d="M 38.207031 0.59375 C 38.207031 0.542969 38.214844 0.492188 38.234375 0.445312 C 38.253906 0.398438 38.285156 0.355469 38.320312 0.320312 C 38.355469 0.28125 38.398438 0.253906 38.445312 0.234375 C 38.492188 0.214844 38.542969 0.203125 38.59375 0.203125 L 46.875 0.203125 C 46.980469 0.207031 47.078125 0.246094 47.148438 0.320312 C 47.222656 0.390625 47.261719 0.492188 47.261719 0.59375 L 47.261719 2.265625 C 47.261719 2.371094 47.222656 2.46875 47.148438 2.542969 C 47.078125 2.613281 46.976562 2.65625 46.875 2.65625 L 40.851562 2.65625 L 40.851562 6.011719 L 45.878906 6.011719 C 45.980469 6.011719 46.078125 6.054688 46.152344 6.125 C 46.222656 6.199219 46.265625 6.296875 46.269531 6.398438 L 46.269531 8.097656 C 46.265625 8.199219 46.226562 8.300781 46.152344 8.371094 C 46.082031 8.445312 45.984375 8.484375 45.878906 8.484375 L 40.851562 8.484375 L 40.851562 12.058594 L 46.875 12.058594 C 46.980469 12.058594 47.078125 12.101562 47.148438 12.171875 C 47.222656 12.246094 47.261719 12.34375 47.261719 12.445312 L 47.261719 14.125 C 47.261719 14.226562 47.222656 14.324219 47.148438 14.398438 C 47.078125 14.46875 46.976562 14.511719 46.875 14.511719 L 38.59375 14.511719 C 38.492188 14.511719 38.390625 14.46875 38.320312 14.398438 C 38.246094 14.324219 38.207031 14.226562 38.207031 14.125 Z M 38.207031 0.59375 "/>
                            <path style=" stroke:none;fill-rule:nonzero;fill:rgb(0.784314%,27.058824%,93.333333%);fill-opacity:1;" d="M 49.941406 0.738281 C 49.910156 0.679688 49.898438 0.613281 49.898438 0.550781 C 49.902344 0.484375 49.921875 0.421875 49.957031 0.367188 C 49.992188 0.3125 50.042969 0.269531 50.101562 0.238281 C 50.160156 0.210938 50.226562 0.199219 50.289062 0.203125 L 52.363281 0.203125 C 52.4375 0.203125 52.507812 0.226562 52.570312 0.265625 C 52.628906 0.304688 52.679688 0.359375 52.707031 0.425781 L 56.617188 9.21875 L 56.757812 9.21875 L 60.660156 0.425781 C 60.691406 0.359375 60.738281 0.300781 60.800781 0.261719 C 60.863281 0.222656 60.933594 0.199219 61.007812 0.199219 L 63.082031 0.199219 C 63.148438 0.195312 63.214844 0.207031 63.269531 0.234375 C 63.328125 0.265625 63.378906 0.308594 63.414062 0.363281 C 63.449219 0.417969 63.46875 0.480469 63.472656 0.546875 C 63.476562 0.609375 63.460938 0.675781 63.429688 0.734375 L 57.121094 14.484375 C 57.089844 14.554688 57.042969 14.613281 56.980469 14.652344 C 56.917969 14.691406 56.847656 14.710938 56.773438 14.710938 L 56.570312 14.710938 C 56.496094 14.714844 56.425781 14.691406 56.363281 14.652344 C 56.300781 14.613281 56.253906 14.554688 56.226562 14.484375 Z M 49.941406 0.738281 "/>
                            <path style=" stroke:none;fill-rule:nonzero;fill:rgb(0.784314%,27.058824%,93.333333%);fill-opacity:1;" d="M 78.4375 0.367188 C 78.441406 0.269531 78.484375 0.175781 78.558594 0.105469 C 78.628906 0.0390625 78.726562 0 78.824219 0 L 79.332031 0 L 87.796875 9.03125 L 87.816406 9.03125 L 87.816406 0.59375 C 87.816406 0.542969 87.828125 0.492188 87.847656 0.445312 C 87.863281 0.398438 87.894531 0.355469 87.929688 0.320312 C 87.964844 0.28125 88.007812 0.253906 88.054688 0.234375 C 88.101562 0.214844 88.152344 0.203125 88.203125 0.203125 L 90.074219 0.203125 C 90.175781 0.207031 90.273438 0.25 90.34375 0.324219 C 90.417969 0.394531 90.460938 0.492188 90.460938 0.59375 L 90.460938 14.347656 C 90.457031 14.449219 90.414062 14.542969 90.34375 14.609375 C 90.269531 14.679688 90.175781 14.714844 90.074219 14.714844 L 89.585938 14.714844 L 81.085938 5.335938 L 81.0625 5.335938 L 81.0625 14.125 C 81.0625 14.175781 81.054688 14.226562 81.035156 14.273438 C 81.015625 14.320312 80.988281 14.363281 80.953125 14.398438 C 80.914062 14.433594 80.871094 14.460938 80.824219 14.480469 C 80.777344 14.5 80.730469 14.511719 80.679688 14.511719 L 78.824219 14.511719 C 78.722656 14.507812 78.628906 14.464844 78.554688 14.394531 C 78.484375 14.320312 78.441406 14.226562 78.4375 14.125 Z M 78.4375 0.367188 "/>
                            <path style=" stroke:none;fill-rule:nonzero;fill:rgb(0.784314%,27.058824%,93.333333%);fill-opacity:1;" d="M 96.695312 2.660156 L 93.582031 2.660156 C 93.53125 2.660156 93.480469 2.648438 93.433594 2.628906 C 93.386719 2.609375 93.34375 2.578125 93.308594 2.542969 C 93.273438 2.507812 93.246094 2.464844 93.226562 2.417969 C 93.207031 2.367188 93.195312 2.316406 93.195312 2.265625 L 93.195312 0.59375 C 93.195312 0.542969 93.207031 0.492188 93.226562 0.445312 C 93.246094 0.398438 93.273438 0.355469 93.308594 0.320312 C 93.34375 0.28125 93.386719 0.253906 93.433594 0.234375 C 93.480469 0.214844 93.53125 0.203125 93.582031 0.203125 L 102.476562 0.203125 C 102.582031 0.203125 102.679688 0.246094 102.753906 0.320312 C 102.824219 0.390625 102.867188 0.492188 102.867188 0.59375 L 102.867188 2.265625 C 102.867188 2.371094 102.824219 2.46875 102.753906 2.542969 C 102.679688 2.613281 102.582031 2.65625 102.476562 2.65625 L 99.363281 2.65625 L 99.363281 14.125 C 99.359375 14.226562 99.320312 14.324219 99.246094 14.394531 C 99.175781 14.46875 99.078125 14.507812 98.976562 14.511719 L 97.082031 14.511719 C 96.980469 14.507812 96.886719 14.46875 96.8125 14.394531 C 96.742188 14.324219 96.699219 14.226562 96.695312 14.125 Z M 96.695312 2.660156 "/>
                            <path style=" stroke:none;fill-rule:nonzero;fill:rgb(92.941176%,17.647059%,14.117647%);fill-opacity:1;" d="M 75.8125 13.980469 L 69.546875 0.226562 C 69.519531 0.15625 69.472656 0.09375 69.40625 0.0546875 C 69.34375 0.015625 69.269531 -0.00390625 69.195312 0 L 68.992188 0 C 68.917969 0 68.847656 0.0195312 68.785156 0.0585938 C 68.722656 0.101562 68.675781 0.15625 68.648438 0.226562 L 62.316406 13.980469 C 62.285156 14.039062 62.269531 14.101562 62.273438 14.167969 C 62.277344 14.230469 62.296875 14.292969 62.332031 14.347656 C 62.367188 14.402344 62.417969 14.445312 62.476562 14.476562 C 62.53125 14.503906 62.597656 14.515625 62.660156 14.511719 L 64.433594 14.511719 C 64.5625 14.515625 64.6875 14.476562 64.792969 14.402344 C 64.902344 14.328125 64.980469 14.222656 65.023438 14.101562 L 69.015625 5.132812 L 69.074219 5.132812 L 73.105469 14.101562 C 73.246094 14.386719 73.386719 14.511719 73.695312 14.511719 L 75.46875 14.511719 C 75.53125 14.515625 75.597656 14.503906 75.65625 14.472656 C 75.710938 14.445312 75.761719 14.402344 75.796875 14.347656 C 75.832031 14.292969 75.851562 14.230469 75.855469 14.167969 C 75.855469 14.101562 75.839844 14.039062 75.8125 13.980469 Z M 75.8125 13.980469 "/>
                        </g>
                    </svg>
                    <sub>informer</sub>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                        <li class="nav-item">
                            <a class="nav-link" href="{{route('informer.index')}}">Проекты</a>
                        </li>
                        @role('admin')
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('roles.index')}}">Роли</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('users.index')}}">Трудоголики</a>
                        </li>
                        @endrole
                        <li class="nav-item">
                            <a target="_blank" class="nav-link yandex-disc-link" href="https://disk.yandex.ru/d/OZZO27K5_sT6jw">Скачать расширение</a>
                        </li>

                    </ul>
                    <form action="/search/">
                        <div class="input-group input-group-sm">
                            <input type="text" class="form-control" placeholder="Ищем пост" name="q" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                            <button class="btn btn-sm btn-outline-secondary" type="submit" id="button-addon1">Ищем</button>
                        </div>
                    </form>
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
{{--                            @if (Route::has('login'))--}}
{{--                                <li class="nav-item">--}}
{{--                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>--}}
{{--                                </li>--}}
{{--                            @endif--}}

{{--                            @if (Route::has('register'))--}}
{{--                                <li class="nav-item">--}}
{{--                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>--}}
{{--                                </li>--}}
{{--                            @endif--}}
                        @else
                            @include('user.notification')
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown"  class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                    <a href="#" class="dropdown-item"  onclick="getModalForm('{{route('users.edit', Auth::user()->id)}}');return false;">
                                        Редактировать
                                    </a>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
{{--        @foreach(Auth::user()->unreadNotifications as $notification)--}}
{{--            @php--}}
{{--                dd($notification->data)--}}
{{--            @endphp--}}
{{--        @endforeach--}}

            @include('layouts.messages')
            <main class="py-4">
            <div class="container">
                @if(!isset($login))
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="col  d-flex align-content-center justify-content-between align-items-center">
                                    <h4 class="my-0 col-lg-10">{{ __($title) }}</h4>
                                    <span class="buttons col-lg-2 ">
                                        @if(isset($createButtonRoute))
                                            @if($createButtonRoute == 'post.create')
                                                <div class="btn-group float-end">
                                                    <button onclick="getModalForm('{{route($createButtonRoute, $project_id ?? null)}}', true)" type="button" class="btn btn-sm btn-secondary post-create-button">Добавить</button>
                                                    <button type="button" class="btn btn-sm btn-danger dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <span class="visually-hidden">Выпадашка</span>
                                                    </button>
                                                    @include('project.dropdownButtons')
                                                </div>
                                            @else
                                                <button onclick="getModalForm('{{route($createButtonRoute, $project_id ?? null).'?'.Request::getQueryString()}}')" type="button" class="btn btn-sm btn-secondary float-end">Добавить</button>
                                            @endif
                                        @endif
                                    </span>
                                </div>
                                @if(isset($project_description))
                                    <div class="col">
                                        <span class="col-lg-12"><p class="mb-0">{{$project_description}}</p></span>
                                    </div>
                                @endif
                                @if(isset($createButtonRoute))
                                    @if($createButtonRoute == 'post.create')
                                        @include('planfix.allAccounts')

                                    @endif
                                @endif
                            </div>
                            <div class="card-body p-1">
                            @endif
                                @yield('content')
                            @if(!isset($login))
                            </div>
                        </div>
                    </div>
                </div>
                @endif

            </div>
        </main>
        <div class="modal fade {{$modalClass ?? ''}}" id="ModalForm">
            <div class="modal-dialog">
                <div id="modalContent" class="modal-content">

                </div>
            </div>
        </div>
        <div class="modal fade modal-lg" id="imageZoom">
            <div class="modal-dialog" id="imageZoom_wrapper">

            </div>
        </div>
        <div class="modal fade" id="ModalFormDel">
            <div class="modal-dialog">
                <div id="modalContent" class="modal-content">

                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Точно?</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Нет, ты серьезно?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="btnNo" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Передумал</button>
                        <button type="button" id="btnYes" class="btn btn-sm btn-danger">Точно</button>
                    </div>

                </div>
            </div>
        </div>
{{--        {{dump(session('status'))}}--}}
{{--        @if (session('status'))--}}
{{--            <div class="alert alert-success" role="alert">--}}
{{--                {{ session('status') }}--}}
{{--            </div>--}}
{{--            --}}{{--                                    {{Session::forget('status')}}--}}
{{--        @endif--}}
        <div class="toast-container position-fixed top-0 end-0 p-3">
            <div id="toast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header bg-success text-light">
                    <strong class="me-auto">Сохранено</strong>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    Ваше обращение очень важно для вас!
                    <div id="countdown">
                        <div id="countdown-number"></div>
                        <svg>
                            <circle r="10" cx="12" cy="12">
                        </svg>
                    </div>
                </div>
            </div>
        </div>
        <div class="toast-container position-fixed top-0 end-0 p-3">
            <div id="FlashTost" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header bg-success text-light">
                    <strong class="me-auto">Выполнено</strong>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    Что вы наделали? Сделано!
                </div>
            </div>
        </div>
    </div>
    @if(Auth::user())
        @include('user.notificationOffcanvas')
    @endif
{{--    <script  src="{{asset('js/ckeditor5/ckeditor.js')}}"></script>--}}
</body>
</html>
