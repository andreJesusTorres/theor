<?php
require_once("consultas.php");
if (isset($_SESSION["login"])) {
    header("location:index.php");
}
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
                        <a class="nav-link active mr-3" href="index.php">Home
                            <span class="visually-hidden">(current)</span>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button"
                            aria-haspopup="true" aria-expanded="false">Iniciar Sesión</a>
                        <div class="dropdown-menu" method="POST">
                            <form method="POST" class="text-center w-100">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="floatingInput" name="usuario" required>
                                    <label for="floatingInput">Usuario</label>
                                </div>
                                <div class="form-floating">
                                    <input type="password" class="form-control" id="floatingPassword" name="clave"
                                        required>
                                    <label for="floatingPassword">Clave</label>
                                </div>
                                <input type="submit" class="btn btn-primary" name="login" value="Iniciar sesión">
                            </form>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button"
                            aria-haspopup="true" aria-expanded="false">Registrarse</a>
                        <div class="dropdown-menu" method="POST">
                            <form method="POST" class="text-center w-100">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="floatingNombre" name="nombre" required>
                                    <label for="floatingNombre">Nombre de usuario</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="password" class="form-control" id="floatingPasswordRegistro"
                                        name="clave" required>
                                    <label for="floatingPasswordRegistro">Contraseña</label>
                                </div>
                                <div class="form-floating">
                                    <input type="password" class="form-control" id="floatingPasswordConfirmar"
                                        name="confirmar_clave" required>
                                    <label for="floatingPasswordConfirmar">Confirmar contraseña</label>
                                </div>
                                <input type="submit" class="btn btn-primary" name="registro" value="Registrarse">
                            </form>
                        </div>
                    </li>
                </ul>
                <a href="https://www.instagram.com/___andretorres/">
                    <img src="img/instagram.png" alt="Theor">
                </a>
                <form class="d-flex" method="GET">
                    <input class="form-control me-sm-2" type="search" name="inputBuscar" placeholder="Buscar">
                    <button class="btn btn-secondary my-2 my-sm-0" type="submit" name="botonBuscar">Buscar</button>
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
                    <p class="lead">Nos encontramos en Carrer dels Gegants de Sitges, 08870 Sitges, Barcelona, España.
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
    <section class="py-5 bg-light">
        <div class="container px-4 px-lg-5 mt-5">
            <h2 class="fw-bolder mb-4">Related products</h2>
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
            </div>
        </div>
    </section>
    <?php
    $conexion = conectar();
    if ($conexion != null) {

        if (isset($_GET["botonBuscar"])) {
            $busqueda = $_GET["inputBuscar"];
            buscarProductos($busqueda);
        } else {
            listar();
        }
    }
    ?>
    <footer class="py-5 bg-dark">
        <div class="container">
            <p class="m-0 text-center text-white">Copyright &copy; André Jesús Torres</p>
        </div>
    </footer>
    <script src="js/bootstrap.bundle.js"></script>
</body>

</html>