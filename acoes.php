<?php
// Usando sessão para guardar as variaveis de mensagens em uma sessão
session_start();
require_once 'conexao.php';

// Se clicou no botão de Salvar do formulário para criar usuário
if (isset($_POST['create_usuario'])) {

    // Coletando os dados do formulário
    $nome = trim($_POST['nome']);
    $email = trim($_POST['email']);
    $data_nascimento = trim($_POST['data_nascimento']);
    $senha = isset($_POST['senha']) ? password_hash(trim($_POST['senha']), PASSWORD_DEFAULT) : '';

    try {
        // Cria a query com parâmetros nomeados
        $sql = "INSERT INTO usuarios (nome, email, data_nascimento, senha)
                VALUES (:nome, :email, :data_nascimento, :senha)";
        
        // Prepara a query
        $stmt = $conn->prepare($sql);

        // Faz o bind dos valores
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':data_nascimento', $data_nascimento);
        $stmt->bindParam(':senha', $senha);

        // Executa o comando
        $stmt->execute();

        // Verifica se algum registro foi inserido
        if ($stmt->rowCount() > 0) {
            $_SESSION['mensagem'] = 'Usuário criado com sucesso!';
            header('Location: index.php');
            exit;
        } else {
            $_SESSION['mensagem'] = 'Usuário não foi criado.';
            header('Location: index.php');
            exit;
        }
    } catch (PDOException $e) {
        $_SESSION['mensagem'] = 'Erro ao criar usuário: ' . $e->getMessage();
        header('Location: index.php');
        exit;
    }
}
?>