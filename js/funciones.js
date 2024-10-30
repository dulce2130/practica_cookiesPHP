
function opcion(opcion, accion, id) {
    var contenido = document.getElementById("contenido")
    var sol = new XMLHttpRequest();
    var datos = new FormData();
    
    datos.append("opc", opcion)
    datos.append('acc', accion)
    datos.append('id', id)

    sol.addEventListener('load', function (e) {
        contenido.innerHTML = e.target.responseText;
        //console.log(e.target.responseText);

    });

    sol.open("POST", "interfaces.php");
    sol.send(datos);
}

function menuUsuarios(accion) {
    var sol = new XMLHttpRequest();
    var datos = new FormData();
    var f = document.querySelector('#form_agregar')
    //console.log(f)
    console.log(accion)

    datos.append("opcion", 'Persona')
    datos.append("acc", accion)

    if (accion != 'logout') {
        datos.append("id", f.cve.value)
        datos.append('username', f.nombre.value);
        datos.append("password", f.pass.value);
    }


    sol.addEventListener('load', function (e) {
        if (accion == 'logout' || accion == 'eliminar') {
            location.reload();
        } else {
            opcion('Persona', 'listar');
        }
    });

    sol.open("POST", "controlador.php");
    sol.send(datos);
}

function menuProducto(accion) {
    var sol = new XMLHttpRequest();
    var datos = new FormData();
    var f = document.querySelector('#form_agregar_prod')
    console.log(accion)

    datos.append("opcion", 'Producto')
    datos.append("acc", accion)

    datos.append("codigo", f.codigo.value);

    datos.append("codigo", f.codigo.value);
    datos.append("nombre", f.nombre_prod.value);
    datos.append("marca", f.marca.value);
    datos.append("pu", f.pu.value);


    sol.addEventListener('load', function (e) {
     
        opcion('Producto', 'listar');
        console.log(e.target.responseText)
        
    })
    sol.open("POST", "controlador.php");
    sol.send(datos);

}

    



function codbar(event) {
    var contenido = document.getElementById("contenido")
    if (event.keyCode === 13) {
        var codigoDeBarras = document.getElementById('buscar').value;
        var sol = new XMLHttpRequest();
        var datos = new FormData();
        
        datos.append('opcion', 'BuscarProducto')
        datos.append('codigo', codigoDeBarras)
        
        sol.addEventListener('load', function(e){
            contenido.innerHTML = e.target.responseText;
        })
        sol.open("POST", "controlador.php")
        sol.send(datos)

        document.getElementById('buscar').value = '';
    }
}

function menuProveedor(accion) {
    var sol = new XMLHttpRequest();
    var datos = new FormData();
    var f = document.querySelector('#form_prov')
    console.log(accion)

    datos.append("opcion", 'Proveedor')
    datos.append("acc", accion)

    datos.append("cvm", f.cvm.value);

    datos.append("nombre", f.nombre_prov.value);
    datos.append("nombre_rep", f.nombre_rep.value);

    sol.addEventListener('load', function (e) {
     
        console.log(e.target.responseText)
        opcion('Proveedor', 'listar');

    })
    sol.open("POST", "controlador.php");
    sol.send(datos);
}

