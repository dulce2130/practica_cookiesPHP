<?php
session_start();
switch ($_POST["opc"]) {
    case 'Persona':
        switch ($_POST['acc']) {
            case 'listar':
                //echo "Persona";
                echo "
                <div class = 'submenu'>
                <input class='boton' type='button' value = 'Agregar' onclick = 'javascript: opcion(\"Persona\", this.value)'>
                </div>

                <table id= 'tabla'>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Contraseña</th>
                        <th>Acciones</th>
                    </tr> ";

                    if (isset($_COOKIE['usuarios'])) {
                        $usuarios_json = $_COOKIE['usuarios'];
                        $usuarios = json_decode($usuarios_json, true);
                
                        foreach ($usuarios as $usuario) {
                            echo "
                            <tr>
                                <td>{$usuario['id']}</td>
                                <td>{$usuario['username']}</td>
                                <td>{$usuario['password']}</td>
                                <td>
                                    <input class = 'boton' type = 'button' value = 'Modificar' onclick = 'javascript: opcion(\"Persona\", this.value, {$usuario['id']})'>
                                    <input class = 'boton' type = 'button' value = 'Eliminar' onclick = 'javascript: opcion(\"Persona\", this.value, {$usuario['id']})'>
                                </td>
                            </tr>
                            ";
                        }
                    }

                echo "    
                </table>";
                break;

            case 'Agregar':
                echo "
                <form method = 'post' class ='forms' id ='form_agregar' action = 'javascript:menuUsuarios(\"agregar\")'>
                    <table>
                        <tr>
                            <th colspan = '2'>Agregar Usuario</th>
                        </tr>
                        <tr>
                            <td>Id:</td>";
                            if (isset($_COOKIE["usuarios"])) {
                                $usuarios_json = $_COOKIE['usuarios'];
                                $usuarios = json_decode($usuarios_json, true);
                                $ultimoUsuario = end($usuarios);

                                echo"
                                <td><input type = 'text' value = '".($ultimoUsuario['id'] +1 )."' name = 'cve' id ='cve' readOnly></td>
                                ";
                            }
                        echo "
                        </tr>
                        <tr>
                            <td>Nombre:</td>
                            <td><input type = 'text' name= 'nombre' id = 'nombre'></td>
                        </tr>
                        <tr>
                            <td>Contraseña:</td>
                            <td><input type = 'text' name= 'pass' id = 'pass'></td>
                        </tr>
                        <tr>
                            <td colspan = '2'>
                                <input class='boton' type = 'button' value = 'Cancelar' onclick = 'javascript:opcion(\"Persona\", \"listar\")'>
                                <input class='boton' type = 'submit' value = 'Guardar' onclick = 'javascript:opcion(\"Persona\", \"listar\")'>
                            </td>
                        </tr>
                    </table>
                </form>

                ";
                break;

            case 'Modificar':
                echo "
                <form method = 'post' class ='forms' id ='form_agregar' action = 'javascript:menuUsuarios(\"modificar\")'>
                    <table>
                        <tr>
                            <th colspan = '2'>Modificar Usuario</th>
                        </tr>
                        <tr>
                            <td>Id:</td>";
                            $id = $_POST['id'];                            
                            if (isset($_COOKIE["usuarios"])) {
                                $usuarios_json = $_COOKIE['usuarios'];
                                $usuarios = json_decode($usuarios_json, true);
                                foreach ($usuarios as $usuario) {
                                    if ($usuario['id'] == $id) {
                                        echo"
                                            <td><input type = 'text' value = '{$usuario['id']}' name = 'cve' id ='cve' readOnly></td>
                                        </tr>
                                        <tr>
                                            <td>Nombre:</td>
                                            <td><input type = 'text' name= 'nombre' id = 'nombre' value = '{$usuario['username']}'></td>
                                        </tr>
                                        <tr>
                                            <td>Contraseña:</td>
                                            <td><input type = 'text' name= 'pass' id = 'pass' value = '{$usuario['password']}'></td>
                                        </tr>
                                        <tr>
                                            <td colspan = '2'>
                                                <input class='boton' type = 'button' value = 'Cancelar' onclick = 'javascript:opcion(\"Persona\", \"listar\")'>
                                                <input class='boton' type = 'submit' value = 'Guardar' onclick = 'javascript:opcion(\"Persona\", \"listar\")'>
                                            </td>
                                        </tr>
                                    </table>
                                    </form>
                                        ";
                                    }
                                }
                       
                            }
                break;
            case 'Eliminar':

                echo "
                <form method = 'post' class ='forms' id ='form_agregar' action = 'javascript:menuUsuarios(\"eliminar\")'>";
                $id = $_POST['id'];                            
                            if (isset($_COOKIE["usuarios"])) {
                                $usuarios_json = $_COOKIE['usuarios'];
                                $usuarios = json_decode($usuarios_json, true);
                                foreach ($usuarios as $usuario) {
                                    if ($usuario['id'] == $id) {
                echo "
                    <div>
                        <label>¿Esta seguro de eliminar a {$usuario['username']}?</label>
                        <input type = 'hidden' id = 'cve' name ='cve' value ='{$usuario['id']}'>
                        <input type = 'hidden' id = 'nombre' name = 'nombre' value= '{$usuario['username']}'>
                        <input type = 'hidden' id = 'pass' name = 'pass' value = '{$usuario['password']}'>

                    </div>
                    <div>    
                        <input class = 'boton' type = 'button' value = 'Cancelar' onclick = 'javascript:opcion(\"Persona\", \"listar\")'>
                        <input class = 'boton' type = 'submit' value = 'Aceptar'  onclick = 'javascript:opcion(\"Persona\", \"listar\")'>
                    </div>";
                                    }
                                }
                            }

                echo "                    
                </form>
                
                ";
                break;            
        }

        break;

    case "Producto":
        switch ($_POST['acc']) {
            case 'listar':
                echo "
                <div class = 'submenu'>
                    <input type = 'search' id = 'buscar' name = 'buscar' placeholder='Buscar' onkeyup = 'javascript:codbar(event)' autofocus>
                    <input class='boton' type='button' value = 'Agregar' onclick = 'javascript: opcion(\"Producto\", this.value)' >
                </div>

                <table id= 'tabla'>
                    <tr>
                        <th>Codigo</th>
                        <th>Nombre</th>
                        <th>Marca</th>
                        <th>Precio Unitario</th>
                        <th>Acciones</th>
                    </tr> ";

                    if (isset($_COOKIE['productos'])) {
                        $productos_json = $_COOKIE['productos'];
                        $productos = json_decode($productos_json, true);
                
                        foreach ($productos as $producto) {
                            echo "
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

                echo "    
                </table>";
                
                break;
            case "Agregar":
                echo "
                <form method = 'post' class ='forms' id ='form_agregar_prod' action = 'javascript:menuProducto(\"agregar\")'>
                    <table>
                        <tr>
                            <th colspan = '2'>Agregar Producto</th>
                        </tr>
                        <tr>
                            <td>Código:</td>
                            <td><input type = 'text' name= 'codigo' id = 'codigo' ></td>
                        </tr>
                        <tr>
                            <td>Nombre:</td>
                            <td><input type = 'text' name= 'nombre_prod' id = 'nombre_prod'></td>
                        </tr>
                        <tr>
                            <td>Marca:</td>
                            <td><input type = 'text' name= 'marca' id = 'marca'></td>
                        </tr>
                        <tr>
                            <td>Precio unitario:</td>
                            <td><input type = 'number' name= 'pu' id = 'pu' step = 'any' min = 0></td>
                        </tr>
                        <tr>
                            <td colspan = '2'>
                                <input class='boton' type = 'button' value = 'Cancelar' onclick = 'javascript:opcion(\"Producto\", \"listar\")'>
                                <input class='boton' type = 'submit' value = 'Guardar' onclick = 'javascript:opcion(\"Producto\", \"listar\")'>
                            </td>
                        </tr>
                    </table>
                </form>

                ";
                break;
            case 'Modificar':
                echo "
                <form method = 'post' class ='forms' id ='form_agregar_prod' action = 'javascript:menuProducto(\"modificar\")'>
                    <table>
                        <tr>
                            <th colspan = '2'>Modificar Producto</th>
                        </tr>
                        <tr>
                            <td>Codigo:</td>";
                            $codigo = $_POST['id'];                            
                            if (isset($_COOKIE["productos"])) {
                                $productos_json = $_COOKIE['productos'];
                                $productos = json_decode($productos_json, true);
                                foreach ($productos as $producto) {
                                    if ($producto['codigo'] == $codigo) {
                                        echo"
                                            <td><input type = 'text' value = '{$producto['codigo']}' name = 'codigo' id ='codigo' readOnly></td>
                                        </tr>
                                        <tr>
                                            <td>Nombre:</td>
                                            <td><input type = 'text' name= 'nombre_prod' id = 'nombre_prod' value = '{$producto['nombre']}'></td>
                                        </tr>
                                        <tr>
                                            <td>Nombre:</td>
                                            <td><input type = 'text' name= 'marca' id = 'marca' value = '{$producto['marca']}'></td>
                                        </tr>
                                        <tr>
                                            <td>Precio unitario:</td>
                                            <td><input type = 'number' name= 'pu' id = 'pu' step = 'any' value = '".str_replace("$", "", $producto['pu'])."' min = 0></td>
                                        </tr>
                                        <tr>
                                            <td colspan = '2'>
                                                <input class='boton' type = 'button' value = 'Cancelar' onclick = 'javascript:opcion(\"Producto\", \"listar\")'>
                                                <input class='boton' type = 'submit' value = 'Guardar' onclick = 'javascript:opcion(\"Producto\", \"listar\")'>
                                            </td>
                                        </tr>
                                    </table>
                                    </form>
                                            ";
                                        }
                                    }
                           
                                }
                    break;
                case 'Eliminar':
                    echo "
                        <form method = 'post' class ='forms' id ='form_agregar_prod' action = 'javascript:menuProducto(\"eliminar\")'>";
                        $codigo = $_POST['id'];                            
                                    if (isset($_COOKIE["productos"])) {
                                        $productos_json = $_COOKIE['productos'];
                                        $productos = json_decode($productos_json, true);
                                        foreach ($productos as $producto) {
                                            if ($producto['codigo'] == $codigo) {
                        echo "
                            <div>
                                <label>¿Esta seguro de eliminar  {$producto['nombre']}?</label>
                                <input type = 'hidden' id = 'codigo' name ='codigo' value ='{$producto['codigo']}'>
                                <input type = 'hidden' id = 'nombre_prod' name ='nombre_prod' value ='{$producto['nombre']}'>
                                <input type = 'hidden' id = 'marca' name ='marca' value ='{$producto['marca']}'>
                                <input type = 'hidden' id = 'pu' name ='pu' value ='{$producto['pu']}'>
                            </div>
                            <div>    
                                <input class = 'boton' type = 'button' value = 'Cancelar' onclick = 'javascript:opcion(\"Producto\", \"listar\")'>
                                <input class = 'boton' type = 'submit' value = 'Aceptar'  onclick = 'javascript:opcion(\"Producto\", \"listar\")'>
                            </div>";
                                            }
                                        }
                                    }
        
                        echo "                    
                        </form>";
                    break;    
        }

        break;

    case "Proveedor":
        switch ($_POST['acc']) {
            case 'listar':
                echo "
                <div class = 'submenu'>
                    <input class='boton' type='button' value = 'Agregar' onclick = 'javascript: opcion(\"Proveedor\", this.value)'>
                </div>

                <table id= 'tabla'>
                    <tr>
                        <th>CVM</th>
                        <th>Nombre</th>
                        <th>Nombre Representante</th>
                        <th>Acciones</th>
                    </tr> ";

                    if (isset($_COOKIE['proveedores'])) {
                        $proveedores_json = $_COOKIE['proveedores'];
                        $proveedores = json_decode($proveedores_json, true);
                
                        foreach ($proveedores as $proveedore) {
                            echo "
                            <tr>
                                <td>{$proveedore['cvm']}</td>
                                <td>{$proveedore['nombre']}</td>
                                <td>{$proveedore['nombre_rep']}</td>
                                <td>
                                    <input class = 'boton' type = 'button' value = 'Modificar' onclick = 'javascript: opcion(\"Proveedor\", this.value, {$proveedore['cvm']})'>
                                    <input class = 'boton' type = 'button' value = 'Eliminar' onclick = 'javascript: opcion(\"Proveedor\", this.value, {$proveedore['cvm']})'>
                                </td>
                            </tr>
                            ";
                        }
                    }

                echo "    
                </table>";
                break;
            
            case "Agregar":
                echo "
                <form method = 'post' class ='forms' id ='form_prov' action = 'javascript:menuProveedor(\"agregar\")'>
                    <table>
                        <tr>
                            <th colspan = '2'>Agregar Proveedor</th>
                        </tr>
                        <tr>
                            <td>CVM:</td>
                            <td><input type = 'text' name= 'cvm' id = 'cvm' ></td>
                        </tr>
                        <tr>
                            <td>Nombre:</td>
                            <td><input type = 'text' name= 'nombre_prov' id = 'nombre_prov'></td>
                        </tr>
                        <tr>
                            <td>Respresentante:</td>
                            <td><input type = 'text' name= 'nombre_rep' id = 'nombre_rep'></td>
                        </tr>
                        <tr>
                            <td colspan = '2'>
                                <input class='boton' type = 'button' value = 'Cancelar' onclick = 'javascript:opcion(\"Proveedor\", \"listar\")'>
                                <input class='boton' type = 'submit' value = 'Guardar' onclick = 'javascript:opcion(\"Proveedor\", \"listar\")'>
                            </td>
                        </tr>
                    </table>
                </form>";
                break;

            case 'Modificar':
                echo "
                <form method = 'post' class ='forms' id ='form_prov' action = 'javascript:menuProveedor(\"modificar\")'>
                    <table>
                        <tr>
                            <th colspan = '2'>Modificar Producto</th>
                        </tr>
                        <tr>
                            <td>CVM:</td>";
                            $cvm = $_POST['id'];                            
                            if (isset($_COOKIE["proveedores"])) {
                                $proveedores_json = $_COOKIE['proveedores'];
                                $proveedores = json_decode($proveedores_json, true);
                                foreach ($proveedores as $proveedor) {
                                    if ($proveedor['cvm'] == $cvm) {
                                        echo"
                                        <td><input type = 'text' value = '{$proveedor['cvm'] }' name = 'cvm' id ='cvm' readOnly></td>
                                        </tr>
                                        <tr>
                                            <td>Nombre:</td>
                                            <td><input type = 'text' name= 'nombre_prov' id = 'nombre_prov' value = '{$proveedor['nombre']}'></td>
                                        </tr>
                                        <tr>
                                            <td>Nombre:</td>
                                            <td><input type = 'text' name= 'nombre_rep' id = 'nombre_rep' value = '{$proveedor['nombre_rep']}'></td>
                                        </tr>
                                        <tr>
                                            <td colspan = '2'>
                                                <input class='boton' type = 'button' value = 'Cancelar' onclick = 'javascript:opcion(\"Proveedor\", \"listar\")'>
                                                <input class='boton' type = 'submit' value = 'Guardar' onclick = 'javascript:opcion(\"Proveedor\", \"listar\")'>
                                                </td>
                                        </tr>
                                    </table>
                                    </form>";
                                            }
                                        }
                               
                                    }
                        break;
            
            case "Eliminar":
                echo "
                <form method = 'post' class ='forms' id ='form_prov' action = 'javascript:menuProveedor(\"eliminar\")'>";
                $cvm = $_POST['id'];                            
                if (isset($_COOKIE["proveedores"])) {
                    $proveedores_json = $_COOKIE['proveedores'];
                        $proveedores = json_decode($proveedores_json, true);
                foreach ($proveedores as $proveedor) {
                        if ($proveedor['cvm'] == $cvm) {
                echo "
                    <div>
                        <label>¿Esta seguro de eliminar a la marca {$proveedor['nombre']} y su representante {$proveedor['nombre_rep']}?</label>
                        <input type = 'hidden' id = 'cvm' name ='cvm' value ='{$proveedor['cvm']}'>
                        <input type = 'hidden' id = 'nombre_prov' name ='nombre_prov' value ='{$proveedor['nombre']}'>
                        <input type = 'hidden' id = 'nombre_rep' name ='nombre_rep' value ='{$proveedor['nombre_rep']}'>
                    </div>
                    <div>    
                        <input class = 'boton' type = 'button' value = 'Cancelar' onclick = 'javascript:opcion(\"Proveedor\", \"listar\")'>
                        <input class = 'boton' type = 'submit' value = 'Aceptar'  onclick = 'javascript:opcion(\"Proveedor\", \"listar\")'>
                    </div>";
                                    }
                                }
                            }

                echo "                    
                </form>";
                break;
        
        }
        break;
}


