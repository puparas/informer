import '../tinymce/tinymce.js';
import {win} from "../tinymce";


window.getModalForm = function (url, getActiveTab = false){
    window.token = document.getElementById('csrf').content;
    if(getActiveTab){
        url = url + '?tab=' + document.querySelector("#myTab .active").id;
    }
    fetch(url).then(function (response) {
        return response.text();
    }).then(function (html) {
        window.myModal = new bootstrap.Modal('#ModalForm', {})
        document.getElementById('modalContent').innerHTML = html;
        editorInit();
        myModal.show()

    }).catch(function (err) {
        // There was an error
        console.warn('Произошло вот такое дерьмо', err);
    });
}
window.notificationRead = function(){
    fetch('/notification-read/', {
        method:'POST',
        headers: {
            'X-CSRF-TOKEN': document.getElementById('csrf').content,
        },
        body: {}
    })
}
window.submitForm = function (form, url, method = 'POST'){
    clearErrors();
    tinymce.triggerSave();
    const data = new FormData(form);
    fetch(url, {
        method: method,
        headers: {
            'X-CSRF-TOKEN': window.token,
        },
        enctype:"multipart/form-data",
        body: data
    }).then(res => res.json())
        .then( async res => {
            if(res.message){
                valedationError(res);
            }else if(res.result = 'success'){
                window.myModal.hide();
                showTost();
                await timeout(3000);
                window.location.href = res.url;
            }
        });
}
window.valedationError = function (errors){
    var errorsPlaceholder = document.getElementById('errors');
    errorsPlaceholder.innerHTML = '';
    for (const [key, value] of Object.entries(errors.message)) {
        var p = document.createElement("p");
        p.classList.add('text-danger', 'my-0')
        p.innerHTML = value;
        errorsPlaceholder.append(p);
    }
}
window.dialog = function(url, method = 'DELETE') {
    window.myModal = new bootstrap.Modal('#ModalFormDel', {});
    window.myModal.show();
    document.getElementById('btnYes').addEventListener('click', e =>{
        // window.myModalDel.hide();
        if(method === 'DELETE') {
            deleteElement(url);
            return;
        }
        restoreElement(url);
    })
    document.getElementById('btnNo').addEventListener('click', e =>{
        window.myModal.hide();
    });
}
window.deleteElement = function (url){
    window.token = document.getElementById('csrf').content;
    var form = document.createElement("form");
    submitForm(form, url, 'DELETE');
}
window.restoreElement = function (url){
    window.token = document.getElementById('csrf').content;
    var form = document.createElement("form");
    submitForm(form, url, 'POST');
}
window.showTost = function (){
    const toast = new bootstrap.Toast(document.getElementById('toast'))
    toast.show()
}
window.showFlashTost = function (){
    const toast = new bootstrap.Toast(document.getElementById('FlashTost'))
    toast.show()
}
window.timeout =  function(ms) {
    counterCircle();
    return new Promise(resolve => setTimeout(resolve, ms));
}

