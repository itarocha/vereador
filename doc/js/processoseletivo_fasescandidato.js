$(document).ready(function() {

    $('.fancyboxcadastro').fancybox({
        closeBtn: false,
        closeClick: false,
        modal: true,
        fitToView: true,
        openEffect: 'none',
        closeEffect: 'none',
        maxWidth: 892,
        maxHeight: 436,
        width: 892,
        height: 436,
        padding: 0,
        autoSize: false,
        type: 'iframe'
    });

    
    $('#ind_lista_negra').change(function() {
        listaNegraChange();
    });
    $('#ind_lista_negra').keydown(function() {
        listaNegraChange();
    });
    listaNegraChange();
});

function listaNegraChange(){
    if ($('#ind_lista_negra').val() == "S") {
        $('#div_des_motivo_lista_negra').show();
    } else {
        $('#div_des_motivo_lista_negra').hide();
    }
}

function confirmFecharProcesso(id) {
    jQuery.fancybox({
        closeBtn: false,
        closeClick: false,
        modal: true,
        fitToView: true,
        width: '526px',
        height: '152px',
        padding: '0px',
        border: '0px',
        autoSize: false,
        openEffect: 'none',
        closeEffect: 'none',
        scrolling: false,
        content: '<div class="w-100 bg-amarelo fancy-header">'
                + '<div class="fancy-header-ic f-left"></div>'
                + '<div class="ff-opensans f-18 c-branco fancy-header-tt f-left">Atenção</div>'
                + '</div>'
                + '<div class="fancy-main">'
                + '<p class="f-16 f-bold">Realmente deseja fechar este Processo Seletivo ?</p>'
                + '<div class="bts_deletar_modal">'
                + '<span class="f-left b-submit-maior c-branco bg-verde margin-auto b-ic-adicionar" onclick="fecharProcesso(\'' + id + '\');">OK</span>'
                + '<span class="b-submit-maior-ic b-ic-deletar c-branco bg-laranja f-left w-margin-left20" onclick="closeFancyboxAndRedirectToUrl();">Não</span>'
                + '</div>'
                + '<a href="javascript:;" class="fancybox-item fancybox-close" title="Cancelar" onClick="closeFancyboxAndRedirectToUrl();"></a>'
    });
}

function fecharProcesso(id) {
    $.post(LINK_MODULE + "processoseletivo/ajaxfecharprocesso", {
        "id": id
    }, function(data) {
        if (data.msg == 'ok') {
            closeFancyboxAndRedirectToUrl(LINK_MODULE + '/processoseletivo/index');
        } else {
            fancyAlert('Erro ao fechar Processo Seletivo. <br/>Entre em contato com o suporte técnico', 'err', LINK_MODULE + '/processoseletivo/index');
        }
        
    }, "json");
}
