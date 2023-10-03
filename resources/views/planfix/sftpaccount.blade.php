
@if($data["directoryEntries"])
    <select onchange="sshAccountSelect(this)" class="form-select form-select-sm " aria-label=".form-select-sm example">
        <option selected>Выберите какие доступы использовать</option>
    @foreach($data["directoryEntries"] as $key => $account)
            <option data-pass="{{$account["customFieldData"][3]["stringValue"]}}"
                    data-login="{{$account["customFieldData"][2]["stringValue"]}}"
                    data-ip="{{$account["customFieldData"][1]["stringValue"]}}"
                    value="{{$key}}">
                {{$account["customFieldData"][1]["field"]["name"]}}:
                 {{$account["customFieldData"][1]["stringValue"]}} \
                {{$account["customFieldData"][2]["field"]["name"]}}:
                 {{$account["customFieldData"][2]["stringValue"]}} \
                {{$account["customFieldData"][3]["field"]["name"]}}:
                 {{$account["customFieldData"][3]["stringValue"]}}
            </option>
    @endforeach

    </select>
@else
    <p>Не найдено записей по домену. Добавь если у тебя они есть!</p>
@endif
