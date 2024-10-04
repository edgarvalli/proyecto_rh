<?php
$id = $params['id'];
$fullname = '';
$phone = '';
$email = '';
$start_date = '';
$comment = '';
$action = 'new';

if ($id) {
    require_once('database.php');
    $dbname = database::get_db_name();
    $db = database::connect($dbname);
    $sql = "SELECT * FROM employees WHERE id=$id";
    $employee = $db->query($sql)->fetch_assoc();
    $fullname = $employee['fullname'];
    $phone = $employee['phone'];
    $email = $employee['email'];
    $comment = $employee['comment'];
    $start_date = explode(" ", $employee['start_date'])[0];
    $action = 'update';
}
?>
<div class="container card">

    <div class="row">
        <form action="controllers/employee_controller.php" method="POST">
            <input type="hidden" name="action" value="<?= $action ?>">
            <input type="hidden" name="id" value="<?= $id ?>">
            <div class="input-control">
                <label for="fullname">Nombre</label>
                <input type="text" id="fullname" name="fullname" value="<?= $fullname ?>" required>
            </div>
            <div class="input-control">
                <label for="phone">Telefono</label>
                <input type="phone" id="phone" name="phone" value="<?= $phone ?>">
            </div>
            <div class="input-control">
                <label for="email">Correo</label>
                <input type="email" id="email" name="email" value="<?= $email ?>">
            </div>
            <div class="input-control">
                <label for="start_date">Fecha Alta</label>
                <input type="date" id="start_date" name="start_date" value="<?= $start_date ?>" required <?php if($action == "update"){echo "disabled";} ?>>
            </div>
            <?php if ($action == "update"): ?>
                <div class="input-control">
                    <textarea name="comment" id="comment" disabled>
                        <?= $comment; ?>
                    </textarea>
                </div>
            <?php endif; ?>
            <div class="row">
                <button class="button">Guardar</button>
                <a href="/dashboard" class="button-danger" style="margin-left: 1rem;">Cancelar</a>
            </div>
        </form>
    </div>


</div>