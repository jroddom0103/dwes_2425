<!DOCTYPE html>
<html lang="es">

<head>
    <?php include 'views/layouts/layout.head.html'; ?>
    <title>Editar Corredor - BBDD maratoon </title>

    <style>
        #cajaSexo {
            border: gainsboro 2px solid;
            padding: 10px;
        }
    </style>
</head>

<body>
    <!-- Capa Principal -->
    <div class="container">

        <!-- Encabezado proyecto -->
        <?php include 'views/partials/partial.header.php'; ?>

        <legend>Formulario Editar Corredor</legend>

        <!-- Formulario Editar corredor -->

        <form action="update.php?id=<?=$corredor->id?>" method="POST">

            <!-- Nombre -->
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" name="nombre" value="<?= $corredor->nombre ?>">
            </div>

            <!-- Apellidos -->
            <div class="mb-3">
                <label for="apellidos" class="form-label">Apellidos</label>
                <input type="text" class="form-control" name="apellidos" value="<?= $corredor->apellidos ?>">
            </div>

            <!-- Apellidos -->
            <div class="mb-3">
                <label for="ciudad" class="form-label">Ciudad</label>
                <input type="text" class="form-control" name="ciudad" value="<?= $corredor->ciudad ?>">
            </div>

            <!-- Fecha Nacimiento -->
            <div class="mb-3">
                <label for="fechaNacimiento" class="form-label">Fecha de Nacimiento</label>
                <input type="date" class="form-control" name="fechaNacimiento"
                    value="<?= $corredor->fechaNacimiento ?>">
            </div>

            <!-- Sexo -->
            <div id="cajaSexo" class="mb-3">
                <label for="sexo" class="form-label">Sexo</label>
                <div class="d-flex flex-wrap gap-2">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="sexo" id="hombre" value="H"
                            <?= ($corredor->sexo == 'H') ? 'checked' : ''; ?>>
                        <label class="form-check-label" for="hombre">Hombre</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="sexo" id="mujer" value="M"
                            <?= ($corredor->sexo == 'M') ? 'checked' : ''; ?>>
                        <label class="form-check-label" for="mujer">Mujer</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="sexo" id="sinEspecificar" value=""
                            <?= ($corredor->sexo == '') ? 'checked' : ''; ?>>
                        <label class="form-check-label" for="sinEspecificar">Sin especificar</label>
                    </div>
                </div>
            </div>


            <!-- Email -->
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" value="<?= $corredor->email ?>">
            </div>

            <!-- Dni -->
            <div class="mb-3">
                <label for="dni" class="form-label">Dni</label>
                <input type="text" class="form-control" name="dni" value="<?= $corredor->dni ?>">
            </div>


            <!-- Select Dinámico Categorías -->
            <div class="mb-3">
                <label for="club" class="form-label">Categoría</label>
                <select class="form-select" name="id_categoria">
                    <option selected disabled>Seleccione categoría</option>
                    <?php foreach ($categorias as $id => $nombre): ?>
                        <option value="<?= $id ?>" <?= ($corredor->id_categoria == $id) ? 'selected' : null ?>>
                            <?= $nombre ?>
                        </option>
                    <?php endforeach; ?>
                </select>

            </div>


            <!-- Select Dinámico Clubs -->
            <div class="mb-3">
                <label for="club" class="form-label">Club</label>
                <select class="form-select" name="id_club">
                    <option selected disabled>Seleccione club</option>
                    <?php foreach ($clubs as $id => $nombre): ?>
                        <option value="<?= $id ?>" <?= ($corredor->id_club == $id) ? 'selected' : null ?>>
                            <?= $nombre ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- botones de acción -->
            <a class="btn btn-secondary" href="index.php" role="button">Cancelar</a>
            <button type="reset" class="btn btn-danger">Borrar</button>
            <button type="submit" class="btn btn-primary">Enviar</button>

        </form>
        <!-- Fin formulario Editar corredor -->
    </div>
    <br><br><br>

    <!-- Pie del documento -->
    <?php include 'views/partials/partial.footer.php'; ?>

    <!-- Bootstrap Javascript y popper -->
    <?php include 'views/layouts/layout.javascript.html'; ?>


</body>

</html>