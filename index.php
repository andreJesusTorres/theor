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

    <img src="img/almacen.png" style="width: 100%;" alt="Almacén 'El Pepe'">
    <nav class="navbar navbar-expand-lg bg-light" data-bs-theme="light">
        <div class="container-fluid">
            <img src="img/pepe-argento.png" alt="Logo del Almacén 'El Pepe'">
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

    <?php
    $conexion = conectar();
    if ($conexion != null) {
        echo '
        <style>
            .container-fluid {
                padding-left: 0;
                padding-right: 0;
            }
            .table-responsive {
                margin: 0 auto;
            }
            .table td,
            .table th {
                text-align: center;
            }
        </style>
        <div class="container-fluid">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Código</th>
                            <th scope="col">Categoría</th>
                            <th scope="col">Fecha</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Precio</th>
                            <th scope="col">Cantidad</th>
                            <th scope="col">Imagen</th>
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
            </div>
        </div>';
    }
    ?>


    <script src="js/bootstrap.bundle.js"></script>
</body>

</html>