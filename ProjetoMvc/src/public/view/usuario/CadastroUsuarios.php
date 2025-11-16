<?php 
require_once "src/Model/Usuario/TipoUsuarioEnum.php";
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro Usuarios</title>
</head>
<body>
    <h3>Cadastro Usuario</h3>
    <form id="formularioCadastroUsuario" action="/usuario/cadastar" method="post">
        <div class="form-group">
            <label>Nome</label>
            <input type="text" name="username" require>
        </div>
        <div class="form-group">
            <label>Tipo Usuario</label>
            <select name="tipo_usuario" require>
                <option value="<?php echo TipoUsuarioEnum::Comun; ?>">Comun</option>
                <option value="<?php echo TipoUsuarioEnum::Administrador; ?>">Admin</option>
            </select>
        </div>

        <div class="form-group">
            <label name="senha">Senha</label>
            <input type="text" name="senha" require>
        </div>
        <button name="cadastrarUsuario">Cadastrar</button>
    </form>
</body>
</html>