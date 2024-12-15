<?php
    session_start();
    if (!isset($_SESSION['user'])) {
        header("Location: login.html");
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - CarServ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <header class="bg-dark text-white py-3">
        <div class="container">
            <h1>Welcome to CarServ Dashboard</h1>
            <p>User: <?php echo $_SESSION['user']; ?></p>
        </div>
    </header>
    <div class="container mt-5">
        <p>This is the dashboard page.</p>
    </div>
</body>
</html>
