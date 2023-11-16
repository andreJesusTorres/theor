<?php
require("conexion.php");
require("consultas.php");
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Theor Admin: Agregar Producto</title>
    <link rel="icon" href="img/icono.png" type="image/x-icon" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
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
                        <a class="nav-link" href="indexAdmin.php">Home
                            <span class="visually-hidden">(current)</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="nuevo.php">Agregar producto</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="indexAdmin.php?gestionarUsuarios">Gestionar Usuarios</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php" onclick="cerrarSesion()">Cerrar Sesión
                            <span class="visually-hidden">(current)</span>
                        </a>
                    </li>
                </ul>
                <a href="https://www.instagram.com/___andretorres/">
                    <img src="img/instagram.png" alt="Theor">
                </a>
                <form class="d-flex">
                    <input class="form-control me-sm-2" type="search" name="inputBuscar" placeholder="Buscar">
                    <button class="btn btn-secondary my-2 my-sm-0" type="submit" name="botonBuscar">Buscar</button>
                </form>
            </div>
        </div>
    </nav>
    <form method="POST" enctype='multipart/form-data'>
        <?php
        if (isset($guardado)) {
            echo '<div class="alert alert-dismissible alert-success">
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    <strong>Guardado exitoso!</strong> El producto se guardó correctamente.
                </div>';
        }
        ?>
        <div class="container col-6">
            <div class="mb-3">
                <label class="form-label">Código</label>
                <input type="text" name="inputCodigo" class="form-control" placeholder="Código del producto" disabled>
            </div>
            <div class="mb-3">
                <label class="form-label">Marca</label>
                <input type="text" name="inputMatca" class="form-control" placeholder="Matca del producto" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Fecha</label>
                <input type="date" name="inputFecha" class="form-control" readonly="">
            </div>
            <div class="mb-3">
                <label class="form-label">Nombre</label>
                <input type="text" name="inputNombre" class="form-control" placeholder="Nombre del producto" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Precio</label>
                <input type="text" name="inputPrecio" class="form-control" placeholder="Precio del producto" required>
            </div>
            <div>
                <label class="form-label">Estado</label>
                <input type="text" name="inputEstado" class="form-control" placeholder="Estado del producto" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Cantidad</label>
                <input type="text" name="inputCantidad" class="form-control" placeholder="Cantidad del producto">
            </div>
            <div class="mb-3">
                <label class="form-label">Imagen</label>
                <input type="file" name="inputImagen" class="form-control" accept="image/*" required>
            </div>
            <div class="d-flex justify-content-center mt-2">
                <div style="margin-right: 10%;">
                    <a class="btn btn-lg btn-outline-primary" href="indexAdmin.php">Volver</a>
                </div>
                <div>
                    <button class="btn btn-lg btn-outline-primary" name="botonGuardar">Guardar</button>
                </div>
            </div>
    </form>
    <script src="js/bootstrap.bundle.js"></script>
</body>

</html>