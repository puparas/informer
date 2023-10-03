
<div class="modal-header">
    <h1 class="modal-title fs-5" id="exampleModalLabel">Редактирование параметров мониторинга</h1>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <div id="errors"></div>
    <label  class="form-check-label popover__wrapper " for="">
        <p class="text-primary">Как заполнять? Навести для краткой информации.</p>
        <div class="popover__content">
            <p class="popover__message">{{__('informer_monitoring_how')}}</p>
        </div>
    </label>
    <form onsubmit="submitForm(this, '{{ isset($monitor) ? route('monitoring.update', $monitor->id) : route('monitoring.store') }}'); return false;" >
        {{ isset($monitor) ? method_field('put') : '' }}
        <input hidden type="text" name="id" value="{{isset($project) ? $project->id : $monitor->id}}">
        <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Домен проекта:</label>
            <input readonly required type="text" value="{{$projecrUrlWithoutSchema}}" name="name" class="form-control" >
        </div>
        <div class="mb-3 sftpaccount {{!isset($monitor) ? '' : 'newConnectHide'}}">
            <button onclick="getSftpAccount('{{$projecrUrlWithoutSchema}}', '{{route('informer.getsftpaccount')}}')" type="button" class="btn btn-sm btn-secondary">
                <span class="spinner-grow spinner-grow-sm spinner-grow-hide" role="status" aria-hidden="true"></span>
                Найти доступы в Planfix
            </button>
        </div>
        <div class="input-group mb-3">
            <label for="recipient-name" class="d-block w-100 col-form-label">Данные для ssh подключения:</label>
            <input required type="text" value="{{$monitor->ssh_user ?? ''}}" class="form-control ssh_user" name="ssh_user" placeholder="ssh user" aria-label="Username">
            <span class="input-group-text">@</span>
            <input required pattern="^((\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.){3}(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])$" type="text" class="form-control ssh_ip" value="{{$monitor->ip ?? ''}}" name="ip" placeholder="Server ip" aria-label="Server">
        </div>
        <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Порт ssh (22):</label>
            <input required type="number" value="{{$monitor->port ?? '22'}}" name="port" class="form-control" >
        </div>
        <div class="mb-3 {{!isset($monitor) ? '' : 'newConnectHide'}}">
            <label for="recipient-name" class="col-form-label">Пароль:</label>
            <input type="text" value="" name="password" class="form-control password">
        </div>
        <div class="mb-3">
            <button onclick="checkSshConnection(this, '{{route('monitoring.checkSshConnection', $monitor->id ?? null)}}')" type="button" class="btn btn-sm btn-danger">
                <span class="spinner-grow spinner-grow-sm spinner-grow-sshcheck-hide" role="status" aria-hidden="true"></span>
                Проверить подключение
            </button>
        </div>
        <div class="form-check">
            <input {{isset($monitor) ? ((isset($ckecks['mysql']) && $ckecks['mysql']) ? 'checked' : '') : ''}}  class="form-check-input" name="mysql" type="checkbox" value="Y" id="mysql_check">
            <label class="form-check-label" for="mysql_check">
                Проверять работу Myslq
            </label>
        </div>
        <div class="form-check">
            <input {{isset($monitor) ? ((isset($ckecks['diskspace']) && $ckecks['diskspace']) ? 'checked' : '') : ''}} class="form-check-input" name="diskspace" type="checkbox" value="Y" id="disk_space_check">
            <label class="form-check-label" for="disk_space_check">
                Проверять оставшееся место на хостинге
            </label>
        </div>
        <div class="form-check">
            <input {{isset($monitor) ? ((isset($ckecks['ssl']) && $ckecks['ssl']) ? 'checked' : '') : ''}} class="form-check-input" name="ssl" type="checkbox" value="Y" id="ssl_check">
            <label class="form-check-label" for="ssl_check">
                Проверять SSL сертификат
            </label>
        </div>
        <div class="form-check mb-3">
            <input {{isset($monitor) ? ((isset($ckecks['bitrix']) && $ckecks['bitrix']) ? 'checked' : '') : ''}} class="form-check-input" name="bitrix" type="checkbox"id="bitrix_check">
            <label  class="form-check-label popover__wrapper" for="bitrix_check">
                Собирать данные о движке
                <span class="popover__title"><a target="_blank" href="https://disk.yandex.ru/d/a1e_KYCz9Ze0ug">(требуется доработка разработчиком)</a></span>
                <div class="popover__content">
                    <p class="popover__message">{!! __('informer_page_tooltip') !!}</p>
                </div>
            </label>
        </div>
        <div class="mb-3 search_block">
            <input
                {{isset($monitor) ? ((isset($ckecks['search']) && $ckecks['search'] && !empty($monitor?->checks->keyBy('type')["search"]["custom_properties"])) ? 'checked' : '') : ''}}
                {{empty($monitor?->checks->keyBy('type')["search"]["custom_properties"]) ? 'onchange=switchIputs(`search`)' : ''}}
                class="form-check-input" name="search" type="checkbox" value="Y" id="search_check">
            <label  class="form-check-label popover__wrapper" for="search_check">
                <span class="popover__title">
                    <p class="text-primary mb-0">Поиск текста на странице</p>
                </span>
                <div class="popover__content">
                    <p class="popover__message">{{__("search_tip")}}</p>
                </div>
            </label>
            @if(!empty($monitor?->checks->keyBy('type')["search"]["custom_properties"]))
                @foreach($monitor->checks->keyBy('type')["search"]["custom_properties"]["search_url"] as $key => $value)
                    <div class="input-group search mb-3">
                        <input required type="text" name="search_url[]" value="{{$value}}" class="form-control" placeholder="На странице" >
                        <span class="input-group-text">ищем</span>
                        <input required type="text" name="search_text[]" value="{{$monitor->checks->keyBy('type')["search"]["custom_properties"]["search_text"][$key]}}" class="form-control" placeholder="лупу, пупу">
                        @if($loop->last)
                            <button onclick="addSearchInputs(this)" type="button" class="btn btn-primary ">+</button>
                        @else
                            <button onclick="removeSearchInputs(this)" type="button" class="btn btn-danger ">-</button>
                        @endif
                    </div>
                @endforeach
            @else
                <div class="input-group mb-3 search hide">
                    <input disabled type="text" name="search_url[]" value="" class="form-control" placeholder="На странице" >
                    <span class="input-group-text">ищем</span>
                    <input disabled type="text" name="search_text[]" class="form-control" placeholder="лупу, пупу">
                    <button onclick="addSearchInputs(this)" type="button" class="btn btn-primary ">+</button>
                </div>
            @endif
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-sm btn-primary">Сохранить</button>
        </div>
    </form>
</div>

