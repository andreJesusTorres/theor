<?php
require("conexion.php");
require("consultas.php");

if (!isset($_GET["id"])) {
    header("location:indexAdmin.php");
    exit();
} else {
    $conexion = conectar();
    $idUsuario = $_GET["id"];
    $sql = "SELECT * FROM login WHERE id = '$idUsuario'";
    $buscar = mysqli_query($conexion, $sql);

    if (mysqli_num_rows($buscar) > 0) {
        $datos = mysqli_fetch_assoc($buscar);
    } else {
        header("location:indexAdmin.php");
        exit();
    }

    mysqli_close($conexion);
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Theor Admin: Editar Usuario</title>
    <link rel="icon" href="img/icono.png" type="image/x-icon" />
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
                        <a class="nav-link" href="nuevo.php">Agregar producto</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="indexAdmin.php?gestionarUsuarios">Gestionar Usuarios</a>
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
                <a href="https://github.com/andreJesusTorres">
                    <img src="img/github.png" alt="Theor">
                </a>
                <form class="d-flex">
                    <input class="form-control me-sm-2" type="search" name="inputBuscar" placeholder="Buscar">
                    <button class="btn btn-secondary my-2 my-sm-0" type="submit" name="botonBuscar">Buscar</button>
                </form>
            </div>
        </div>
    </nav>

    <form method="POST" enctype="multipart/form-data">
        <?php if (isset($usuarioModificado)): ?>
            <div class="alert alert-dismissible alert-success">
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                <strong>Modificación exitosa!</strong> El usuario se modificó correctamente.
            </div>
        <?php endif; ?>

        <?php if (isset($usuarioNoModificado)): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error!</strong> No se pudo modificar el usuario.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <?php if (isset($caracteres)): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error!</strong> El nombre de usuario y la contraseña deben tener al menos 5 caracteres.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <div class="container col-6">
            <div class="mb-3">
                <label class="form-label">ID</label>
                <input type="text" name="inputID" class="form-control" value="<?php echo $datos['id']; ?>" readonly>
            </div>
            <div class="mb-3">
                <label class="form-label">Usuario</label>
                <input type="text" name="inputUsuario" class="form-control" value="<?php echo $datos['usuario']; ?>"
                    required>
            </div>
            <div class="mb-3">
                <label class="form-label">Correo Electrónico</label>
                <input type="email" name="inputCorreo" class="form-control" value="<?php echo $datos['correo']; ?>"
                    required>
            </div>
            <div class="mb-3">
                <label class="form-label">Clave</label>
                <input type="password" name="inputClave" class="form-control" value="<?php echo $datos['clave']; ?>"
                    required>
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="adminCheckbox" name="inputAdmin" value="1" <?php echo $datos['admin'] == 1 ? 'checked' : ''; ?>>
                <label class="form-check-label" for="adminCheckbox">Administrador</label>
            </div>
        </div>
        <div class="d-flex justify-content-center mt-2">
            <div style="margin-right: 10%;">
                <a class="btn btn-lg btn-outline-primary" href="indexAdmin.php?gestionarUsuarios"">Volver</a>
            </div>
            <div>
                <button class=" btn btn-lg btn-outline-primary" name="botonModificarUsuario">Modificar</button>
            </div>
        </div>
    </form>
    <footer class="py-5 bg-dark">
        <div class="container">
            <p class="m-0 text-center text-white">Copyright &copy; André Jesús Torres</p>
        </div>
    </footer>
    <script src="js/bootstrap.bundle.js"></script>
</body>

</html>