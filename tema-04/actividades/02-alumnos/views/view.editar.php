<!DOCTYPE html>
<html lang="es">

<head>
    <?php include 'views/layouts/layout.head.html'; ?>
    <title>Nuevo Alumno - CRUD Alumno </title>
</head>

<body>
    <!-- Capa Principal -->
    <div class="container">

        <!-- Encabezado proyecto -->
        <?php include 'views/partials/partial.header.php'; ?>

        <legend>Formulario Editar Alumno</legend>

        <!-- Formulario Editar Alumno -->

        <form action="update.php?indice=<?=$indice?>" method="POST">

            <!-- id -->
            <div class="mb-3">
                <label for="id" class="form-label">Id</label>
                <input type="text" class="form-control" name="id" value="<?= $alumno->getId() ?>" readonly>
            </div>

            <!-- Nombre -->
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" name="nombre" value="<?= $alumno->getNombre() ?>">
            </div>

            <!-- Apellidos -->
            <div class="mb-3">
                <label for="apellidos" class="form-label">Apellidos</label>
                <input type="text" class="form-control" name="apellidos" value="<?= $alumno->getApellidos() ?>">
            </div>

            <!-- Email -->
            <div class="mb-3">
                <label for="fecha" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" value="<?= $alumno->getEmail() ?>"
                    step="0.01">
            </div>

            <!-- Fecha Nacimiento -->
            <div class="mb-3">
                <label for="precio" class="form-label">Precio (€)</label>
                <input type="date" class="form-control" name="precio" value="<?= $alumno->get_FechaNacimiento()?>">
            </div>

            <!-- Select Dinámico Marcas -->
            <div class="mb-3">
                <label for="curso" class="form-label">Curso</label>
                <select class="form-select" name="curso" id="curso">
                    <option selected disabled>Seleccione un Curso</option>
                    <!-- mostrar lista marcas -->
                    <?php foreach ($cursos as $indice => $data): ?>
                        <option value="<?= $indice ?>" <?= ($alumno->getCurso() == $indice) ? 'selected' : null ?>>
                            <?= $data ?>
                        </option>
                    <?php endforeach; ?>
                </select>

            </div>

            <!-- lista checbox dinámica categorias -->
            <div class="mb-3">
                <label for="categorias" class="form-label">Seleccione las Asignaturas</label>
                <div class="form-control">
                    <!-- muestro el array categorías -->
                    <?php foreach ($asignaturas as $indice => $data): ?>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="asignaturas[]" value="<?= $indice ?>"
                                <?= (in_array($indice, $alumno->getAsignaturas())) ? 'checked' : null ?>>
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
            <button type="submit" class="btn btn-primary">Añadir</button>

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