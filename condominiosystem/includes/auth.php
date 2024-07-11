<?php

function verificarLogin()
{
    // Verifica se a variável de sessão "usuario_logado" está definida
    if (!isset($_SESSION['logado'])) {
        // Se o usuário não estiver logado, redireciona para a página de login
        header("Location: login.php");
        exit();
    } 
}

?>
