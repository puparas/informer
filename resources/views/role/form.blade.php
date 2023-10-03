
<div class="modal-header">
    <h1 class="modal-title fs-5" id="exampleModalLabel">Создание/редактирование роли</h1>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <div id="errors"></div>
    <form onsubmit="submitForm(this, '{{ isset($role) ? route('roles.update', $role->id) : route('roles.store') }}'); return false;" >
        {{ isset($role) ? method_field('put') : '' }}
        <input hidden type="text" name="id" value="{{$role->id ?? ''}}">
        <div class="row">
            <div class="col-md-6">
                <label for="recipient-name" class="col-form-label">Название:</label>
                <input required type="text" value="{{$role->name ?? ''}}" name="name" class="form-control" id="recipient-name">
            </div>
            <div class="col-md-6">
                <label for="message-text" class="col-form-label">Код:</label>
                <input required type="text" value="{{$role->slug ?? ''}}" name="slug" class="form-control" id="recipient-name">
            </div>
        </div>
        <div class="mb-3">
            <label for="message-text" class="col-form-label">Доступ к отделу:</label>
            <select required class="form-select" name="permissions[]" multiple aria-label="multiple select example">
            @foreach($perms as $perm)
                    <option {{ ($role->permissions ?? null ? ($role->permissions->pluck('id')->contains($perm->id) ? 'selected' : '') : '') }} value="{{$perm->id}}">{{__($perm->name)}}</option>
            @endforeach
            </select>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-sm btn-primary">Сохранить</button>
        </div>
    </form>
</div>
