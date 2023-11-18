<?php
require_once("conexion.php");
function listar()
{
    $conexion = conectar();
    if ($conexion != null) {
        echo '
        <section class="py-5 bg-light">
            <div class="container px-4 px-lg-5 mt-5">
                <h2 class="fw-bolder mb-4">Nuestros productos</h2>
                <div class="row gx-4 gx-lg-5 row-cols-1 row-cols-md-2 row-cols-xl-3 justify-content-center">';

        $sql = "SELECT * FROM productos WHERE estado=1 ORDER BY marca ASC, nombre ASC";
        $consulta = mysqli_query($conexion, $sql);
        if (mysqli_num_rows($consulta) > 0) {
            while ($datos = mysqli_fetch_assoc($consulta)) {
                echo '
                    <div class="col mb-5">
                        <div class="card h-100">
                            <img class="card-img-top" src="' . $datos["imagen"] . '" alt="Product image">
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <h5 class="fw-bolder">' . $datos["nombre"] . '</h5>
                                    €' . $datos["precio"] . '
                                </div>
                            </div>
                        </div>
                    </div>
                ';
            }
        }

        echo '
                </div>
            </div>
        </section>';
        mysqli_close($conexion);
    }
}
function listarSesion()
{
    $conexion = conectar();
    if ($conexion != null) {
        $sql = "SELECT * FROM productos ORDER BY marca ASC, nombre ASC";
        $consulta = mysqli_query($conexion, $sql);
        if (mysqli_num_rows($consulta) > 0) {
            while ($datos = mysqli_fetch_assoc($consulta)) {
                echo '
                    <tr>
                        <th scope="row">' . $datos["codigo"] . '</th>
                        <td>' . $datos["marca"] . '</td>
                        <td>' . $datos["fechaAlta"] . '</td>
                        <td>' . $datos["nombre"] . '</td>
                        <td>€' . $datos["precio"] . '</td>
                        <td>' . $datos["cantidad"] . '</td>
                        <td>';

                // Mostrar un ícono para representar el estado del producto
                echo ($datos["estado"] == 1) ? '<i class="fas fa-check-circle text-success"></i>' : '<i class="fas fa-times-circle text-danger"></i>';

                echo '</td>
                        <td>';

                if (!empty($datos["imagen"])) {
                    echo '<img src="' . $datos["imagen"] . '" alt="Imagen del producto" style="max-width: 40px; max-height: 40px;">';
                }

                echo '</td>
                        <td>
                            <form method="GET" action="editar.php">
                                <button class="btn btn-sm btn-outline-dark" name="codigo" value="' . $datos["codigo"] . '">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </button>
                            </form>
                        </td>
                        <td>
                            <form method="POST">
                                <input type="hidden" name="codigo" value="' . $datos["codigo"] . '">
                                <button class="btn btn-sm btn-outline-danger" name="botonEliminar">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                ';
            }
        }
        mysqli_close($conexion);
    }
}
function listarUsuarios()
{
    $conexion = conectar();
    if ($conexion != null) {
        $sql = "SELECT * FROM login";
        $consulta = mysqli_query($conexion, $sql);
        if (mysqli_num_rows($consulta) > 0) {
            while ($datos = mysqli_fetch_assoc($consulta)) {
                echo '
                    <tr>
                        <th scope="row">' . $datos["id"] . '</th>
                        <td>' . $datos["usuario"] . '</td>
                        <td>' . $datos["correo"] . '</td>
                        <td>' . $datos["clave"] . '</td>
                        <td>
                            <button class="btn btn-sm btn-outline-dark" onclick="editarUsuario(' . $datos["id"] . ')">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </button>
                        </td>
                        <td>
                            <form method="POST">
                                <input type="hidden" name="idUsuario" value="' . $datos["id"] . '">
                                <button class="btn btn-sm btn-outline-danger" name="botonEliminarUsuario">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                ';
            }
        } else {
            echo '<tr><td colspan="4">No se encontraron usuarios.</td></tr>';
        }

    }
}
function logout()
{
    session_start();
    session_destroy();
    header("location:index.php");
    exit();
}
function buscarProductos($busqueda)
{
    $conexion = conectar();
    if ($conexion != null) {
        echo '<table class="table table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Código</th>
                        <th scope="col">Marca</th>
                        <th scope="col">Fecha Alta</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Cantidad</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Imagen</th>
                    </tr>
                </thead>
                <tbody>';

        $sql = "SELECT * FROM productos WHERE marca LIKE '%$busqueda%' OR nombre LIKE '%$busqueda%' OR precio LIKE '%$busqueda%' OR estado LIKE '%$busqueda%'";
        $consulta = mysqli_query($conexion, $sql);
        if (mysqli_num_rows($consulta) > 0) {
            while ($datos = mysqli_fetch_assoc($consulta)) {
                echo '<tr>';
                echo '<td>' . $datos["codigo"] . '</td>';
                echo '<td>' . $datos["marca"] . '</td>';
                echo '<td>' . $datos["fechaAlta"] . '</td>';
                echo '<td>' . $datos["nombre"] . '</td>';
                echo '€<td>' . $datos["precio"] . '</td>';
                echo '<td>' . $datos["cantidad"] . '</td>';
                echo '<td>' . $datos["estado"] . '</td>';
                echo '<td>';
                if (!empty($datos["imagen"])) {
                    echo '<img src="' . $datos["imagen"] . '" alt="Imagen del producto" style="max-width: 40px; max-height: 40px;">';
                }
                echo '</td>';
                echo '</tr>';
            }
        } else {
            echo '<tr><td colspan="8">No se encontraron resultados.</td></tr>';
        }
        echo '</tbody></table>';
        mysqli_close($conexion);
    }
}
function buscarProductosAdmin($busqueda)
{

    $conexion = conectar();
    if ($conexion != null) {
        $sql = "SELECT * FROM productos WHERE marca LIKE '%$busqueda%' OR nombre LIKE '%$busqueda%' OR precio LIKE '%$busqueda%' OR estado LIKE '%$busqueda%'";
        $consulta = mysqli_query($conexion, $sql);
        if (mysqli_num_rows($consulta) > 0) {
            while ($datos = mysqli_fetch_assoc($consulta)) {
                echo '
                <tr>
                    <th scope="row">' . $datos["codigo"] . '</th>
                    <td>' . $datos["marca"] . '</td>
                    <td>' . $datos["fechaAlta"] . '</td>
                    <td>' . $datos["nombre"] . '</td>
                    <td>€' . $datos["precio"] . ' </td>
                    <td>' . $datos["cantidad"] . '</td>
                    <td>' . $datos["estado"] . '</td>
                    <td><img src="' . $datos["imagen"] . '" alt="Imagen del producto" style="max-width: 40px; max-height: 40px;"></td>
                    <td>
                        <form method="GET" action="editar.php">
                            <button class="btn btn-sm btn-outline-dark" name="codigo" value="' . $datos["codigo"] . '">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </button>
                        </form>
                    </td>
                </tr>';
            }
        } else {
            echo '<tr><td colspan="7">No se encontraron resultados.</td></tr>';
        }
        mysqli_close($conexion);
    }
}
function buscarUsuarios($busqueda)
{

    $conexion = conectar();
    if ($conexion != null) {
        $sql = "SELECT * FROM usuarios WHERE usuario LIKE '%$busqueda%' OR id LIKE '%$busqueda%' OR clave LIKE '%$busqueda%'";
        $consulta = mysqli_query($conexion, $sql);
        if (mysqli_num_rows($consulta) > 0) {
            while ($datos = mysqli_fetch_assoc($consulta)) {
                echo '
                <tr>
                    <td>' . $datos["id"] . '</td>
                    <td>' . $datos["usuario"] . '</td>
                    <td>' . $datos["correo"] . '</td>
                    <td>' . $datos["clave"] . '</td>
                    <td>
                        <form method="GET" action="editarUsuario.php">
                            <button class="btn btn-sm btn-outline-dark" name="idUsuario" value="' . $datos["id"] . '">
                                Editar
                            </button>
                        </form>
                    </td>
                    <td>
                        <form method="POST" action="eliminarUsuario.php">
                            <input type="hidden" name="idUsuario" value="' . $datos["id"] . '">
                            <button class="btn btn-sm btn-outline-danger" name="botonEliminar">Eliminar</button>
                        </form>
                    </td>
                </tr>';
            }
        } else {
            echo '<tr><td colspan="4">No se encontraron resultados.</td></tr>';
        }
        mysqli_close($conexion);
    }
}

