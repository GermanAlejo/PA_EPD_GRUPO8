<?php
session_start();
//si pulso en registrar
if (isset($_POST['registro'])) {
    header('location: registro.html');
}
//si pulso en logout
if (isset($_POST['logout'])) {
    mysqli_close($con);
    echo 'Sesion cerrada' . '<br>'; //no se logra visualizar al ojo humano
    header('location: login.html');
}

//---------------------------CONSULTA---------------------------
$filtros = Array('password' => FILTER_SANITIZE_STRING, 'usuario' => FILTER_SANITIZE_STRING);
$entradas = filter_input_array(INPUT_POST, $filtros);

//sin anti inyeccion
$usuario = $_POST['usuario'];
$password = $_POST['password'];
//anti inyeccion
//$password = $entradas['password'];
//$usuario = $entradas['usuario'];


$con = mysqli_connect("localhost", "root", "", "epd6ej");
if (!$con) {
    die("Fallo conexion: " . mysqli_connect_errno());
} else {

//$consulta = "SELECT * FROM USUARIOS WHERE usuario = '$usuario' AND password = '$password'";   //esta no impide la inyeccion SQL
//$consulta = "SELECT * FROM USUARIOS WHERE usuario = '$usuario' AND password = '$password'";   //primer metodo anti inyecciones
//segundo metodo
    $consulta = "SELECT * FROM USUARIOS WHERE usuario = ?";
    $stmt = mysqli_stmt_init($con);
    mysqli_stmt_prepare($stmt, $consulta);
    mysqli_stmt_bind_param($stmt, "s", $usuario);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);

//se quita con el segundo metodo
//$resultado = mysqli_query($con, $consulta);
    $fila = mysqli_fetch_assoc($resultado);
//---------------------------FIN CONSULTA---------------------------
//---------------------------TRATADO--------------------------------
    if (isset($fila['nombre']) && isset($fila['f_registro']) && password_verify($password, $fila['password'])) {
        $_SESSION['usuario'] = $fila['usuario'];
        echo 'Usuario ' . $fila['nombre'] . " desde" . '<br>' . "fecha de registro " . $fila['f_registro'];
    } else {
        echo 'Usuario o password incorrectos' . '<br>';
    }
    echo '<form action="login.php" method="post">
       <button type="submit" name="logout">logout</button>
      </form>' . '<br>';
}
?>