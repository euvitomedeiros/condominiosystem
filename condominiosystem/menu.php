<?php
include_once 'includes/auth.php';
session_start();

// Verifica se o usuário é administrador
$isAdmin = ($_SESSION['tipo_acesso'] ?? '') === 'administrador';
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Menu Responsivo</title>
    <!-- Materialize CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <!-- Ícones Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>
    <nav>
        <div class="nav-wrapper green">
            <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
            <ul class="right hide-on-med-and-down">
                <?php if ($isAdmin): ?>
                    <li><a href="admin_home.php">Painel de <?php echo htmlspecialchars($_SESSION['nome_usuario']); ?></a></li>
                    <li>
                        <a href="solicitacoes_acesso.php">
                            Solicitações de Acesso 
                            <?php 
                            // Inicializa total de solicitações como zero
                            $totalSolicitacoes = 0;

                            // Consulta SQL para obter o número de solicitações pendentes
                            include_once 'Model/db_connect.php';
                            $sql = "SELECT COUNT(*) AS total_solicitacoes FROM solicitacao_acesso WHERE approved = 0";
                            $resultado = mysqli_query($connect, $sql);

                            if ($resultado) {
                                $dados = mysqli_fetch_assoc($resultado);
                                $totalSolicitacoes = $dados['total_solicitacoes'];
                            } else {
                                echo "Erro ao consultar as solicitações: " . mysqli_error($connect);
                            }

                            mysqli_close($connect);

                            if ($totalSolicitacoes > 0): ?>
                                <span class="new badge" data-badge-caption=""><?php echo $totalSolicitacoes; ?></span>
                            <?php endif; ?>
                        </a>
                    </li>
                <?php else: ?>
                    <li><a href="home.php">Painel de Painel de <?php echo htmlspecialchars($_SESSION['nome_usuario']); ?></a></li>
                <?php endif; ?>
                <li><a href="logout.php">Sair</a></li>
            </ul>
        </div>
    </nav>

    <!-- Menu lateral para dispositivos móveis -->
    <ul class="sidenav" id="mobile-demo">
        <?php if ($isAdmin): ?>
            <li><a href="admin_home.php">Painel de <?php echo htmlspecialchars($_SESSION['nome_usuario']); ?></a></li>
            <li>
                <a href="solicitacoes_acesso.php">
                    Solicitações de Acesso 
                    <?php if ($totalSolicitacoes > 0): ?>
                        <span class="new badge" data-badge-caption=""><?php echo $totalSolicitacoes; ?></span>
                    <?php endif; ?>
                </a>
            </li>
        <?php else: ?>
            <li><a href="home.php">Home</a></li>
        <?php endif; ?>
        <li><a href="logout.php">Sair</a></li>
    </ul>

    <!-- Materialize JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var elems = document.querySelectorAll('.sidenav');
            var instances = M.Sidenav.init(elems);
        });
    </script>
</body>
</html>
