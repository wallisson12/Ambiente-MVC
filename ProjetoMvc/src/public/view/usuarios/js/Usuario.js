document.addEventListener("DOMContentLoaded",()=>{
    realizarRequisicaoAjaxListarUsuarios();
});

function realizarRequisicaoAjaxListarUsuarios(){
    $.ajax({
        url: "/usuarios/listarAjax",
        type: "GET",
        dataType: "json",
        success: (usuarios) => {
            let html = '';
            usuarios.forEach(usuario => {
                html += `
                    <tr>
                        <td>${usuario.nome}</td>
                        <td>${usuario.tipo}</td>
                         <td>
                            <button class="btn-editar" data-id="${usuario.id}">Editar</button>
                        </td>
                        <td>
                            <button class="btn-deletar" data-id="${usuario.id}">Deletar</button>
                        </td>
                    </tr>
                `;
            });
            $("#tabela_usuarios tbody").html(html);
            anexarEventosAcoesBotoes();
        },
        error: () =>{
            console.error("Ocorreu um erro ao tentar listar os filiados")
        }
    });
}

/**
 * Anexa os eventos para os botoes de acoes da tabela de usuarios
 */
function anexarEventosAcoesBotoes() {
    adicionarEventoEditar();
    adicionarEventoApagar();
}

/**
 * Adiciona um evento ao editar um usuario
 */
function adicionarEventoEditar(){
    $("#tabela_usuarios").on("click",".btn-editar",function(){
        let iIdUsuario = $(this).data('id');
        window.location.href = `/usuarios/editar?id=${iIdUsuario}`;
    });
}

/**
 * Adiciona um evento ao apagar um usuario 
 */
function adicionarEventoApagar() {
    $("#tabela_usuarios").on("click", ".btn-deletar", function(){
        let iIdUsuario = $(this).data('id');
        realizarRequisicaoAjaxDeletarUsuario(iIdUsuario);
    });
}

/**
 * Realiza a requisicao para o endpoint deletar um usuario
 */
function realizarRequisicaoAjaxDeletarUsuario(iIdUsuario){
    
}