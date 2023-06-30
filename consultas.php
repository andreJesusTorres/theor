<?php
require_once("conexion.php");

function listar()
{
    $conexion = conectar();
    if ($conexion != null) {
        $sql = "SELECT * FROM productos WHERE estado=1";
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
        $sql = "SELECT * FROM productos";
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
                    <td>' . $datos["estado"] . '</td>
                    <td>
                        <form method="GET" action="editar.php">
                            <button class="btn btn-sm btn-outline-dark" name="codigo" value="' . $datos["codigo"] . '">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </button>
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
    session_destroy();
    header("location:index.php");
}

function buscarProductos($busqueda)
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
                    <td>' . $datos["estado"] . '</td>                   
                </tr>';
            }
        } else {
            echo '<tr><td colspan="6">No se encontraron resultados.</td></tr>';
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
                    <td>' . $datos["estado"] . '</td>
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
            echo '<tr><td colspan="6">No se encontraron resultados.</td></tr>';
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
    $sql = "UPDATE productos SET categoria='$categoria', fechaAlta='$fechaAlta', nombre='$nombre', precio='$precio', estado='$estado' WHERE codigo='$codigo'";
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
    $sql = "INSERT INTO productos (categoria, nombre, precio, estado) VALUES ('$categoria', '$nombre', '$precio', '$estado')";
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
        $_SESSION["logged_in"] = true;
        header("Location: indexAdmin.php");
        exit();
    } else {
        exit();
        
    }
}
?>
