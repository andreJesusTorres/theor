<?php
require_once("consultas.php");
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Theor Admin
        <?php if (isset($_GET['gestionarUsuarios']))
            echo ' - Gestionar Usuarios'; ?>
    </title>
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
                        <a class="nav-link active" href="indexAdmin.php">Home
                            <span class="visually-hidden">(current)</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="nuevo.php">Agregar producto</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="indexAdmin.php?gestionarUsuarios">Gestionar Usuarios</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="index.php" onclick="cerrarSesion()">Cerrar Sesión
                            <span class="visually-hidden">(current)</span>
                        </a>
                    </li>
                </ul>
                <form class="d-flex">
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
            .table img {
                max-width: 50px;
                max-height: 50px;
            }
        </style>
        <div class="container-fluid">';

        if (!isset($_GET["gestionarUsuarios"])) {
            echo '
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Código</th>
                            <th scope="col">Marca</th>
                            <th scope="col">Fecha</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Precio</th>
                            <th scope="col">Cantidad</th>
                            <th scope="col">Estado</th>
                            <th scope="col">Imagen</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>';

            if (isset($_GET["botonBuscar"])) {
                $busqueda = $_GET["inputBuscar"];
                buscarProductosAdmin($busqueda);
            } else {
                listarSesion();
            }

            echo '
                    </tbody>
                </table>
            </div>';
        }

        echo '</div>';
    }

    if (isset($_GET["gestionarUsuarios"])) {
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
            .table img {
                max-width: 50px;
                max-height: 50px;
            }
        </style>
        <div class="container-fluid">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Usuario</th>
                            <th scope="col">Clave</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>';

        listarUsuarios();

        echo '
                </tbody>
            </table>
        </div>
    </div>';
    }
    ?>

    <script>
        function editarUsuario(id) {
            window.location.href = 'editarUsuario.php?id=' + id;
        }

        function eliminarUsuario(id) {
            var confirmacion = confirm('¿Realmente desea eliminar este usuario?');
            if (confirmacion) {
                eliminarUsuarioServidor(id);
            }
        }

        function eliminarUsuarioServidor(id) {
            fetch(`eliminarUsuario.php?id=${id}`, { method: 'DELETE' })
                .then(response => response.ok ? response.text() : Promise.reject('Error al eliminar el usuario.'))
                .then(data => {
                    alert(`Usuario eliminado con éxito. ID: ${id}`);
                    // Aquí puedes redirigir o realizar otras acciones necesarias
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Hubo un error al eliminar el usuario.');
                });
        }
    </script>



</body>

</html>