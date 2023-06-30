<?php
require_once("consultas.php");
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Almacén</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-primary" data-bs-theme="dark">
        <div class="container-fluid">
            <img src="img/pepe-argento.png" alt="Logo del Almacén 'El Pepe'">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarColor01">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="index.php">Home
                            <span class="visually-hidden">(current)</span>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Iniciar Sesión</a>
                        <div class="dropdown-menu" method="POST">
                            <form method="POST" class="text-center w-100">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="floatingInput" name="usuario" required>
                                    <label for="floatingInput">Usuario</label>
                                </div>
                                <div class="form-floating">
                                    <input type="password" class="form-control" id="floatingPassword" name="clave" required>
                                    <label for="floatingPassword">Clave</label>
                                </div>
                                <input type="submit" class="btn btn-primary" name="login" value="Iniciar sesión">
                            </form>
                        </div>
                    </li>
                </ul>
                <form class="d-flex" method="GET">
                    <input class="form-control me-sm-2" type="search" name="inputBuscar" placeholder="Buscar">
                    <button class="btn btn-secondary my-2 my-sm-0" type="submit" name="botonBuscar">Buscar</button>
                </form>
            </div>
        </div>
    </nav>

    <?php
    $conexion = conectar();
    if ($conexion != null) {
        echo '
        <div class="container" style="height: 80vh;">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Código</th>
                        <th scope="col">Categoría</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Precio</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>';

        if (isset($_GET["botonBuscar"])) {
            $busqueda = $_GET["inputBuscar"];
            buscarProductos($busqueda);
        } else {
            listar();
        }

        echo '
                </tbody>
            </table>
        </div>';
    }
    ?>

    <script src="js/bootstrap.bundle.js"></script>
</body>

</html>
