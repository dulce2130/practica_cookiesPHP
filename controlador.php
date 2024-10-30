<?php
session_start();


switch ($_POST['opcion']) {
    case 'Persona':
        $id = $_POST['id'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        switch ($_POST['acc']) {
            case 'agregar':
                agregarUsuario($id, $username, $password);
                break;
            case 'modificar':
                modificarUsuario($id, $username, $password);
                break;
            case 'eliminar':
                eliminarUsuario($id);
                break;
            case 'logout':
                logout();
                break;
        }
      
        break;
    case 'Producto':
        $codigo = $_POST['codigo'];
        $nombre = $_POST['nombre'];
        $marca = $_POST['marca'];
        $pu = $_POST['pu'];

        switch ($_POST['acc']) {
            case 'agregar':
                agregarProducto($codigo, $nombre, $marca, $pu);
                break;
            case 'modificar':
                modificarProducto($codigo, $nombre, $marca, $pu);
                break;  
            case 'eliminar':
                eliminarProducto($codigo);
                break;
        }
        break;

    case 'BuscarProducto':
        $codigo = $_POST['codigo'];
        BuscarProducto($codigo);
        break;

    case 'Proveedor':
        $cvm = $_POST['cvm'];
        $nombre = $_POST['nombre'];
        $representante = $_POST['nombre_rep'];
        
        switch ($_POST['acc']) {
            case 'agregar':
                agregarProovedor($cvm, $nombre, $representante);
                break;
            case 'modificar':
                modificarProveedor($cvm, $nombre, $representante);
                break;
            case 'eliminar':
                eliminarProveedor($cvm);
                break;
        }
        break;
 
}
function agregarUsuario($id, $username, $password) {
    $usuarios = isset($_COOKIE['usuarios']) ? json_decode($_COOKIE['usuarios'], true) : [];

    $nuevoUsuario = array(
        "id" => $id,
        "username" => $username,
        "password" => $password
    );

    $usuarios[] = $nuevoUsuario;
    $usuarios_json = json_encode($usuarios);
    //echo $usuarios_json;

    setcookie('usuarios', $usuarios_json, time() + (14 * 24 * 60 * 60), '/');
    //echo $usuarios_json;
    echo "Usuario agregado con exito";

    return $usuarios;
}

function agregarProducto($codigo, $nombre, $marca, $pu) {
    $productos= isset($_COOKIE['productos']) ? json_decode($_COOKIE['productos'], true) : [];

    $nuevoProducto = array(
        "codigo" => $codigo,
        "nombre" => $nombre,
        "marca" => $marca,
        "pu" => "$".$pu
    );

    $productos[] = $nuevoProducto;
    $productos_json = json_encode($productos);

    setcookie('productos', $productos_json, time() + (14 * 24 * 60 * 60), '/');
    echo $productos_json;
    echo "Producto agregado con exito";

    return $productos;
}

function agregarProovedor($cvm, $nombre, $representante) {
    $proveedores= isset($_COOKIE['proveedores']) ? json_decode($_COOKIE['proveedores'], true) : [];

    $nuevoProveedor = array(
        "cvm" => $cvm,
        "nombre" => $nombre,
        "nombre_rep" => $representante,
    );

    $proveedores[] = $nuevoProveedor;
    $proveedores_json = json_encode($proveedores);

    setcookie('proveedores', $proveedores_json, time() + (14 * 24 * 60 * 60), '/');
    echo $proveedores_json;
    echo "Producto agregado con exito";

    return $proveedores;
}

function modificarUsuario($id, $username, $password){
    $usuarios = isset($_COOKIE['usuarios']) ? json_decode($_COOKIE['usuarios'], true) : [];

    foreach ($usuarios as &$usuario) {
        if ($usuario['id'] == $id) {
            $usuario['username'] = $username;
            $usuario['password'] = $password; 
            break;
        }
    }

    $usuarios_json = json_encode($usuarios);
    setcookie('usuarios', $usuarios_json, time() + (14 * 24 * 60 * 60), '/');
    echo "Usuario modificado con éxito";

    return $usuarios;
}

function modificarProducto($codigo, $nombre, $marca, $pu){
    $productos = isset($_COOKIE['productos']) ? json_decode($_COOKIE['productos'], true) : [];

    foreach ($productos as &$producto) {
        if ($producto['codigo'] == $codigo) {
            $producto['nombre'] = $nombre;
            $producto['marca'] = $marca;
            $producto['pu'] = "$". $pu;  
            break;
        }
    }

    $productos_json = json_encode($productos);
    setcookie('productos', $productos_json, time() + (14 * 24 * 60 * 60), '/');
    echo "Producto modificado con éxito";
    echo $productos_json;
    return $productos;
}

function modificarProveedor($cvm, $nombre, $representante){
    $proveedores = isset($_COOKIE['proveedores']) ? json_decode($_COOKIE['proveedores'], true) : [];

    foreach ($proveedores as &$proveedor) {
        if ($proveedor['cvm'] == $cvm) {
            $anterior = $proveedor['nombre'];
            $proveedor['nombre'] = $nombre;
            $proveedor['nombre_rep'] = $representante; 
            actualizarNombre($anterior, $nombre);
            break;
        }
    }

    $proveedores_json = json_encode($proveedores);
    setcookie('proveedores', $proveedores_json, time() + (14 * 24 * 60 * 60), '/');
    echo "Proveedor modificado con éxito";

    return $proveedores;
}

function eliminarUsuario($id){
    session_start();
    $usuarios = isset($_COOKIE['usuarios']) ? json_decode($_COOKIE['usuarios'], true) : [];

    foreach ($usuarios as $key => &$usuario) {
        
        var_dump($_POST);
        if ($usuario['id'] == $id) {
            unset($usuarios[$key]);
        }
    }
    $usuarios = array_values($usuarios);
    $usuarios_json = json_encode($usuarios);
    setcookie('usuarios', $usuarios_json, time() + (14 * 24 * 60 * 60), '/');
    echo "Usuario eliminado con éxito";
    //echo $usuarios_json;

    $usuarioEliminado = true;

    foreach ($usuarios as $usuario) {
        if ($usuario['username'] == $_SESSION['usuario']) {
            $usuarioEliminado = false;
            break;
        }
    }
    if ($usuarioEliminado) {
        logout();
    }

    return $usuarios;
}

function eliminarProducto($codigo){
    $productos = isset($_COOKIE['productos']) ? json_decode($_COOKIE['productos'], true) : [];

    foreach ($productos as $key => &$producto) {
        
        if ($producto['codigo'] == $codigo) {
            unset($productos[$key]);
        }
    }
    $productos = array_values($productos);
    $productos_json = json_encode($productos);
    setcookie('productos', $productos_json, time() + (14 * 24 * 60 * 60), '/');
    echo $productos_json;
    echo "Producto eliminado con éxito";
}

function eliminarProveedor($cvm){
    $proveedores = isset($_COOKIE['proveedores']) ? json_decode($_COOKIE['proveedores'], true) : [];

    foreach ($proveedores as $key => &$proveedor) {
        
        if ($proveedor['cvm'] == $cvm) {
            unset($proveedores[$key]);
        }
    }
    $proveedores = array_values($proveedores);
    $proveedores_json = json_encode($proveedores);
    setcookie('proveedores', $proveedores_json, time() + (14 * 24 * 60 * 60), '/');
    echo $proveedores_json;
    echo "proveedor eliminado con éxito";
}

function BuscarProducto($codigo){
    if (isset($_COOKIE["productos"])) {
        $productos_json = $_COOKIE['productos'];
        $productos = json_decode($productos_json, true);
        foreach ($productos as $producto) {
            if ($producto['codigo'] == $codigo) {
                echo "
                <div class = 'submenu'>
                    <input type = 'search' id = 'buscar' name = 'buscar' placeholder='Buscar' onkeyup = 'javascript:codbar(event)'>
                    <input class='boton' type='button' value = 'Agregar' onclick = 'javascript: opcion(\"Producto\", this.value)'>
                </div>

                <table id= 'tabla'>
                    <tr>
                        <th>Codigo</th>
                        <th>Nombre</th>
                        <th>Marca</th>
                        <th>Precio Unitario</th>
                        <th>Acciones</th>
                    </tr> 
                    <tr>
                        <td>{$producto['codigo']}</td>
                        <td>{$producto['nombre']}</td>
                        <td>{$producto['marca']}</td>
                        <td>{$producto['pu']}</td>
                        <td>
                            <input class = 'boton' type = 'button' value = 'Modificar' onclick = 'javascript: opcion(\"Producto\", this.value, {$producto['codigo']})'>
                            <input class = 'boton' type = 'button' value = 'Eliminar' onclick = 'javascript: opcion(\"Producto\", this.value, {$producto['codigo']})'>
                        </td>
                    </tr>
                ";
            }
        }
    }
}

function actualizarNombre($anterior, $nuevo){
    $productos = isset($_COOKIE['productos']) ? json_decode($_COOKIE['productos'], true) : [];

    foreach ($productos as &$producto) {
        if ($producto['marca'] == $anterior) {
            $producto['marca'] = $nuevo;
        }
    }

    $productos_json = json_encode($productos);
    setcookie('productos', $productos_json, time() + (14 * 24 * 60 * 60), '/');
    echo "Marcas de productos actualizadas con éxito";
}

function logout(){
    session_start();
    unset($_SESSION['usuario']);
    session_destroy();
    exit;
}

session_destroy();