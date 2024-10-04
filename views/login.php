<?php
$error = $params['error'];
$message = $params['message'];
echo $route;
?>
<div class="container height-100 center-vertical center-horizontal">
    <div class="card">
        <div class="card-title center-horizontal">
            <h4>Iniciar Sesión</h4>
        </div>
        <div class="card-body">
            <form action="controllers/login_controller.php" method="POST">
                <div class="input-control w-70">
                    <label for="username">Usuario</label>
                    <input type="text" id="username" name="username" required>
                </div>
                <div class="input-control w-70">
                    <label for="password">Contraseña</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <div class="row w-70 margin-auto end-horizontal">
                    <button class="button">Iniciar Sesión</button>
                </div>
                <?php if ($error == 1): ?>
                    <div class="row w-70 margin-auto danger-banner">
                        <span><?= $message ?></span>
                    </div>
                <?php endif; ?>
            </form>
        </div>
    </div>
</div>