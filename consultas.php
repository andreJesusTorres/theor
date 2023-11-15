<?php
require_once("conexion.php");

function listar()
{
    $conexion = conectar();
    if ($conexion != null) {
        $sql = "SELECT * FROM productos WHERE estado=1 ORDER BY categoria ASC, nombre ASC";
        $consulta = mysqli_query($conexion, $sql);
        if (mysqli_num_rows($consulta) > 0) {
            while ($datos = mysqli_fetch_assoc($consulta)) {
                echo '
                <tr>
                    <th scope="row">' . $datos["codigo"] . '</th>
                    <td>' . $datos["categoria"] . '</td>
                    <td>' . $datos["fechaAlta"] . '</td>
                    <td>' . $datos["nombre"] . '</td>
                    <td>' . $datos["precio"] . ' x kg</td>
                    <td>' . $datos["cantidad"] . '</td>
                    <td><img src="' . $datos["imagen"] . '" alt="Producto"></td>
                </tr>
                ';
            }
        }
        mysqli_close($conexion);
    }
}

function listarSesion()
{
    $conexion = conectar();
    if ($conexion != null) {
        $sql = "SELECT * FROM productos ORDER BY categoria ASC, nombre ASC";
        $consulta = mysqli_query($conexion, $sql);
        if (mysqli_num_rows($consulta) > 0) {
            while ($datos = mysqli_fetch_assoc($consulta)) {
                echo '
                    <tr>
                        <th scope="row">' . $datos["codigo"] . '</th>
                        <td>' . $datos["categoria"] . '</td>
                        <td>' . $datos["fechaAlta"] . '</td>
                        <td>' . $datos["nombre"] . '</td>
                        <td>' . $datos["precio"] . ' x kg</td>
                        <td>' . $datos["cantidad"] . '</td>
                        <td>' . $datos["estado"] . '</td>
                        <td>';

                if (!empty($datos["imagen"])) {
                    echo '<img src="' . $datos["imagen"] . '" alt="Imagen del producto" style="max-width: 50px; max-height: 50px;">';
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
                            <form method="POST" action="eliminar.php">
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
        $sql = "SELECT * FROM productos WHERE categoria LIKE '%$busqueda%' OR nombre LIKE '%$busqueda%' OR precio LIKE '%$busqueda%' OR estado LIKE '%$busqueda%'";
        $consulta = mysqli_query($conexion, $sql);
        if (mysqli_num_rows($consulta) > 0) {
            while ($datos = mysqli_fetch_assoc($consulta)) {
                echo '<tr>';
                echo '<th scope="row">' . $datos["codigo"] . '</th>';
                echo '<td>' . $datos["categoria"] . '</td>';
                echo '<td>' . $datos["fechaAlta"] . '</td>';
                echo '<td>' . $datos["nombre"] . '</td>';
                echo '<td>' . $datos["precio"] . ' x kg</td>';
                echo '<td>' . $datos["cantidad"] . '</td>';
                echo '<td>' . $datos["estado"] . '</td>';
                echo '<td>';
                if (!empty($datos["imagen"])) {
                    echo '<img src="' . $datos["imagen"] . '" alt="Imagen del producto" style="max-width: 50px; max-height: 50px;">';
                }
                echo '</td>';
                echo '</tr>';
            }
        } else {
            echo '<tr><td colspan="7">No se encontraron resultados.</td></tr>';
        }
        mysqli_close($conexion);
    }
}


function buscarProductosAdmin($busqueda)
{
    $conexion = conectar();
    if ($conexion != null) {
        $sql = "SELECT * FROM productos WHERE categoria LIKE '%$busqueda%' OR nombre LIKE '%$busqueda%' OR precio LIKE '%$busqueda%' OR estado LIKE '%$busqueda%'";
        $consulta = mysqli_query($conexion, $sql);
        if (mysqli_num_rows($consulta) > 0) {
            while ($datos = mysqli_fetch_assoc($consulta)) {
                echo '
                <tr>
                    <th scope="row">' . $datos["codigo"] . '</th>
                    <td>' . $datos["categoria"] . '</td>
                    <td>' . $datos["fechaAlta"] . '</td>
                    <td>' . $datos["nombre"] . '</td>
                    <td>' . $datos["precio"] . ' x kg</td>
                    <td>' . $datos["cantidad"] . '</td>
                    <td>' . $datos["estado"] . '</td>
                    <td><img src="' . $datos["imagen"] . '" alt="Imagen del producto" style="max-width: 50px;"></td>
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

if (isset($_POST["botonModificar"])) {
    $codigo = $_POST["inputCodigo"];
    $categoria = $_POST["inputCategoria"];
    $fechaAlta = $_POST["inputFecha"];
    $nombre = $_POST["inputNombre"];
    $precio = $_POST["inputPrecio"];
    $estado = $_POST["inputEstado"];
    $imagen = $_FILES["inputImagen"]["name"];
    $imagen_temporal = $_FILES["inputImagen"]["tmp_name"];

    if (!empty($imagen)) {
        $ruta_destino = "img/" . $imagen;
        move_uploaded_file($imagen_temporal, $ruta_destino);
        $sql = "UPDATE productos SET categoria='$categoria', fechaAlta='$fechaAlta', nombre='$nombre', precio='$precio', estado='$estado', imagen='$ruta_destino' WHERE codigo='$codigo'";
    } else {
        $sql = "UPDATE productos SET categoria='$categoria', fechaAlta='$fechaAlta', nombre='$nombre', precio='$precio', estado='$estado' WHERE codigo='$codigo'";
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
    $categoria = $_POST["inputCategoria"];
    $nombre = $_POST["inputNombre"];
    $precio = $_POST["inputPrecio"];
    $estado = $_POST["inputEstado"];
    $imagen = $_FILES["inputImagen"]["name"];
    $imagen_temporal = $_FILES["inputImagen"]["tmp_name"];

    $ruta_destino = "img/" . $imagen;
    move_uploaded_file($imagen_temporal, $ruta_destino);

    $sql = "INSERT INTO productos (categoria, nombre, precio, estado, imagen) VALUES ('$categoria', '$nombre', '$precio', '$estado', '$ruta_destino')";
    $guardar = mysqli_query($conexion, $sql);

    if (!$guardar) {
        echo "Se ha producido algún error";
    } else {
        $guardado = "exitoso";
    }

    mysqli_close($conexion);
}

if (isset($_POST["login"])) {
    $usuario = $_POST["usuario"];
    $clave = $_POST["clave"];
    $conexion = conectar();

    if (!$conexion) {
        die("Error en la conexión: " . mysqli_connect_error());
    }

    $sql = "SELECT * FROM login WHERE usuario = '$usuario' AND clave = '$clave'";
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
            $claveEncriptada = password_hash($clave, PASSWORD_DEFAULT);
            $sqlRegistro = "INSERT INTO login (usuario, clave) VALUES ('$nombre', '$claveEncriptada')";
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