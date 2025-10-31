
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Tailwind CDN -->
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <title>Adicionar Usuário</title>

</head>
<body>

    <?php include 'navbar.php'; ?>

    <main class="px-[50px]">

        <div class="flex justify-between items-center py-[7px] px-[10px] bg-gray-100 border-1 border-gray-400 rounded-t-[7px]">

            <h1 class="text-[20px]">Adicionar Usuário</h1>

            <a class="bg-[#EE493E] text-[#fff] py-[7px] px-[10px] rounded-[5px]" href="index.php">Voltar</a>

        </div>

        <div class="border-1 border-gray-400 border-t-0 py-[20px] px-[15px]">

            <form action="#" method="post">

                <div class="flex flex-col mb-[20px]">

                    <label for="nome">Nome</label>
                    <input class="px-[10px] py-[7px] border-1 border-gray-300 rounded-[3px]" type="text" name="nome">

                </div>

                <div class="flex flex-col mb-[20px]">

                    <label for="email">Email</label>
                    <input class="px-[10px] py-[7px] border-1 border-gray-300 rounded-[3px]" type="email" name="email">

                </div>

                <div class="flex flex-col mb-[20px]">

                    <label for="data_nascimento">Data de Nascimento</label>
                    <input class="px-[10px] py-[7px] border-1 border-gray-300 rounded-[3px]" type="date" name="data_nascimento">

                </div>

                <div class="flex flex-col mb-[20px]">

                    <label for="senha">Senha</label>
                    <input class="px-[10px] py-[7px] border-1 border-gray-300 rounded-[3px]" type="password" name="senha">

                </div>

                <div class="flex mb-[20px]">

                    <button class="bg-[#296FFF] text-[#fff] py-[7px] px-[10px] rounded-[5px]" type="submit" name="create_usuario">Salvar</button>

                </div>

            </form>

        </div>

    </main>
    
</body>
</html>