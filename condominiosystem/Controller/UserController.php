<?php
session_start();

require_once '../Model/UserModel.php';

$userModel = new UserModel($connect);

if (isset($_POST['btn-login'])) {
    if (isset($_POST['email']) && isset($_POST['senha_usuario'])) {
        $email = mysqli_real_escape_string($connect, $_POST['email']);
        $senha = mysqli_real_escape_string($connect, $_POST['senha_usuario']);

        $usuario = $userModel->obterUsuarioPorEmail($email);

        if ($usuario && password_verify($senha, $usuario['senha_usuario'])) {
            $_SESSION['logado'] = true;
            $_SESSION['usuario_id'] = $usuario['usuario_id'];
            $_SESSION['nome_usuario'] = $usuario['nome_usuario'];
            $_SESSION['tipo_acesso'] = $usuario['tipo_acesso'];

            if ($_SESSION['tipo_acesso'] == 'administrador') {
                header('Location: ../admin_home.php');
                exit();
            } else {
                header('Location: ../home.php');
                exit();
            }
        } else {
            $_SESSION['error_message'] = 'Senha incorreta!';
            header('Location: ../login.php');
            exit();
        }
    } else {
        $_SESSION['error_message'] = 'Por favor, preencha todos os campos.';
        header('Location: ../login.php');
        exit();
    }
}

if (isset($_POST['btn-registrar'])) {
    $nome = mysqli_real_escape_string($connect, $_POST['nome_usuario']);
    $email = mysqli_real_escape_string($connect, $_POST['email']);
    $telefone = mysqli_real_escape_string($connect, $_POST['telefone']);
    $cpf = mysqli_real_escape_string($connect, $_POST['cpf']);
    $rg = mysqli_real_escape_string($connect, $_POST['rg']);
    $senha = mysqli_real_escape_string($connect, $_POST['senha_usuario']);
    $confirma_senha = mysqli_real_escape_string($connect, $_POST['confirma_senha']);

    // Verificar se as senhas coincidem
    if ($senha == $confirma_senha) {
        // Criptografar a senha
        $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

        // Inserir no banco de dados usando o método da classe UserModel
        if ($userModel->registrarUsuario($nome, $email, $telefone, $cpf, $rg, $senha_hash)) {
            // Obter o ID do usuário recém-criado
            $user_id = $userModel->getUltimoUsuarioInserido();

            // Iniciar sessão e definir variáveis de sessão
            $_SESSION['logado'] = true;
            $_SESSION['usuario_id'] = $user_id;
            $_SESSION['nome_usuario'] = $nome;

            // Redirecionar baseado no tipo de usuário (por padrão, 'usuario')
            $_SESSION['tipo_acesso'] = 'usuario'; // Por padrão, todo novo usuário é 'usuario'
            if ($_SESSION['tipo_acesso'] == 'administrador') {
                header('Location: ../admin_home.php');
            } else {
                header('Location: ../home.php');
            }
        } else {
            $_SESSION['mensagem'] = "Erro ao registrar usuário.";
            header('Location: ../solicitar_acesso.php');
        }
    } else {
        $_SESSION['mensagem'] = "As senhas não coincidem.";
        header('Location: ../solicitar_acesso.php');
    }
}
?>
