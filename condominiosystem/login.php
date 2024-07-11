<?php
include_once 'includes/header.php';
session_start();
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
    <link rel="stylesheet" href="./assets/js/index.js" />
</head>

<body>
    <section>
        <div class=" py-4">
            <div class="row d-flex justify-content-center align-items-center">
                <div class="d-flex flex-column gap-4 col-12 col-md-8 col-lg-6 col-xl-5">
                    <h4 class="light"><i class="bi bi-buildings"></i> Gestão do Condomínio</h4>
                    <div class="card text-white card_container">
                        <div class="card-body p-4 text-center">
                            <form class="row" action="Controller/UserController.php" method="POST">
                                <p class="light">Portal do Morador</p>

                                <div class="mb-3">
                                    <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp" placeholder="E-mail" required>
                                </div>
                                <div class="mb-3 position-relative">
                                    <input type="password" class="form-control" name="senha_usuario" id="senha_usuario" aria-describedby="senha" placeholder="Senha">
                                    <i class="bi bi-eye-slash position-absolute top-50 end-0 translate-middle-y me-3" id="togglePassword" style="cursor: pointer;"></i>
                                </div>

                                <!-- Exibir mensagem de erro aqui -->
                                <?php if (isset($_SESSION['error_message'])): ?>
                                    <div class="alert alert-danger">
                                        <?php echo $_SESSION['error_message']; unset($_SESSION['error_message']); ?>
                                    </div>
                                <?php endif; ?>

                                <div class="mb-3 text-end">
                                    <button type="submit" name="btn-login" class="btn btn-secondary btn_cadastro">Entrar</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="d-flex flex-column text-end">
                        <a href="solicitar_acesso.php" type="button" class="btn btn-success btn_cadastro">Solicitar Acesso</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>

<?php
include_once 'includes/footer.php';
?>
