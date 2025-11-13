<?php 
    require_once "conexao.php";
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Tailwind CDN -->
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <title>Visualizar Usuário</title>

</head>
<body>

    <?php include 'navbar.php'; ?>

    <main class="px-[50px]">

        <div class="flex justify-between items-center py-[7px] px-[10px] bg-gray-100 border-1 border-gray-400 rounded-t-[7px]">

            <h1 class="text-[20px]">Visualizar Usuário</h1>

            <a class="bg-[#EE493E] text-[#fff] py-[7px] px-[10px] rounded-[5px]" href="index.php">Voltar</a>

        </div>

        <div class="border-1 border-gray-400 border-t-0 py-[20px] px-[15px]">

            <div>

                <?php 

                // Se na URL tem o id_usuario (visualizar usuario)
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

                <div class="flex flex-col mb-[20px]">

                    <label for="nome">Nome</label>
                    <p class="border-1 border-gray-300 px-[7px] py-[5px] rounded-[5px]">
                        <?= $usuario["nome"]; ?>
                    </p>

                </div>

                <div class="flex flex-col mb-[20px]">

                    <label for="email">Email</label>
                    <p class="border-1 border-gray-300 px-[7px] py-[5px] rounded-[5px]">
                        <?= $usuario["email"]; ?>
                    </p>

                </div>

                <div class="flex flex-col mb-[20px]">

                    <label for="data_nascimento">Data de Nascimento</label>
                    <p class="border-1 border-gray-300 px-[7px] py-[5px] rounded-[5px]">
                        <?= date("d/m/Y", strtotime($usuario["data_nascimento"])); ?>
                    </p>

                </div>

                <?php 

                    } else {
                        echo "<p>Usuário não encontrado</p>";
                    }

                }

                ?>

            </div>

        </div>

    </main>
    
</body>
</html>