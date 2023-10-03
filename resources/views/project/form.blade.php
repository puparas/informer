
<div class="modal-header">
    <h1 class="modal-title fs-5" id="exampleModalLabel">Создание/редактирование проекта</h1>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <div id="errors"></div>
    <form onsubmit="submitForm(this, '{{ isset($project) ? route('informer.update', $project->id) : route('informer.store') }}'); return false;" >
        {{ isset($project) ? method_field('put') : '' }}
        <input hidden type="text" name="id" value="{{$project->id ?? ''}}">
        <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Название:</label>
            <input required type="text" value="{{$project->title ?? ''}}" name="title" class="form-control" id="recipient-name">
        </div>
        <div class="mb-3">
            <label for="message-text" class="col-form-label">URL проекта:</label>
            <input value="{{$project->url ?? null ? $project->url : ($domain ?? '') }}" required pattern="[Hh][Tt][Tt][Pp][Ss]?:\/\/(?:(?:[a-zA-Z\u00a1-\uffff0-9]+-?)*[a-zA-Z\u00a1-\uffff0-9]+)(?:\.(?:[a-zA-Z\u00a1-\uffff0-9]+-?)*[a-zA-Z\u00a1-\uffff0-9]+)*(?:\.(?:[a-zA-Z\u00a1-\uffff]{2,}))(?::\d{2,5})?(?:\/[^\s]*)?(?::\d{2,5})?(?:\/[^\s]*)?" type="url" placeholder="Например https://example.com/"  name="url" class="form-control" id="recipient-name">
        </div>
        <div class="mb-3">
            <label for="message-text" class="col-form-label">Короткое описание (100 смвлв):</label>
            <div class="form-floating">
                <textarea maxlength="100" name="description" placeholder="Максимум 100 символов" class="form-control" id="floatingTextarea">{{$project->description ?? null}}</textarea>
                <label for="floatingTextarea"></label>
            </div>
        </div>
        <div class="mb-3">
            <label for="message-text" class="col-form-label">Пользователи:</label>
            <select required class="form-select" name="users[]" multiple aria-label="multiple select example">
                @foreach($users as $user)
                    <option {{ ($project->users ?? null ? ($project->users->pluck('id')->contains($user->id) ? 'selected' : '') : '') }} {{isset($curUser) ? ($curUser->id == $user->id ? 'selected' : '' ) : '' }} value="{{$user->id}}">{{$user->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-sm btn-primary">Сохранить</button>
        </div>
    </form>
</div>
