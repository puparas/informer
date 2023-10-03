<button onclick="getAllAccounts('{{$projecrUrlWithoutSchema}}', '{{route('informer.getallaccounts')}}')" class="btn btn-secondary btn-sm mb-1 mt-1" type="button" data-bs-toggle="collapse" data-bs-target=".multi-collapse" aria-expanded="false" aria-controls="multiCollapseExample1 multiCollapseExample2">
    <span class="spinner-grow spinner-grow-sm spinner-grow-hide" role="status" aria-hidden="true"></span>
    Доступы из ПФ</button>
<div class="row">
    <div class="col">
        <div class="collapse multi-collapse" id="multiCollapseExample1">
            <div class="card card-body">
                <div class="row allaccounts"></div>
            </div>
        </div>
    </div>
</div>
