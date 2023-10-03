
<div class="modal-header">
    <h1 class="modal-title fs-5" id="exampleModalLabel">Создание/редактирование комментария</h1>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <div id="errors"></div>
    <form onsubmit="submitForm(this, '{{ isset($comment) ? route('comment.update', $comment->id) : route('comment.store') }}'); return false;" >
        {{ isset($comment) ? method_field('put') : '' }}
        <input hidden type="text" name="user_id" value="{{$user->id ?? ''}}">
        <input hidden type="text" name="post_id" value="{{($comment->post_id ?? null) ?? $post->id}}">
        <input hidden type="text" name="id" value="{{$comment->id ?? ''}}">
        <div class="mb-3">
            <label for="message-text" class="col-form-label">Комментарий:</label>
            <div class="form-floating">
                <textarea maxlength="100" name="comment"  class="form-control" id="floatingTextarea">{{$comment->comment ?? ''}}</textarea>
                <label for="floatingTextarea"></label>
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class=" btn-sm btn btn-primary">Сохранить</button>
        </div>
    </form>
</div>
