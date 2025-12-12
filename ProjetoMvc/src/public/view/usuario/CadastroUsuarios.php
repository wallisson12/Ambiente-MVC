<?php 
require_once "src/Model/Usuario/TipoUsuarioEnum.php";
?>
<html lang="en" class="h-full bg-gray-900">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro Usuarios</title>
    <script src="http://cdn.tailwindcss.com"></script>
</head>
<body class="h-full">
    <h3>Cadastro Usuario</h3>
    <div class="mt-8 ml-3">
        <form id="formularioCadastroUsuario" action="/usuario/cadastar" method="post">
            <div class="form-group">
                <div class="flex items-center justify-between">
                    <label for="username" class="block text-sm/6 font-medium text-white">Nome</label>
                </div>
                <div class="mt-2">
                    <input id="username" type="text" name="username" class="block w-full rounded-md bg-white/5 px-3 py-1.5 text-base text-white outline-1 -outline-offset-1 outline-white/10 placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6" required />
                </div>
            </div>

            <div class="form-group mt-5">
                <div class="flex items-center justify-between">
                    <label for="password" class="block text-sm/6 font-medium text-white">Senha</label>
                </div>
                <div class="mt-2 relative">
                    <input id="password" type="password" name="senha" required autocomplete="current-password" class="block w-full rounded-md bg-white/5 px-3 py-1.5 text-base text-white outline-1 -outline-offset-1 outline-white/10 placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6" />
                    <button id="btn_exibir_senha" type="button" class="absolute inset-y-0 right-3 flex items-center text-gray-400 hover:text-gray-200">
                        <img id="icon_eye" src="/src/public/view/login/assets/image/eye-slash.svg" class="h-6 w-auto" />
                    </button>
                </div>
            </div>
            

            <div class="form-group mt-5">
                <label for="tipo_usuario" class="block mb-2.5 text-sm text-white font-medium text-heading">Tipo Usuario</label>
                <select id="tipo_usuario" name="tipo_usuario" require class="block w-full rounded-md px-3 py-2.5 bg-white/5 border border-default-medium text-heading text-sm text-white  focus:ring-brand focus:border-brand shadow-xs placeholder:text-body">
                    <option class="text-gray-900" value="<?php echo TipoUsuarioEnum::Comun; ?>">Comun</option>
                    <option class="text-gray-900" value="<?php echo TipoUsuarioEnum::Administrador; ?>">Admin</option>
                </select>
            </div>
            
            <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
                <button type="submit" name="cadastrarUsuario" class="flex w-full justify-center rounded-md bg-indigo-500 px-3 py-1.5 text-sm/6 font-semibold text-white hover:bg-indigo-400 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">Cadastrar</button>
            </div>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="/src/public/view//js/toggleSenha.js"></script>
</body>
</html>