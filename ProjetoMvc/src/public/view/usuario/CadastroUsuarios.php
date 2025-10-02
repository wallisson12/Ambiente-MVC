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
            <select name="admin">
                <option value="1">Comun</option>
                <option value="2">Admin</option>
            </select>
        </div>
        <button name="cadastrarUsuario">Cadastrar</button>
    </form>
</body>
</html>