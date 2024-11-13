<!DOCTYPE html>
<html lang="es">

<head>
    <?php include 'views/layouts/layout.head.html'; ?>
    <title>Nuevo Alumno - CRUD Alumnos </title>
</head>

<body>
    <!-- Capa Principal -->
    <div class="container">

        <!-- Encabezado proyecto -->
        <?php include 'views/partials/partial.header.php'; ?>

        <legend>Formulario Nuevo Alumno</legend>

        <!-- Formulario Nuevo alumno -->

        <form action="create.php" method="POST">

            <!-- id -->
            <div class="mb-3">
                <label for="id" class="form-label">Id</label>
                <input type="text" class="form-control" name="id">
            </div>

            <!-- Nombre -->
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" name="nombre">
            </div>

            <!-- Apellidos -->
            <div class="mb-3">
                <label for="apellidos" class="form-label">Apellidos</label>
                <input type="text" class="form-control" name="apellidos">
            </div>

            <!-- Email -->
            <div class="mb-3">
                <label for="unidades" class="form-label">Email</label>
                <input type="number" class="form-control" name="unidades" step="0.01">
            </div>

            <!-- Fecha de Nacimiento -->
            <div class="mb-3">
                <label for="precio" class="form-label">Fecha de Nacimiento</label>
                <input type="number" class="form-control" name="precio" step="0.01">
            </div>

            <!-- Select Dinámico Cursos -->
            <div class="mb-3">
                <label for="marca" class="form-label">Marca</label>
                <select class="form-select" name="marca" id="marca">
                    <option selected disabled>Seleccione una Marca</option>
                    <!-- mostrar lista cursos -->
                    <?php foreach ($cursos as $indice => $data): ?>
                        <option value="<?= $indice ?>">
                            <?= $data ?>
                        </option>
                    <?php endforeach; ?>
                </select>

            </div>

            <!-- lista checbox dinámica categorias -->
            <div class="mb-3">
                <label for="categorias" class="form-label">Seleccione las Categorías</label>
                <div class="form-control">
                    <!-- muestro el array categorías -->
                    <?php foreach ($categorias as $indice => $data): ?>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="categorias[]" value="<?= $indice ?>">
                            <label class="form-check-label" for="">
                                <?= $data ?>
                            </label>
                        </div>
                    <?php endforeach; ?>

                </div>
            </div>

            <!-- botones de acción -->
            <a class="btn btn-secondary" href="index.php" role="button">Cancelar</a>
            <button type="reset" class="btn btn-danger">Borrar</button>
            <button type="submit" class="btn btn-primary">Enviar</button>

        </form>

        <!-- Fin formulario nuevo alumno -->

    </div>
    <br><br><br>

    <!-- Pie del documento -->
    <?php include 'views/partials/partial.footer.php'; ?>

    <!-- Bootstrap Javascript y popper -->
    <?php include 'views/layouts/layout.javascript.html'; ?>


</body>

</html>