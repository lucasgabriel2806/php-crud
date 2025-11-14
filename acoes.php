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

// Se clicou no botão de Salvar do formulário para editar usuário
if (isset($_POST['update_usuario'])) {
    // Coleta os dados do formulário
    $id_usuario = trim($_POST['id_usuario']);
    $nome = trim($_POST['nome']);
    $email = trim($_POST['email']);
    $data_nascimento = trim($_POST['data_nascimento']);
    $senha = trim($_POST['senha']);

    try {
        // Se a senha foi enviada, inclui no UPDATE
        if (!empty($senha)) {
            $sql = "UPDATE usuarios 
                    SET nome = :nome, email = :email, data_nascimento = :data_nascimento, senha = :senha 
                    WHERE id_usuario = :id_usuario";
        } else {
            $sql = "UPDATE usuarios 
                    SET nome = :nome, email = :email, data_nascimento = :data_nascimento 
                    WHERE id_usuario = :id_usuario";
        }

        // Prepara a query
        $stmt = $conn->prepare($sql);

        // Faz o bind dos valores
        $stmt->bindValue(':nome', $nome, PDO::PARAM_STR);
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->bindValue(':data_nascimento', $data_nascimento, PDO::PARAM_STR);
        $stmt->bindValue(':id_usuario', $id_usuario, PDO::PARAM_INT);

        // Se houver senha, aplica hash e faz bind também
        if (!empty($senha)) {
            $senha_hash = password_hash($senha, PASSWORD_DEFAULT);
            $stmt->bindValue(':senha', $senha_hash, PDO::PARAM_STR);
        }

        // Executa
        $stmt->execute();

        // Verifica se algum registro foi atualizado
        if ($stmt->rowCount() > 0) {
            $_SESSION['mensagem'] = 'Usuário editado com sucesso!';
            header('Location: index.php');
            exit;
        } else {
            $_SESSION['mensagem'] = 'Usuário não foi editado.';
            header('Location: index.php');
            exit;
        }

    } catch (Exception $e) {
        $_SESSION['mensagem'] = 'Erro ao editar usuário: ' . $e->getMessage();
        header('Location: index.php');
        exit;
    }

}

// Se clicou no botão de Excluir da lista de usuários para excluir um usuário
if (isset($_POST["delete_usuario"])) {

    try {

        $id_usuario = $_POST["delete_usuario"];

        $sql = "DELETE FROM usuarios 
                WHERE id_usuario = :id_usuario";

        // Prepara a query
        $stmt = $conn->prepare($sql);

        // Faz o bind dos valores
        $stmt->bindParam(':id_usuario', $id_usuario);

        // Executa o comando
        $stmt->execute();

        // Verifica se algum registro foi inserido
        if ($stmt->rowCount() > 0) {
            $_SESSION['mensagem'] = 'Usuário deletado com sucesso!';
            header('Location: index.php');
            exit;
        } else {
            $_SESSION['mensagem'] = 'Usuário não foi deletado.';
            header('Location: index.php');
            exit;
        } 

    } catch (Exception $e) {

        $_SESSION['mensagem'] = 'Erro ao deletar usuário: ' . $e->getMessage();
        header('Location: index.php');
        exit;
    }

}

?>