<?php
require_once("consultas.php");
if (isset($_SESSION["login"])) {
    header("location:index.php");
}

session_start();

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Theor Page</title>
    <link rel="icon" href="img/icono.png" type="image/x-icon" />
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body>

    <img src="img/banner.gif" style="width: 100%;" alt="Theor">
    <nav class="navbar navbar-expand-lg bg-light" data-bs-theme="light">
        <div class="container-fluid">
            <img src="img/logo.png" alt="Theor">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01"
                aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarColor01">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link active mr-1" href="indexCliente.php">Home
                            <span class="visually-hidden">(current)</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php" onclick="cerrarSesion()">Cerrar Sesión
                            <span class="visually-hidden">(current)</span>
                        </a>
                    </li>
            </div>
            </li>
            </ul>
            <form class="d-flex" method="GET">
                <div class="navbar-text me-3">
                    <i class="fas fa-user-circle fa-lg me-2"></i>
                    <span class="d-none d-lg-inline-block">
                        Bienvenido,
                        <?php echo $_SESSION["login"]["usuario"]; ?>
                    </span>
                </div>
            </form>
        </div>
        </div>
    </nav>
    <?php if (isset($guardadoRegistro)): ?>
        <div class="alert alert-dismissible alert-success">
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            <strong>Registro exitoso!</strong> El usuario se registró correctamente.
        </div>
    <?php endif; ?>
    <?php if (isset($errorRegistro)): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong> Hubo un problema al realizar el registro.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>
    <?php if (isset($nombreEnUso)): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong> Ese nombre de usuario está en uso.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>
    <?php if (isset($caracteres)): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong> El nombre y contraseña deben ser mayores a 5 caracteres.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>
    <?php if (isset($contraseñasCoincidencia)): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong> Las contraseñas no coinciden.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <?php if (isset($loginError)): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong> Nombre de usuario o contraseña incorrectos.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>
    <section class="py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="row gx-4 gx-lg-5 align-items-center">
                <div class="col-md-6"><img class="card-img-top mb-5 mb-md-0" src="img/local.gif" alt="..." /></div>
                <div class="col-md-6">
                    <div class="small mb-1">Ubicación</div>
                    <h1 class="display-5 fw-bolder">Nuestro local</h1>
                    <p class="lead">Sitges, la ciudad costera más encantadora de Cataluña, alberga nuestra empresa,
                        ubicada en la calle dels Gegants, 08870 Sitges, Barcelona, España.
                        Nuestros horarios son de 8:00 a 18:00. </p>
                    <div class="d-flex">
                        <a class="btn btn-outline-dark flex-shrink-0"
                            href="https://www.google.com/maps/place/Carrer+dels+Gegants+de+Sitges,+08870+Sitges,+Barcelona,+Espa%C3%B1a/@41.2374345,1.8191157,18z/data=!4m15!1m8!3m7!1s0x12a3804720b208fb:0x7061f1fb2907c8f9!2s08870+Sitges,+Barcelona,+Espa%C3%B1a!3b1!8m2!3d41.2371851!4d1.805886!16zL20vMDEwbmY0!3m5!1s0x12a3803a6652d039:0xe432fcf45da9225d!8m2!3d41.2375011!4d1.8191479!16s%2Fg%2F11s4yvj6sb?entry=ttu"
                            target="_blank">
                            <i class="bi-cart-fill me-1"></i>
                            Mapa
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="row gx-4 gx-lg-5 align-items-center">
                <div class="col-md-6">
                    <div class="small mb-1">Sorteo válido hasta el 31 de diciembre de 2023.</div>
                    <h1 class="display-5 fw-bolder">Sorteo</h1>
                    <p class="lead">Con la compra de cualquier producto de nuestra tienda valorado en más de €100,
                        participas automáticamente en el sorteo de esta espectacular vivienda. No lo dudes, ¡esta es tu
                        oportunidad de tener la casa de tus sueños!</p>
                </div>
                <div class="col-md-6">
                    <img class="card-img-top mb-5 mb-md-0" src="img/sorteo.gif" alt="..." />
                </div>
            </div>
        </div>
    </section>
    <footer class="py-5 bg-dark">
        <div class="container">
            <div class="row">
                <div class="col text-center">
                    <p class="m-0 text-white">
                        Sígueme en:
                        <a href="https://www.instagram.com/___andretorres/" class="text-white mx-2" target="_blank">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="https://github.com/andreJesusTorres" class="text-white mx-2" target="_blank">
                            <i class="fab fa-github"></i>
                        </a>
                        <a href="https://www.linkedin.com/in/andr%C3%A9-torres-419931235/" class="text-white mx-2"
                            target="_blank">
                            <i class="fab fa-linkedin"></i>
                        </a>
                    </p>
                    <p class="m-0 text-white">Copyright &copy; André Jesús Torres</p>
                </div>
            </div>
        </div>
    </footer>
    <script src="js/bootstrap.bundle.js"></script>
</body>

</html>