<?php


if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}


if ($route !== 'login') {
    if ($_SESSION['is_logged_in'] === 0) {
        header('location: /login');
    }
} else {
    if ($_SESSION['is_logged_in'] === 1) {
        header('location: /');
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet">
    <title>Proyecto RH</title>
</head>

<body>

    <?php if ($route !== 'login'):
        ?>
        <header>
            <div class="navbar">
                <div class="navbar-title">
                    <img src="https://www.creativefabrica.com/wp-content/uploads/2022/01/30/RH-Monogram-logo-Design-V6-Graphics-24344791-1.jpg"
                        alt="logo" width="50" height="50" style="border-radius: 50%">
                </div>
                <div class="navbar-center"></div>
                <div class="navbar-end">
                    <ul class="list-horizontal">
                        <li>
                            <a class="color-white" href="logout">
                                Cerrar Sessión
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </header>
    <?php endif; ?>

    <?php render_view(); ?>
</body>

</html>