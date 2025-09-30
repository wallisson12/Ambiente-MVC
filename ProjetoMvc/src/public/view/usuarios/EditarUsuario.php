<?php
require_once "src/Model/Usuario/TipoUsuarioEnum.php"

/**
 * @var Usuario $oUsuario
*/

?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuario</title>
</head>
<body>
    <form id="formularioEditarUsuario" action="/usuarios/atualizar" method="post">
        <div class="form-group">
            <label>Nome</label>
            <input type="text" name="username" value="<?php echo $oUsuario->getNomeUsuario()?>" required>
        </div>
        <div class="form-group">
            <label>Tipo Usuario</label>
            <select name="admin">
                <option value="1" <?php echo $oUsuario->getTipoUsuario() == TipoUsuarioEnum::Comun ? "selected" : "" ?>>Comun</option>
                <option value="2" <?php echo $oUsuario->getTipoUsuario() == TipoUsuarioEnum::Administrador ? "selected" : "" ?>>Admin</option>
            </select>
        </div>
        <button name="atualizarUsuario">Atualizar</button>
    </form>
    
</body>
</html>