@extends('layouts.app', ['title' => 'Роли', 'createButtonRoute' => 'roles.create'])
@section('content')
<table class="table table-striped">
    <thead>
    <tr>
        <th class="col Width 25%">Название</th>
        <th class="col Width 25%">Код</th>
        <th class="col Width 25%">Разрешения</th>
        <th class="Width 25%" scope="col"></th>
    </tr>
    </thead>
    <tbody>
    @foreach($roles as $role)
        <tr>
            <td>{{$role->name}}</td>
            <td>{{$role->slug}}</td>
            <td>{{implode(', ', $role->permissions->pluck('name')->toArray())}}</td>
            <td>
                <div class="btn-group float-end">
                    <button onclick="getModalForm('{{route('roles.edit', $role->id)}}')" type="button" class="btn btn-sm btn-secondary">Редактировать</button>
                    <button type="button" class="btn btn-sm btn-danger dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="visually-hidden">Выпадашка</span>
                    </button>
                    <ul class="dropdown-menu p-0">
                        <li><a href="#" onclick="dialog('{{route('roles.destroy', $role->id)}}')" class="dropdown-item" >Удалить</a></li>
                    </ul>
                </div>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
@endsection
