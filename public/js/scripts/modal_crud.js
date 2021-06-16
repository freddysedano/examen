$(document).ready(function () {
    $.ajaxSetup({ cache: false });
    $('a[is-modal]').on('click', function (e) {
        $('#contentModal').load(this.href, function () {
            $('#modalGenerico').modal({ keyboard: true }, 'show')
            
            crud();
        });
        return false;
    });
    ('#modalGenerico').on('hidden. bs. modal', function () {
        $('#contentModal').html(' ');
    });
});
function crud() {
    const myForm = document.querySelector('#myForm');
    myForm.addEventListener('submit', function (e) {
        e.preventDefault();
        const action = myForm.getAttribute('action');
        const data = new FormData(myForm);

        fetch(action, { method: 'POST', body: data })
            .then(rpta => {
                return rpta.json();
            })
            .then(response => {
                switch (response.success) {
                    case 1:
                        alert(response.message);
                        location.href = response.redirection;
                        break;
                    case 0:
                        alert(response.message);
                        break;
                    case -1:
                        renderError(response.message, 'mis_errores');
                        break;
                }
            });
    });
}


function renderError(errors, id_item) {
    let err = Object.values(errors);
    let lista = "<ul class='alert alert-danger  rounded alert-dismissible fade show' role='alert'>";
    for (let i = 0; i < err.length; i++) {
        lista += "<li> * " + err[i] + "</li>";
    }
    lista += "<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>";
    lista += "</ul>";
    document.getElementById(id_item).innerHTML = lista;
}

function seleccionar() {
    let tipo = document.getElementById('id_tipo');
    let len = tipo.value;
    tipo.selected(3);
}