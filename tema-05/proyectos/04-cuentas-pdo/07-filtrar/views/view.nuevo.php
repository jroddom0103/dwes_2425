<!DOCTYPE html>
<html lang="es">

<head>
    <?php include 'views/layouts/layout.head.html'; ?>
    <title>Nueva Cuenta - GESBANK </title>
</head>

<body>
    <!-- Capa Principal -->
    <div class="container">

        <!-- Encabezado proyecto -->
        <?php include 'views/partials/partial.header.php'; ?>

        <legend>Formulario Nueva Cuenta</legend>

        <!-- Formulario Nueva Cuenta -->

        <form action="create.php" method="POST">

            <!-- Número de Cuenta-->
            <div class="mb-3">
                <label for="num_cuenta" class="form-label">Número de Cuenta</label>
                <input type="text" class="form-control" name="num_cuenta">
            </div>

            <!-- ID Cliente -->
            <div class="mb-3">
                <label for="id_cliente" class="form-label">Cliente</label>
                <select class="form-select" name="id_cliente">
                    <option selected disabled>Seleccione un cliente</option>
                    <!-- mostrar lista de clientes -->
                    <?php foreach ($clientes as $indice => $data): ?>
                        <option value="<?= $indice ?>">
                            <?= $data ?>
                        </option>
                    <?php endforeach ?>
                </select>
            </div>

            <!-- Fecha Alta -->
            <!-- Establecemos la fecha hora actual -->
            <div class="mb-3">
                <label for="fecha_alta" class="form-label">Fecha de Alta</label>
                <input type="datetime-local" class="form-control" name="fecha_alta" value="<?php echo date('Y-m-d H:i:s'); ?>" readonly>
            </div>

            <!-- Fecha Último Movimiento -->
            <div class="mb-3">
                <label for="fecha_alta" class="form-label">Fecha de Último Movimiento</label>
                <input type="datetime-local" class="form-control" name="fecha_ul_mov" value="<?php echo date('Y-m-d H:i:s'); ?>" readonly>
            </div>

            <!-- Número de movimientos -->
            <div class="mb-3">
                <label for="saldo" class="form-label">Número de Movimientos</label>
                <input type="saldo" class="form-control" name="num_movtos" value="0" readonly>
            </div>

            <!-- Saldo -->
            <div class="mb-3">
                <label for="saldo" class="form-label">Saldo</label>
                <input type="saldo" class="form-control" name="saldo">
            </div>

            <!-- botones de acción -->
            <a class="btn btn-secondary" href="index.php" role="button">Cancelar</a>
            <button type="reset" class="btn btn-danger">Borrar</button>
            <button type="submit" class="btn btn-primary">Enviar</button>

        </form>
        <!-- Fin formulario nueva cuenta -->
    </div>
    <br><br><br>

    <!-- Pie del documento -->
    <?php include 'views/partials/partial.footer.php'; ?>

    <!-- Bootstrap Javascript y popper -->
    <?php include 'views/layouts/layout.javascript.html'; ?>


</body>

</html>