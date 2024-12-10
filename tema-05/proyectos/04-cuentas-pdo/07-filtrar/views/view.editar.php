<!DOCTYPE html>
<html lang="es">

<head>
    <?php include 'views/layouts/layout.head.html'; ?>
    <title>Editar Cuenta - CRUD Cuentas </title>
</head>

<body>
    <!-- Capa Principal -->
    <div class="container">

        <!-- Encabezado proyecto -->
        <?php include 'views/partials/partial.header.php'; ?>

        <legend>Formulario Editar Cuenta</legend>

        <!-- Formulario Editar Cuenta -->

        <form action="update.php?id=<?=$id?>" method="POST">

            <!-- Número de Cuenta-->
            <div class="mb-3">
                <label for="num_cuenta" class="form-label">Número de Cuenta</label>
                <input type="number" class="form-control" name="num_cuenta" value="<?=$cuenta->num_cuenta?>">
            </div>
            <!-- Saldo -->
            <div class="mb-3">
                <label for="saldo" class="form-label">Saldo</label>
                <input type="number" class="form-control" name="saldo" value="<?=$cuenta->saldo?>">
            </div>


            <!-- botones de acción -->
            <a class="btn btn-primary" href="index.php" role="button">Cancelar</a>
            <button type="reset" class="btn btn-danger">Borrar</button>
            <button type="submit" class="btn btn-primary">Enviar</button>

        </form>

        <!-- Fin formulario Editar cuenta -->


    </div>
    <br><br><br>

    <!-- Pie del documento -->
    <?php include 'views/partials/partial.footer.php'; ?>

    <!-- Bootstrap Javascript y popper -->
    <?php include 'views/layouts/layout.javascript.html'; ?>


</body>

</html>