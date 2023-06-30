<?php
require_once("conexion.php");

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
header("Location: indexAdmin.php");
exit();
?>