<?php
require_once('database.php');
$dbname = database::get_db_name();
$db = database::connect($dbname);
$sql = "SELECT * FROM employees";
$employees = $db->query($sql)->fetch_all(MYSQLI_ASSOC);
$db->close();
?>
<div class="container card mt-3">

    <div class="row mt-1">
        <a class="button" href="/employee_form">Crear Empleado</a>
    </div>

    <div class="row mt-1">
        <table>
            <thead>
                <tr>
                    <th>Empleado</th>
                    <th>Telefono</th>
                    <th>Correo</th>
                    <th>Motivo Baja</th>
                    <th>Fecha Alta</th>
                    <th>Fecha Baja</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($employees as $e): ?>
                    <tr>
                        <td width="10%"><?= $e['fullname'] ?></td>
                        <td width="10%"><?= $e['phone'] ?></td>
                        <td width="10%"><?= $e['email'] ?></td>
                        <td width="40%"><?= $e['comment'] ?></td>
                        <td width="10%"><?= explode(" ", $e['start_date'])[0] ?></td>
                        <td width="10%"><?= explode(" ", $e['end_date'])[0] ?></td>
                        <td width="10%">
                            <a href="/employee_form?id=<?= $e['id'] ?>">
                            <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                            <?php if ($e['is_active'] == 1): ?>
                                <i class="fa-solid fa-trash" style="cursor:pointer; margin-left: 1rem" onclick="openDialog('<?= $e['id'] ?>')"></i>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div class="modal" id="modal">
            <div class="card" style="width: 30%;">
                <div class="row">
                    <span id="name">nnn</span>
                </div>
                <form action="controllers/employee_controller.php" method="post">
                    <input type="hidden" name="action" value="fired">
                    <input type="hidden" name="id" value="" id="userid">
                    <div class="input-control">
                        <label for="end_date">Fecha de Baja</label>
                        <input type="date" id="end_date" name="end_date" required>
                    </div>
                    <div class="input-control">
                        <label for="comment">Motivo de baja</label>
                        <textarea name="comment" id="comment"></textarea>
                    </div>
                    <div class="row">
                        <button class="button" onclick="setFired()">Enviar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    const employees = <?= json_encode($employees); ?>;
    const modal = document.getElementById('modal');
    function openDialog(id) {
        document.getElementById("userid").value = id;
        modal.style = "display: flex";
        const e = employees.filter((el) => el.id === id)[0];
        document.getElementById('name').textContent = e.fullname || '';
    }

    window.onkeyup = e => {
        if (e.key === 'Escape') {
            modal.style = "display: none";
        }
    }

</script>