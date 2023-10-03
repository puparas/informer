
<div class="modal-header">
    <h1 class="modal-title fs-5" id="exampleModalLabel">Создание/редактирование пользователя</h1>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <div id="errors"></div>
    <form onsubmit="submitForm(this, '{{ isset($user) ? route('users.update', $user->id) : route('users.store') }}'); return false;" >
        {{ isset($user) ? method_field('put') : '' }}
        <input hidden type="text" name="id" value="{{$user->id ?? ''}}">
        <div class="row">
            <div class="col-md-6">
                <label for="recipient-name" class="col-form-label">Nikname:</label>
                <input required type="text" value="{{$user->name ?? ''}}" name="name" class="form-control" id="recipient-name">
            </div>
            <div class="col-md-6">
                <label for="message-text" class="col-form-label">Email:</label>
                <input required type="email" value="{{$user->email ?? ''}}" name="email" class="form-control" id="recipient-name">
            </div>
        </div>
        <div class="mb-3">
            <label for="message-text" class="col-form-label">Пароль:</label>
            <input {{isset($user->id) ? '' : 'required'}} type="password"  name="password" class="form-control" id="recipient-name">
        </div>
        @if(isset($token))
            <div class=" mb-3">
                <label for="message-text" class="col-form-label">Да, это он:</label>
                <div class="input-group">
                    <input readonly type="text" value="{{$token}}" class="form-control" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="button-addon2">
                    <button onclick="copyToClipboard(this)" class="btn btn-sm btn-outline-secondary" type="button" id="button-addon2" data-link="{{$token}}">Взять</button>
                </div>
            </div>
        @endif
        @role('admin')
            <div class="mb-3">
                <label for="message-text" class="col-form-label">Роли:</label>
                <select required class="form-select" name="roles[]" multiple aria-label="multiple select example">
                    @foreach($roles as $role)
                        <option {{ ($user->roles ?? null ? ($user->roles->pluck('id')->contains($role->id) ? 'selected' : '') : '') }} value="{{$role->id}}">{{__($role->name)}}</option>
                    @endforeach
                </select>
            </div>
        @endrole
        <div class="modal-footer">
            <button type="submit" class="btn btn-sm btn-primary">Сохранить</button>
        </div>
    </form>
</div>
