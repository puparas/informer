<div class="text-center text-light bg-danger col-md-12">{{__("sensitive_danger_text")}}</div>
@if(Hash::check('relevant', Auth::user()?->password))
    <div class="text-center text-dark bg-warning col-md-12">{{__("change_password_request")}}
        <a onclick="getModalForm('{{route('users.edit', Auth::user()->id)}}');return false;" href="#">Поменяйте пароль!</a>
    </div>
@endif
