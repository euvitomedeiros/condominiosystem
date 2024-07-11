<?php
include_once 'includes/header.php';
include_once 'menu.php';
include_once 'includes/auth.php';
include_once 'Model/db_connect.php';
verificarLogin();


?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>Portal do Condomínio</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous" />
    <link rel="stylesheet" href="./assets/css/index.css" />
</head>
<body class="d-flex flex-column min-vh-100">
    <div class="my-auto">
        <div class="row">
            <div class="col-12 col-md-8 offset-md-2 col-lg-6 offset-lg-3">
                <h4 class="light">Painel do Administrador</h4>
                <div class="card">
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><a href="moradores.php"><i class="bi bi-people-fill"></i> Moradores</a></li>
                            <li class="list-group-item"><a href="unidades.php"><i class="bi bi-houses"></i> Gestão de Unidades</a></li>
                            <li class="list-group-item"><a href="registro_pagamentos.php"><i class="bi bi-cash-coin"></i> Registro de Pagamentos</a></li>
                            <li class="list-group-item"><a href="listadereservas.php"><i class="bi bi-scooter"></i> Reservas de Áreas Comuns</a></li>
                            <li class="list-group-item"><a href="sugestoes_reclamacoes.php"><i class="bi bi-hammer"></i> Sugestões e Reclamações</a></li>
                            <li class="list-group-item"><a href="comunicacao_interna.php"><i class="bi bi-megaphone-fill"></i> Comunicação Interna</a></li>
                            <li class="list-group-item"><a href="teste.php"><i class="bi bi-file-earmark"></i> Arquivos</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
include_once 'includes/footer.php';
?>
</body>
</html>
