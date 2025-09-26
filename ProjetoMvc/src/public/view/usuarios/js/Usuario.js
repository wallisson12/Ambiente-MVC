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
                    </tr>
                `;
            });
            $("#tabela_usuarios tbody").html(html);
        },
        error: () =>{
            console.error("Ocorreu um erro ao tentar listar os filiados")
        }
    });
}