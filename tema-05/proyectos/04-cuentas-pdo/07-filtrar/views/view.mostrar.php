<!DOCTYPE html>
<html lang="es">

<head>
    <?php include 'views/layouts/layout.head.html'; ?>
    <title>Mostrar Cuenta - CRUD Cuentas </title>
</head>

<body>
    <!-- Capa Principal -->
    <div class="container">

        <!-- Encabezado proyecto -->
        <?php include 'views/partials/partial.header.php'; ?>

        <legend>Formulario Mostrar Cuenta</legend>

        <!-- Formulario Mostrar Cuenta -->

        <form>

            <!-- Número de Cuenta-->
            <div class="mb-3">
                <label for="num_cuenta" class="form-label">Número de Cuenta</label>
                <input type="number" class="form-control" value="<?=$cuenta->num_cuenta?>" disabled>
            </div>
            <!-- Cliente de la Cuenta-->
            <div class="mb-3">
                <label for="num_cuenta" class="form-label">ID Cliente</label>
                <input type="text" class="form-control" value="<?=$cuenta->id_cliente?>" disabled>
            </div>
            <!-- Fecha de Alta -->
            <div class="mb-3">
                <label for="id_cliente" class="form-label">Fecha de Alta</label>
                <input type="text" class="form-control" value="<?=$cuenta->fecha_alta?>" disabled>
            </div>
            <!-- Fecha de Último Movimiento -->
            <div class="mb-3">
                <label for="id_cliente" class="form-label">Fecha de Último Movimiento</label>
                <input type="text" class="form-control" value="<?=$cuenta->fecha_ul_mov?>" disabled>
            </div>
            <!-- Número de Movimientos -->
            <div class="mb-3">
                <label for="saldo" class="form-label">Número de Movimientos</label>
                <input type="number" class="form-control" value="<?=$cuenta->num_movtos?>" disabled>
            </div>
            <!-- Saldo -->
            <div class="mb-3">
                <label for="saldo" class="form-label">Saldo</label>
                <input type="number" class="form-control" value="<?=$cuenta->saldo?>" disabled>
            </div>


            <!-- botones de acción -->
            <a class="btn btn-primary" href="index.php" role="button">Cancelar</a>

        </form>

        <!-- Fin formulario mostrar cuenta -->


    </div>
    <br><br><br>

    <!-- Pie del documento -->
    <?php include 'views/partials/partial.footer.php'; ?>

    <!-- Bootstrap Javascript y popper -->
    <?php include 'views/layouts/layout.javascript.html'; ?>


</body>

</html>