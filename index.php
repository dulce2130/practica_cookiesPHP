<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit;
}
if (!isset($_COOKIE['productos'])) {
    $productos = array(
        array("codigo" => "1234567891", "nombre" => "Doritos", "marca" => "Sabritas", "pu" => '$15')
    );

    $productos_json = json_encode($productos);
    setcookie('productos', $productos_json, time() + (14 * 24 * 60 * 60), '/');
}
if (!isset($_COOKIE['proveedores'])) {
    $proveedores = array(
        array("cvm" => "001", "nombre" => "Sabritas", "nombre_rep" => "Lisa Braeden")
    );

    $proveedores_json = json_encode($proveedores);
    setcookie('proveedores', $proveedores_json, time() + (14 * 24 * 60 * 60), '/');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
</head>

<link rel="stylesheet" href="css/estilo.css">
<script src = "js/funciones.js"></script>

<body>

    <h1>¡Bienvenido(a),
        <?php echo $_SESSION['usuario']; ?>!
    </h1>
    <div id="logout" onclick="javascript:menuUsuarios('logout')">Cerrar Sesión</div>

    <div id="menu">
        <input class="boton" type="button" value="Persona" onclick="javascript:opcion(this.value, 'listar')" >
        <input class="boton" type="button" id="producto" value="Producto" onclick="javascript:opcion(this.value, 'listar')" >
        <input class="boton" type="button" value="Proveedor" onclick="javascript:opcion(this.value, 'listar')">
    </div>

    <div id="contenido"></div>


</body>

</html>

<?php
session_destroy();
?>