if (isset($_POST["botonModificarUsuario"])) {

    $idUsuario = $_POST["inputID"];
    $usuario = $_POST["inputUsuario"];
    $correo = $_POST["inputCorreo"];
    $clave = $_POST["inputClave"];

    $conexion = conectar();

    if ($conexion != null) {
        if (strlen($usuario) < 5 || strlen($clave) < 5) {
            $caracteres = "error";
        } else {
            $sql = "UPDATE login SET usuario=?, correo=?, clave=? WHERE id=?";
            $stmt = mysqli_prepare($conexion, $sql);

            mysqli_stmt_bind_param($stmt, "sssi", $usuario, $correo, $clave, $idUsuario);

            $modificar = mysqli_stmt_execute($stmt);

            if (!$modificar) {
                $usuarioNoModificado = "error";
            } else {
                $usuarioModificado = "exito";
            }

            mysqli_stmt_close($stmt);
        }
        mysqli_close($conexion);
    }
}

if (isset($_POST["botonEliminarUsuario"])) {
    $idUsuario = $_POST["idUsuario"];
    $conexion = conectar();

    if ($conexion != null) {
        $sql = "DELETE FROM login WHERE id = '$idUsuario'";
        $eliminar = mysqli_query($conexion, $sql);

        if (!$eliminar) {
            echo "Error al eliminar el usuario.";
        }

        mysqli_close($conexion);
    }
}

