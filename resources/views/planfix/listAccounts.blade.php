@if($data['bitrix']["directoryEntries"] || $data['sftp']["directoryEntries"])
    @if(isset($data['bitrix']["directoryEntries"]))
        @foreach($data['bitrix']["directoryEntries"] as $key => $account)
            <div class="col mb-1">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">CMS</h5>
                        <h6 class="card-subtitle mb-2 text-muted">{{$account["customFieldData"][1]["field"]["name"]}}:
                            <b>{{$account["customFieldData"][1]["stringValue"]}}</b></h6>
                        <h6 class="card-subtitle mb-2 text-muted">{{$account["customFieldData"][2]["field"]["name"]}}:
                            <b>{{$account["customFieldData"][2]["stringValue"]}}</b></h6>
                        <h6 class="card-subtitle mb-2 text-muted">{{$account["customFieldData"][3]["field"]["name"]}}:
                            <b>{{$account["customFieldData"][3]["stringValue"]}}</b></h6>
                        <a target="_blank" href="https://{{$url}}/bitrix/">На страницу логина</a>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
    @if(isset($data['sftp']["directoryEntries"]))
        @foreach($data['sftp']["directoryEntries"] as $key => $account)
            @php
            $winscpUrl = "sftp://" . $account["customFieldData"][2]["stringValue"] . ":" . $account["customFieldData"][3]["stringValue"] . "@" . $account['customFieldData'][1]['stringValue'] . "/";
            @endphp
            <div class="col mb-1">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">SFTP</h5>
                        <h6 class="card-subtitle mb-2 text-muted">{{$account["customFieldData"][1]["field"]["name"]}}:
                            <b>{{$account["customFieldData"][1]["stringValue"]}}</b></h6>
                        <h6 class="card-subtitle mb-2 text-muted">{{$account["customFieldData"][2]["field"]["name"]}}:
                            <b>{{$account["customFieldData"][2]["stringValue"]}}</b></h6>
                        <h6 class="card-subtitle mb-2 text-muted">{{$account["customFieldData"][3]["field"]["name"]}}:
                            <b>{{$account["customFieldData"][3]["stringValue"]}}</b></h6>
                        <label  class="form-check-label popover__wrapper " for="">
                            <a href="{{$winscpUrl}}">Подключиться в WinSCP</a>
                            <div class="popover__content">
                                <p class="popover__message">{!! __('winscp_settings') !!}</p>
                            </div>
                        </label>
                        <br>
                        <label  class="form-check-label popover__wrapper " for="">
                            <a href="{{$winscpUrl}};save">Сохранить в WinSCP</a>
                            <div class="popover__content">
                                <p class="popover__message">{!! __('winscp_settings') !!}</p>
                            </div>
                        </label>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
@else
    <p class="mb-0">Не найдено записей по домену. Добавь если у тебя они есть!</p>
@endif
