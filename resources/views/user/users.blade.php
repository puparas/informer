@extends('layouts.app', ['title' => 'Пользователи', 'createButtonRoute' => 'users.create'])

@section('content')
    <table class="table table-striped">
        <thead>
        <tr>
            <th class="col Width 25%">Имя</th>
            <th class="col Width 25%">email</th>
            <th class="col Width 25%">Роли</th>
            <th class="Width 25%" scope="col"></th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>{{implode(', ', $user->roles->pluck('name')->toArray())}}</td>
                <td>
                    <div class="btn-group float-end">
                        <button onclick="getModalForm('{{route('users.edit', $user->id)}}')" type="button" class="btn btn-sm btn-secondary">Редактировать</button>
                        <button type="button" class="btn btn-sm btn-danger dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
                            <span class="visually-hidden">Выпадашка</span>
                        </button>
                        <ul class="dropdown-menu p-0">
                            <li><a href="#" onclick="dialog('{{route('users.destroy', $user->id)}}')" class="dropdown-item" >Удалить</a></li>
                        </ul>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
