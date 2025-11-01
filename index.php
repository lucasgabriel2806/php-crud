<?php
    session_start();
    require_once 'conexao.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Tailwind CDN -->
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <title>PHP - CRUD</title>

</head>
<body>

    <?php include 'navbar.php'; ?>

    <main class="px-[50px]">
        
        <?php require_once("mensagem.php"); ?>

        <div class="flex justify-between items-center py-[7px] px-[10px] bg-gray-100 border-1 border-gray-400 rounded-t-[7px]">

            <h1 class="text-[20px]">Lista de Usuários</h1>

            <a class="bg-[#296FFF] text-[#fff] py-[7px] px-[10px] rounded-[5px]" href="usuario-create.php">Adicionar usuário</a>

        </div>

        <div class="border-1 border-t-0 border-gray-400 p-[15px] rounded-b-[7px]">

            <table class="w-[100%] border-1 border-gray-400">

                <tr class="border-1 border-gray-400">

                    <th class="border-1 border-gray-400 p-[7px]">ID</th>
                    <th class="border-1 border-gray-400 p-[7px]">Nome</th>
                    <th class="border-1 border-gray-400 p-[7px]">Email</th>
                    <th class="border-1 border-gray-400 p-[7px]">Data de nascimento</th>
                    <th class="border-1 border-gray-400 p-[7px]">Ações</th>

                </tr>

                <tr class="bg-gray-200">

                    <td class="border-1 border-gray-400 p-[7px]">ID</td>
                    <td class="border-1 border-gray-400 p-[7px]">Nome</td>
                    <td class="border-1 border-gray-400 p-[7px]">Email</td>
                    <td class="border-1 border-gray-400 p-[7px]">Data de nascimento</td>
                    <td class="border-1 border-gray-400 p-[7px]">
                        <a class="bg-[#6B757B] text-[#fff] py-[5px] px-[10px] rounded-[5px]" href="#">Visualizar</a>
                        <a class="bg-[#2F7A5E] text-[#fff] py-[5px] px-[10px] rounded-[5px]" href="#">Editar</a>
                        <form class="inline bg-[#EE493E] text-[#fff] py-[5px] px-[10px] rounded-[5px]" action="#" mathod="POST">
                            <button type="submit" name="delete_usuario" value="1">
                                Excluir
                            </button>
                        </form>
                    </td>

                </tr>

            </table>

        </div>

    </main>
    
</body>
</html>