<?php
include_once 'includes/header.php';
include_once 'menu.php';
include_once 'includes/auth.php';
include_once 'Model/db_connect.php';
verificarLogin();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Página em Construção</title>
    <!-- Materialize CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <!-- Ícones Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>

    <div class="container">
        <div class="row">
            <div class="col s12">
                <div class="card yellow darken-3">
                    <div class="card-content white-text">
                        <span class="card-title"><i class="material-icons">build</i> Página em Construção!</span>
                        <p>Esta página está em construção. Por favor, volte mais tarde.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
