<?php
require("conexion.php");
require("consultas.php");

if (!isset($_GET["codigo"])) {
    header("location:index.php");
} else {
    $conexion = conectar();
    $sql = "SELECT * FROM productos WHERE codigo='" . $_GET["codigo"] . "'";
    $buscar = mysqli_query($conexion, $sql);
    if (mysqli_num_rows($buscar) > 0) {
        $datos = mysqli_fetch_assoc($buscar);
    }
    mysqli_close($conexion);
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
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
                        <a class="nav-link active" href="indexAdmin.php">Home
                            <span class="visually-hidden">(current)</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="nuevo.php">Agregar producto</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="index.php" onclick="cerrarSesion()">Cerrar Sesión
                            <span class="visually-hidden">(current)</span>
                        </a>
                    </li>
                </ul>
                <form class="d-flex">
                    <input class="form-control me-sm-2" type="search" name="inputBuscar" placeholder="Buscar">
                    <button class="btn btn-secondary my-2 my-sm-0" type="submit">Buscar</button>
                </form>
            </div>
        </div>
    </nav>

    <form method="POST" enctype='multipart/form-data'>
        <?php if (isset($guardado)): ?>
            <div class="alert alert-dismissible alert-success">
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                <strong>Guardado exitoso!</strong> El producto se modificó correctamente.
            </div>
        <?php endif; ?>
        <div class="container col-6">
            <div class="mb-3">
                <label class="form-label">Código</label>
                <input type="text" name="inputCodigo" class="form-control" placeholder="Código del producto"
                    value="<?php echo $_GET['codigo']; ?>" readonly="">
            </div>
            <div class="mb-3">
                <label class="form-label">Categoría</label>
                <input type="text" name="inputCategoria" class="form-control" placeholder="Categoría del producto"
                    value="<?php echo $datos["categoria"]; ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Fecha</label>
                <input type="date" name="inputFecha" class="form-control" value="<?php echo $datos["fechaAlta"]; ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Nombre</label>
                <input type="text" name="inputNombre" class="form-control" placeholder="Nombre del producto"
                    value="<?php echo $datos["nombre"]; ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Precio</label>
                <input type="text" name="inputPrecio" class="form-control" placeholder="Precio del producto"
                    value="<?php echo $datos["precio"]; ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Cantidad</label>
                <input type="text" name="inputCantidad" class="form-control" placeholder="Cantidad del producto"
                    value="<?php echo $datos["cantidad"]; ?>" required>
            </div>
            <div>
                <label class="form-label">Estado</label>
                <input type="text" name="inputEstado" class="form-control" placeholder="Estado del producto" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Imagen</label>
                <input type="file" name="inputImagen" class="form-control" accept="image/*" required>
            </div>
            <div class="mb-3">
                <label for="enlace">Haz clic para descargar las imagenes</label>
                <a id="enlace" href="https://icons8.com/icon/set/Emoji/emoji" target="_blank">Enlace</a>
            </div>
        </div>
        <div class="d-flex justify-content-center mt-2">
            <div style="margin-right:a 10%;">
                <a class="btn btn-lg btn-outline-primary" href="indexAdmin.php">Volver</a>
            </div>
            <div>
                <button class="btn btn-lg btn-outline-primary" name="botonModificar">Modificar</button>
            </div>
        </div>
    </form>
    <script src="js/bootstrap.bundle.js"></script>
</body>

</html>