if (isset($_POST["botonModificar"])) {

    $codigo = $_POST["inputCodigo"];
    $marca = $_POST["inputMarca"];
    $fechaAlta = $_POST["inputFecha"];
    $nombre = $_POST["inputNombre"];
    $precio = $_POST["inputPrecio"];
    $estado = $_POST["inputEstado"];
    $cantidad = $_POST["inputCantidad"];
    $imagen = $_FILES["inputImagen"]["name"];
    $imagen_temporal = $_FILES["inputImagen"]["tmp_name"];
    if ($cantidad == 0) {
        $estado = 0;
    } else {
        $estado = 1;
    }

    if (!empty($imagen)) {
        $ruta_destino = "img/productos/" . $imagen;
        move_uploaded_file($imagen_temporal, $ruta_destino);
        $sql = "UPDATE productos SET marca='$marca', fechaAlta='$fechaAlta', nombre='$nombre', precio='$precio', estado='$estado', cantidad='$cantidad', imagen='$ruta_destino' WHERE codigo='$codigo'";
    } else {
        $sql = "UPDATE productos SET marca='$marca', fechaAlta='$fechaAlta', nombre='$nombre', precio='$precio', estado='$estado', cantidad='$cantidad' WHERE codigo='$codigo'";
    }

    $conexion = conectar();
    $modificar = mysqli_query($conexion, $sql);

    if (!$modificar) {
        echo "Se ha producido algún error";
    } else {
        $guardado = "exitoso";
    }
    mysqli_close($conexion);
}

if (isset($_POST["botonGuardar"])) {

    $conexion = conectar();
    $marca = $_POST["inputMarca"];
    $nombre = $_POST["inputNombre"];
    $precio = $_POST["inputPrecio"];
    $estado = $_POST["inputEstado"];
    $cantidad = $_POST["inputCantidad"];
    $imagen = $_FILES["inputImagen"]["name"];
    $imagen_temporal = $_FILES["inputImagen"]["tmp_name"];
    if ($cantidad == 0) {
        $estado = 0;
    } else {
        $estado = 1;
    }

    $ruta_destino = "img/productos/" . $imagen;
    move_uploaded_file($imagen_temporal, $ruta_destino);

    $sql = "INSERT INTO productos (marca, nombre, precio, estado, cantidad, imagen) VALUES ('$marca', '$nombre', '$precio', '$estado', '$cantidad', '$ruta_destino')";
    $guardar = mysqli_query($conexion, $sql);

    if (!$guardar) {
        echo "Se ha producido algún error";
    } else {
        $guardado = "exitoso";
    }

    mysqli_close($conexion);
}

if (isset($_POST["botonEliminar"])) {
    $codigo = $_POST["codigo"];
    $conexion = conectar();
    if ($conexion != null) {
        $sql = "DELETE FROM productos WHERE codigo = '$codigo'";
        $eliminar = mysqli_query($conexion, $sql);
        if (!$eliminar) {
            echo "Se ha producido algún error al eliminar el producto.";
        }
        mysqli_close($conexion);
    }
}

if (isset($_POST["login"])) {

    $nombre = $_POST["usuario"];
    $clave = $_POST["clave"];
    $conexion = conectar();

    if (!$conexion) {
        die("Error en la conexión: " . mysqli_connect_error());
    }

    $sql = "SELECT * FROM login WHERE usuario = '$nombre' AND clave = '$clave'";
    $result = mysqli_query($conexion, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        mysqli_close($conexion);
        session_start();
        $_SESSION["logged_in"] = true;
        header("Location: indexAdmin.php");
        exit();
    } else {
        $loginError = "error";
    }
}

if (isset($_POST["registro"])) {

    $nombre = $_POST["nombre"];
    $clave = $_POST["clave"];
    $confirmarClave = $_POST["confirmar_clave"];

    $conexion = conectar();

    if (!$conexion) {
        die("Error en la conexión: " . mysqli_connect_error());
    }

    if ($clave !== $confirmarClave) {
        $contraseñasCoincidencia = "error";
    } elseif (strlen($nombre) < 5 || strlen($clave) < 5) {
        $caracteres = "error";
    } else {
        $sqlVerificarUsuario = "SELECT * FROM login WHERE usuario = '$nombre'";
        $resultVerificarUsuario = mysqli_query($conexion, $sqlVerificarUsuario);

        if ($resultVerificarUsuario && mysqli_num_rows($resultVerificarUsuario) > 0) {
            $nombreEnUso = "error";
        } else {
            $sqlRegistro = "INSERT INTO login (usuario, clave) VALUES ('$nombre', '$clave')";
            $resultRegistro = mysqli_query($conexion, $sqlRegistro);

            if ($resultRegistro) {
                $guardadoRegistro = "exito";
            } else {
                $errorRegistro = "error";
            }
        }
    }

    mysqli_close($conexion);
}
?>