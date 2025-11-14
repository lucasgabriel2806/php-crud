<?php
    // Usanso session_start para poder exibir as mensagens gravadas na variavel global SESSION
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

    <!-- Navbar -->
    <?php include 'navbar.php'; ?>

    <!-- Main -->
    <main class="px-[50px]">
        
        <!-- Mensagem gerada em php -->
        <?php require_once("mensagem.php"); ?>

        <div class="flex justify-between items-center py-[7px] px-[10px] bg-gray-100 border-1 border-gray-400 rounded-t-[7px]">

            <h1 class="text-[20px]">Lista de Usuários</h1>

            <!-- Link Adicionar Usuário -->
            <a class="bg-[#296FFF] text-[#fff] py-[7px] px-[10px] rounded-[5px]" href="usuario-create.php">Adicionar usuário</a>

        </div>

        <div class="border-1 border-t-0 border-gray-400 p-[15px] rounded-b-[7px]">

            <!-- Tabela com lista de usuários -->
            <table class="w-[100%] border-1 border-gray-400">

                <thead>

                    <tr class="border-1 border-gray-400">

                        <th class="border-1 border-gray-400 p-[7px]">ID</th>
                        <th class="border-1 border-gray-400 p-[7px]">Nome</th>
                        <th class="border-1 border-gray-400 p-[7px]">Email</th>
                        <th class="border-1 border-gray-400 p-[7px]">Data de nascimento</th>
                        <th class="border-1 border-gray-400 p-[7px]">Ações</th>

                    </tr>

                </thead>

                <tbody>

                    <?php
                        // Consulta SQL para recuperar todos os usuários cadastrados
                        $sql = "SELECT * FROM usuarios";

                        try {
                            // Prepara e executa a consulta
                            $stmt = $conn->prepare($sql);
                            $stmt->execute();

                            // Busca todos os resultados
                            $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

                            $i = 0;
                            
                            if (count($usuarios) > 0) {
                                // Iterando sobre usuarios, recuperando os usuarios para exibir no HTML
                                foreach ($usuarios as $usuario) {
                                    $i = $i + 1;
                    ?>
              
                    <!-- Definindo cor estilo zebra para a tabela -->
                    <tr class="
                        <?php 
                            if ($i % 2 === 0) { 
                                echo "bg-[#fff]"; 
                            } else {
                                echo "bg-gray-200";
                            } 
                        ?> 
                    ">

                        <!-- Exibindo os registros de usuarios -->
                        <td class="border-1 border-gray-400 p-[7px]">
                            <?= htmlspecialchars($usuario['id_usuario']) ?>
                        </td>

                        <td class="border-1 border-gray-400 p-[7px]">
                            <?= htmlspecialchars($usuario['nome']) ?>
                        </td>

                        <td class="border-1 border-gray-400 p-[7px]">
                            <?= htmlspecialchars($usuario['email']) ?>
                        </td>

                        <td class="border-1 border-gray-400 p-[7px]">
                            <?= date('d/m/Y', strtotime(htmlspecialchars($usuario['data_nascimento']))) ?>
                        </td>

                        <td class="border-1 border-gray-400 p-[7px]">

                            <!-- Visualizar e editar vão redirecionar para uma página , por isso são links -->
                            <a class="bg-[#6B757B] text-[#fff] py-[5px] px-[10px] rounded-[5px]" href="usuario-view.php?id_usuario=<?=$usuario["id_usuario"]?>">Visualizar</a>
                            <a class="bg-[#2F7A5E] text-[#fff] py-[5px] px-[10px] rounded-[5px]" href="usuario-edit.php?id_usuario=<?=$usuario["id_usuario"]?>">Editar</a>
                            <!-- Excluir vai criar um confirm pra excluir um usuário, por isso é um form -->
                            <form class="inline bg-[#EE493E] text-[#fff] py-[5px] px-[10px] rounded-[5px] cursor-pointer" 
                                  action="acoes.php" method="POST" onsubmit="return confirm('Deseja excluir o usuário?');">
                                <input class="hidden" type="text" name="id" value="<?=$usuario["id_usuario"]?>">
                                <button class="cursor-pointer" type="submit" 
                                        name="delete_usuario" value="<?=$usuario["id_usuario"]?>">
                                    Excluir
                                </button>
                            </form>

                        </td>

                    </tr>

                    <?php
                                }
                            // Se não existe usuário cadastrado
                            } else {
                                echo '<p>Nenhum usuário encontrado</p>';
                            }
                        // Se houver uma exceção
                        } catch (PDOException $e) {
                            echo '<h5>Erro ao buscar usuários: ' . $e->getMessage() . '</h5>';
                        }
                    ?>

                </tbody>

            </table>

        </div>

    </main>
    
</body>
</html>