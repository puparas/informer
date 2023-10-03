@php
    $colors = [
        'not yet checked' => ['secondary', 'еще не проверялось'],
        'success' => ['success', 'Успешно'],
        'failed' => ['danger', 'Ошибка'],
        'off' => ['secondary', 'Выключено']
    ];
@endphp

<div class="modal-header">
    <h1 class="modal-title fs-5" id="exampleModalLabel">Результаты мониторинга ( {{$monitor->name}} )</h1>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <div class="container text-center">
        <div class="row">
            @foreach($checks as $type => $check)
                <div class="col-6 ">
                    <div class="border m-1 border-1 border-opacity-75 rounded">
                        @if($check->enabled && $check->last_ran_at)
                            <div class="">
                                <label  class="form-check-label popover__wrapper " for="bitrix_check">
                                    <span class="popover__title"><a target="_blank" href="https://disk.yandex.ru/d/a1e_KYCz9Ze0ug"><p class="mb-1">Последняя проверка: {{$check?->last_ran_at?->format('d/n/Y H:i')}}</p></a></span>
                                    <div class="popover__content">
                                        <p class="popover__message ">{{json_encode($check->last_run_output)}}</p>
                                    </div>
                                </label>

                            </div>
                        @endif
                        <button type="button" class="mt-3 mb-3 btn btn-Light position-relative border-1 border-dark">
                            {{__($type)}}
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-{{$colors[$check->enabled ? $check->status : 'off'][0]}}">
                                {{$colors[$check->enabled ? $check->status : 'off'][1]}}
                                <span class="visually-hidden"></span>
                            </span>
                        </button>
                        <div class="col">
                            <div class="col-12">
                                @if($type == 'diskspace' && $check->status == 'success' && $check->enabled)
                                    <div class="">
                                        <p class="mb-1">Занято {{str_replace('usage at ', '', $check->last_run_message)}}</p>
                                    </div>
                                @endif
                                @if($type == 'bitrix' && $check->enabled)
                                    @if($check->status == 'failed')
                                        <label  class="form-check-label popover__wrapper " for="bitrix_check">
                                            Возможно
                                            <span class="popover__title"><a target="_blank" href="https://disk.yandex.ru/d/a1e_KYCz9Ze0ug">(требуется доработка)</a></span>
                                            <div class="popover__content">
                                                <p class="popover__message">{{__('informer_page_tooltip')}}</p>
                                            </div>
                                        </label>
                                    @elseif($check->status == 'success')
                                        <div class="">
                                            @foreach(json_decode($check->last_run_message) as $key => $value)
                                                @if($key != 'absolute_dir_path')
                                                    <p class="mb-1">{{__($key)}} : {{$value}}</p>
                                                @endif
                                            @endforeach
                                        </div>
                                    @endif
                                @endif
                                @if($type == 'ssl' && $check->status == 'success' && $check->enabled)
                                    <div class="">
                                        @foreach(json_decode($check->last_run_message) as $key => $value)
                                            <p class="mb-1">{{__($key)}} : {{$value}}</p>
                                        @endforeach
                                    </div>
                                @endif
                                @if($type == 'search' && $check->status == 'success' && $check->enabled)
                                    <div class="">
                                        @foreach(json_decode($check->last_run_message) as $key => $value)
                                            <p class="mb-1">искали : нашли</p>
                                            <p class="mb-1">{{$value[0]}} : {{$value[1]}}</p>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>

                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

