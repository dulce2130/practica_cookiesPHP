<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    if (!isset($_COOKIE['usuarios'])) {
        $usuarios = array(
            array("id" => 1, "username" => "Nico", "password" => "123")
        );

        $usuarios_json = json_encode($usuarios);
        setcookie('usuarios', $usuarios_json, time() + (14 * 24 * 60 * 60), '/');
    }
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST["user"];
    $password = $_POST["pass"];

    if (verificacion($usuario, $password)) {
        $_SESSION['usuario'] = $usuario;
        header('Location: index.php');
    } else {
        $datos_in = "Datos incorrectos";
    }
}
function verificacion($user, $password)
{
    if (isset($_COOKIE['usuarios'])) {
        $usuarios_json = $_COOKIE['usuarios'];
        $usuarios = json_decode($usuarios_json, true);

        foreach ($usuarios as $usuario) {
            if ($usuario['username'] == $user && $usuario['password'] == $password) {
                return true;
            }
        }
    }
    return false;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <style>
        * {
            margin: 0;
            background: #EEEEEE;

        }

        body {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        form {
            width: 35%;
            height: 450px;
            background: #31363F;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            justify-self: center;
            color: #EEEEEE;
            font-family: sans-serif;
            border-radius: 15px;
        }

        form h1 {
            background: #31363F;
        }

        form label {
            background: #31363F;
            font-size: 20px;
        }

        form input {
            background: #EEEEEE;
            font-size: 20px;
            width: 70%;
            text-align: center;
            border-radius: 15px;
            padding: 5px;
        }

        form input[type="submit"] {
            padding: 5px;
            border-radius: 20px;
        }

        form input[type="submit"]:hover {
            border: 2px double #76ABAE;
            color: #76ABAE;
        }
    </style>
</head>

<body>


    <form action="login.php" method="post">
        <h1>Login</h1><br><br>
        <label for="user">Usuario:</label><br>
        <input type="text" id="user" name="user"><br>
        <label for="pass">Contraseña:</label><br> <!-- Corrige aquí -->
        <input type="password" id="pass" name="pass"><br><br> <!-- Corrige aquí -->
        <input type="submit" value="Iniciar sesión"><br>
        <label for="">
            <?php echo $datos_in ?>
        </label>
    </form>

</body>

</html>