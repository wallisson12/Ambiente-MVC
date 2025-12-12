$(document).ready(function(){
    adicionarEventoExibirSenha();
});


/**
 * Controla a exibicao do conteudo da senha
 */
function adicionarEventoExibirSenha(){
    $oInputSenha = $("#password");
    $sTipoTexto = "text";
    $sTipoPassword = "password";
    $oInputImagemOlho = $("#btn_exibir_senha").find('[id="icon_eye"]');
    $("#btn_exibir_senha").click(function(){
        if($oInputSenha.attr("type") == $sTipoPassword){
            $oInputImagemOlho.attr("src","/src/public/view/login/assets/image/eye.svg")
            $oInputSenha. attr("type",$sTipoTexto);
            return;
        }
        $oInputImagemOlho.attr("src","/src/public/view/login/assets/image/eye-slash.svg")
        $oInputSenha.attr("type",$sTipoPassword);
    });
}