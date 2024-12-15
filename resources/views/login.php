<?php
    session_start();
    include '../../database/conexion.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $sql = "SELECT * FROM Usuarios WHERE email = ? AND password = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $email, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $_SESSION['user'] = $email;
            header("Location: dashboard.php");
        } else {
            echo "Email o contraseña incorrectos.";
        }

        $stmt->close();
        $conn->close();
    }
?>
