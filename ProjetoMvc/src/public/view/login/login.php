<html lang="en" class="h-full bg-gray-900">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login</title>
        <script src="http://cdn.tailwindcss.com"></script>
</head>

<body class="h-full">    
    <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm">
            <!-- <img src="" alt="Your Company" class="mx-auto h-10 w-auto" /> -->
             <h3 class="mt-10 text-center">Adicionar uma imagem</h3>
        </div>

  <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
      <form action="/login/logar" method="post" class="space-y-6">
        <div>
            <div class="flex items-center justify-between">
                <label for="username" class="block text-sm/6 font-medium text-gray-100">Username</label>
            </div>
            <div class="mt-2">
                <input id="username" type="text" name="username" class="block w-full rounded-md bg-white/5 px-3 py-1.5 text-base text-white outline-1 -outline-offset-1 outline-white/10 placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6" required />
            </div>
        </div>

        <div>
            <div class="flex items-center justify-between">
                <label for="password" class="block text-sm/6 font-medium text-gray-100">Password</label>
            </div>
            <div class="mt-2 relative">
                <input id="password" type="password" name="senha" required autocomplete="current-password" class="block w-full rounded-md bg-white/5 px-3 py-1.5 text-base text-white outline-1 -outline-offset-1 outline-white/10 placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6" />
                 <button id="btn_exibir_senha" type="button" class="absolute inset-y-0 right-3 flex items-center text-gray-400 hover:text-gray-200">
                   <img id="icon_eye" src="/src/public/view/login/assets/image/eye-slash.svg" class="h-6 w-auto" />
                 </button>
            </div>
        </div>

        <div class="space-y-3">
            <button type="submit" class="flex w-full justify-center rounded-md bg-indigo-500 px-3 py-1.5 text-sm/6 font-semibold text-white hover:bg-indigo-400 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">Login</button>
            <button  id="cadastrar_btn" type="button" class="flex w-full justify-center rounded-md bg-indigo-500 px-3 py-1.5 text-sm/6 font-semibold text-white hover:bg-indigo-400 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">Cadastrar</button>
        </div>
    </form>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="/src/public/view/login/js/Login.js"></script>
<script src="/src/public/view//js/toggleSenha.js"></script>
</body>
</html>