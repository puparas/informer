
<div class="modal-header">
    <h1 class="modal-title fs-5" id="exampleModalLabel">Создание/редактирование заметки</h1>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <div id="errors"></div>
    <form onsubmit="submitForm(this, '{{ isset($post) ? route('post.update', $post->id) : route('post.store') }}'); return false;" >
        {{ isset($post) ? method_field('put') : '' }}
        <input hidden type="text" name="user_id" value="{{$user->id ?? ''}}">
        <input hidden type="text" name="project_id" value="{{($post->project_id ?? null) ?? $project->id}}">
        <input hidden type="text" name="id" value="{{$post->id ?? ''}}">
        <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Название:</label>
            <input required type="text" value="{{$post->title ?? ''}}" name="title" class="form-control" id="recipient-name">
        </div>
        <div class="mb-3">
            <label for="message-text" class="col-form-label">Заметка:</label>
            <div class="form-floating">
                <textarea id="content" name="content" cols="30" rows="10">
                    {{$post->content ?? null}}
                </textarea>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="message-text" class="col-form-label">Приоритет:</label>
                <select required class="form-select" name="priority" aria-label="multiple select example">
                    <option {{ ($post->priority ?? null ? ($post->priority == 1 ? 'selected' : '') : '') }}  value="1">Обычный</option>
                    <option {{ ($post->priority ?? null ? ($post->priority == 2 ? 'selected' : '') : '') }} value="2">Средний</option>
                    <option {{ ($post->priority ?? null ? ($post->priority == 3 ? 'selected' : '') : '') }} value="3">Высокий</option>
                </select>
            </div>
            <div class="col-md-6">
                <label for="message-text" class="col-form-label">Отдел:</label>
                <select required class="form-select" name="role_id" aria-label="multiple select example">
                    <option value="666">Личная</option>
                    @foreach($user->roles as $role)
                        <option id="hide_{{$role->slug}}" {{ ($post->role_id ?? null ? ($post->role_id == $role->id ? 'selected' : '') : ($curTab == $role->slug ? 'selected' : '')) }} value="{{$role->id}}">{{$role->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-sm btn-primary">Сохранить</button>
        </div>
    </form>
</div>
