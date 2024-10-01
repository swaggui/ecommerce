$(document).ready(function () {
    $('#senhaIcone').on('click', function () {
        var senhaEspaco = $('#senha');
        var senhaEspacoTipo = senhaEspaco.attr('type');
        if (senhaEspacoTipo === 'password') {
            senhaEspaco.attr('type', 'text');
            $(this).html('<i class="fa fa-eye-slash" aria-hidden="true"></i>'); //com barra
        } else {
            senhaEspaco.attr('type', 'password');
            $(this).html('<i class="fa fa-eye" aria-hidden="true"></i>'); //normal
        }
    });
    $('#senhaIconeConfirmar').on('click', function () {
        var senhaConfirmarEspaco = $('#confirmar_senha');
        var senhaConfirmarEspacoTipo = senhaConfirmarEspaco.attr('type');
        if (senhaConfirmarEspacoTipo === 'password') {
            senhaConfirmarEspaco.attr('type', 'text');
            $(this).html('<i class="fa fa-eye-slash" aria-hidden="true"></i>'); //com barra
        } else {
            senhaConfirmarEspaco.attr('type', 'password');
            $(this).html('<i class="fa fa-eye" aria-hidden="true"></i>'); //normal
        }
    });
});
