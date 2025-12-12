$(document).ready(function() {
   adicionarEventoBtnCadastrar();
});

/**
 * Carrega a view de cadastro de usuario
 */
function adicionarEventoBtnCadastrar(){    
    $("#cadastrar_btn").click(function(e){
        window.location = "/usuario/indexCadastrar";
    });
}
