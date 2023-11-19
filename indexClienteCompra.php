<?php
require_once("consultas.php");
session_start();

if (isset($_GET['codigo_producto'])) {
    $codigo_producto = $_GET['codigo_producto'];
    $detalles_producto = obtenerDetallesProducto($codigo_producto);
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
    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <img class="img-fluid" src="<?php echo $detalles_producto['imagen']; ?>" alt="Producto">
                </div>
                <div class="col-md-6">
                    <h1 class="fw-bold display-4">
                        <?php echo $detalles_producto['nombre']; ?> -
                        <?php echo $detalles_producto['marca']; ?>
                    </h1>
                    <p class="lead">Precio: €
                        <?php echo $detalles_producto['precio_sin_impuestos']; ?>
                    </p>
                    <p class="lead">Tasas: €
                        <?php echo $detalles_producto['tasa_impuestos']; ?>
                    </p>
                    <p class="lead text-success">Envío gratis</p>
                    <hr>
                    <h4 class="fw-bold">Precio Final: €
                        <?php echo $detalles_producto['precio_final']; ?>
                    </h4>
                    <button class="btn btn-primary btn-lg mt-4">Comprar</button>
                    <p class="mt-4">Vendido por: Theor</p>
                    <p class="mt-4">
                        Calificaciones y opiniones:
                        <span>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                        </span>
                    </p>
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