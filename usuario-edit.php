<?php 
    session_start();
    require_once "conexao.php";
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Tailwind CDN -->
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <title>Editar Usuário</title>

</head>
<body>

    <!-- Navbar -->
    <?php include 'navbar.php'; ?>

    <!-- Main -->
    <main class="px-[50px]">

        <div class="flex justify-between items-center py-[7px] px-[10px] bg-gray-100 border-1 border-gray-400 rounded-t-[7px]">

            <h1 class="text-[20px]">Editar Usuário</h1>

            <a class="bg-[#EE493E] text-[#fff] py-[7px] px-[10px] rounded-[5px]" href="index.php">Voltar</a>

        </div>

        <div class="border-1 border-gray-400 border-t-0 py-[20px] px-[15px]">

            <?php 

            if(isset($_GET["id_usuario"])) {

                $id_usuario = $_GET['id_usuario'];

                // Prepara e executa a consulta
                $sql = "SELECT * FROM usuarios WHERE id_usuario = :id_usuario";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
                $stmt->execute();

                // Verifica se retornou algum resultado
                if ($stmt->rowCount() > 0) {
                    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

            ?>

            <!-- Formulário para cadastrar usuário -->
            <form action="acoes.php" method="post">

                <div class="flex flex-col mb-[20px]">

                    <input class="hidden" 
                           type="text" name="id_usuario" value="<?=$usuario["id_usuario"];?>">

                    <label for="nome">Nome</label>
                    <input class="px-[10px] py-[7px] border-1 border-gray-300 rounded-[3px]" 
                           type="text" name="nome" value="<?=$usuario["nome"];?>">

                </div>

                <div class="flex flex-col mb-[20px]">

                    <label for="email">Email</label>
                    <input class="px-[10px] py-[7px] border-1 border-gray-300 rounded-[3px]" 
                           type="email" name="email" value="<?=$usuario["email"]?>">

                </div>

                <div class="flex flex-col mb-[20px]">

                    <label for="data_nascimento">Data de Nascimento</label>
                    <input class="px-[10px] py-[7px] border-1 border-gray-300 rounded-[3px]" 
                           type="date" name="data_nascimento" value="<?=$usuario["data_nascimento"]?>">

                </div>

                <div class="flex flex-col mb-[20px]">

                    <label for="senha">Senha</label>
                    <input class="px-[10px] py-[7px] border-1 border-gray-300 rounded-[3px]" 
                           type="password" name="senha">

                </div>

                <div class="flex mb-[20px]">

                    <button class="bg-[#296FFF] text-[#fff] py-[7px] px-[10px] rounded-[5px] cursor-pointer" 
                            type="submit" name="update_usuario">Salvar</button>

                </div>

            </form>

            <?php 

                } else {
                    echo "<p>Usuário não encontrado</p>";
                }

            }

            ?>

        </div>

    </main>
    
</body>
</html>