window.editorInit = function () {
    if(tinymce.activeEditor)
        tinymce.activeEditor.destroy();
    if (document.querySelector('#content')){
        tinymce.init({
            selector: 'textarea#content',
            plugins: 'preview importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image  link media template codesample table charmap pagebreak nonbreaking anchor insertdatetime advlist lists wordcount help charmap quickbars emoticons  ',
            editimage_cors_hosts: ['picsum.photos'],
            menubar: '',
            toolbar: 'undo redo | bold italic underline strikethrough |insertfile image link codesample | alignleft aligncenter alignright alignjustify | fontfamily fontsize blocks | outdent indent |  numlist bullist | forecolor backcolor removeformat  | charmap emoticons | fullscreen  ',
            toolbar_sticky: true,
            autosave_ask_before_unload: true,
            autosave_interval: '30s',
            autosave_prefix: 'tinymce-autosave-{path}{query}-{id}-',
            autosave_restore_when_empty: false,
            autosave_retention: '2m',
            image_advtab: true,
            link_list: [
                { title: 'Ссылка на планфикс', value: 'https://relevant.planfix.ru/' },
            ],
            image_class_list: [
                { title: 'Без класса', value: 'zoom' },
                { title: 'Отступы со всех сторон', value: 'zoom m-1' }
            ],
            importcss_append: true,
            image_title: true,
            automatic_uploads: true,
            images_upload_url: '/post/upload?_token='+ window.token,
            file_picker_types: 'image',
            file_picker_callback: function(cb, value, meta) {
                var input = document.createElement('input');
                input.setAttribute('type', 'file');
                input.setAttribute('accept', 'image/*');
                input.onchange = function(e) {
                    const file = e.target.files[0];

                    var reader = new FileReader();
                    reader.readAsDataURL(file);
                    reader.onload = function () {
                        var id = 'blobid' + (new Date()).getTime();
                        var blobCache =  tinymce.activeEditor.editorUpload.blobCache;
                        var base64 = reader.result.split(',')[1];
                        var blobInfo = blobCache.create(id, file, base64);
                        blobCache.add(blobInfo);
                        cb(blobInfo.blobUri(), { title: file.name });
                    };
                };
                input.click();
            },
            height: 300,
            image_caption: true,
            quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
            noneditable_class: 'mceNonEditable',
            toolbar_mode: 'sliding',
            content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:16px }'
        });
        document.addEventListener('focusin', (e) => {
            if (e.target.closest(".tox-tinymce-aux, .moxman-window, .tam-assetmanager-root") !== null) {
                e.stopImmediatePropagation();
            }
        });
    }
}
window.copyToClipboard = function ($el) {
    var link = $el.dataset.link;
    navigator.clipboard.writeText(link).then(() => {
        showFlashTost();
    });
}
window.counterCircle = function (){
    var countdownNumberEl = document.getElementById('countdown-number');
    var countdown = 3;

    countdownNumberEl.textContent = countdown;

    setInterval(function() {
        countdown = --countdown <= 0 ? 3 : countdown;

        countdownNumberEl.textContent = countdown;
    }, 1000);
}
window.checkSshConnection = function (button, url){
    clearErrors();
    window.token = document.getElementById('csrf').content;
    var spinner = document.querySelector('.spinner-grow-sshcheck-hide');
    if(spinner){
        spinner.classList.remove('spinner-grow-sshcheck-hide');
    }

    const data = new FormData(button.closest("form"));
    fetch(url, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': window.token,
        },
        enctype:"multipart/form-data",
        body: data
    }).then(res => res.json())
        .then( async res => {
            if(spinner){
                spinner.classList.add('spinner-grow-sshcheck-hide');
            }
            if(res.success){
                button.classList.remove('btn-danger');
                button.classList.add('btn-success');
            }else if(res.message){
                button.classList.remove('btn-success');
                button.classList.add('btn-danger');
                if(document.querySelector('.passwordHide')) {
                    document.querySelector('.newConnectHide').classList.remove('newConnectHide');
                    document.querySelector('.passwordHide').classList.remove('passwordHide');
                }
                valedationError(res);
            }
        }).catch(function (err) {
            // There was an error
            console.warn('Произошло вот такое дерьмо', err);
        });
}
window.sshAccountSelect = function (account){
    var pass = account.options[account.selectedIndex].dataset.pass;
    var login = account.options[account.selectedIndex].dataset.login;
    var ip = account.options[account.selectedIndex].dataset.ip;
    document.querySelector('.ssh_user').value = login
    document.querySelector('.ssh_ip').value = ip;
    document.querySelector('.password').value = pass;

}
window.getSftpAccount = function (domain, url){
    clearErrors();
    window.token = document.getElementById('csrf').content;
    document.querySelector('.spinner-grow-hide').classList.remove('spinner-grow-hide');
    fetch(url, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': window.token,
        },
        enctype:"text/html",
        body: domain
    }).then(function (res) {
        // The API call was successful!
        return res.text();
    }).then(res => {
            if(res.message) {
                valedationError(res);
            }else{
                document.querySelector('.sftpaccount').innerHTML = res;
            }
        })
}
window.getAllAccounts = function (domain, url){
    if(document.querySelector('.allaccounts').innerHTML){
        return true;
    }
    window.token = document.getElementById('csrf').content;
    var spinner = document.querySelector('.spinner-grow-hide');
    spinner.classList.remove('spinner-grow-hide');
    fetch(url, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': window.token,
        },
        enctype:"text/html",
        body: domain
    }).then(function (res) {
        return res.text();
    }).then(res => {
        if(res.message) {
            valedationError(res);
        }else{
            spinner.classList.add('spinner-grow-hide');
            document.querySelector('.allaccounts').innerHTML = res;
        }
    })
}
document.addEventListener('DOMContentLoaded', function(){
    window.myZoomModal = new bootstrap.Modal('#imageZoom', {})
    // var images = document.getElementsByClassName('zoom')
    var textBlocks = document.getElementsByClassName('text-body');
    for(let j = 0; j < textBlocks.length; j++) {
        var images = textBlocks[j].getElementsByTagName("img");
        for (let i = 0; i < images.length; i++) {
            images[i].addEventListener("click", function (e) {
                document.getElementById('imageZoom_wrapper').innerHTML = '';
                var img = document.createElement('img');
                img.setAttribute('src', e.target.src);
                img.setAttribute('class', 'zoomedImg');
                document.getElementById('imageZoom_wrapper').appendChild(img);
                window.myZoomModal.show();
            })
        }
    }
    setTimeout((e)=>{
        var preloader = document.getElementsByClassName('preloaderWrapper');
        preloader[0].remove();
    }, 500);

});

window.GetQueryParams = new Proxy(new URLSearchParams(window.location.search), {
    get: (searchParams, prop) => searchParams.get(prop),
});
if(GetQueryParams.domain){
    getModalForm('/informer/create?domain=' + GetQueryParams.domain)
}
if(GetQueryParams.post && GetQueryParams.tab){
    setTimeout(function () {
        document.getElementById(GetQueryParams.tab).click();
    }, 100);
    setTimeout(function () {
        document.getElementById(GetQueryParams.post).scrollIntoView();
    }, 500);
    setTimeout(function () {
        document.querySelector('#'+GetQueryParams.post+' .accordion-button').click()
    }, 1000);
}

window.clearErrors = function(){
    if(document.getElementById('errors') !== null){
        document.getElementById('errors').innerHTML = '';
    }

}
window.addSearchInputs = function (button){
    var inputsGroup = button.closest("div");
    var searchGroup = button.closest(".search_block");
    searchGroup.append(inputsGroup.cloneNode(true));
    const newItem = htmlToElement('<button onclick="removeSearchInputs(this)" type="button" class="btn btn-danger ">-</button>');
    button.replaceWith(newItem);
}
window.removeSearchInputs = function (button){
    var inputsGroup = button.closest("div");
    inputsGroup.remove();
}
window.htmlToElement = function (html) {
    var template = document.createElement('template');
    html = html.trim();
    template.innerHTML = html;
    return template.content.firstChild;
}

window.switchIputs = function (type){
    document.querySelectorAll('.search input').forEach(input => {input.required = !input.required; input.disabled = !input.disabled})
    document.querySelector('.' + type).classList.toggle('hide');
}
