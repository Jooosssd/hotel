<?php
    require 'conexion.php';
    
    session_start();
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $user = $_POST['usuario'];
        $password = $_POST['pass'];
        
        $sql = "SELECT * FROM usuarios WHERE usuario = ? AND pass = ?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("ss", $user, $password);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            $_SESSION['usuario'] = $user;
            header("Location: inicio.html");
            exit();
        } else {
            $error = "Usuario o contraseña incorrectos";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <form method="POST" action="">
        <label for="user">Usuario:</label>
        <input type="text" name="usuario" required>
        <br>
        <label for="password">Contraseña:</label>
        <input type="password" name="pass" required>
        <br>
        <button type="submit">Iniciar sesión</button>
    </form>
    
    <?php if (isset($error)) { echo "<p style='color:red;'>$error</p>"; } ?>
</body>
</html>
