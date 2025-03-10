<!DOCTYPE html>
<html lang="es">

<head>
    <?php include 'views/layouts/layout.head.html'; ?>
    <title>Mostrar Libro - CRUD Libros </title>
</head>

<body>
    <!-- Capa Principal -->
    <div class="container">

        <!-- Encabezado proyecto -->
        <?php include 'views/partials/partial.header.php'; ?>

        <legend>Formulario Mostrar Libro</legend>

        <!-- Formulario Nuevo libro -->

        <form>

            <!-- id -->
            <div class="mb-3">
                <label for="id" class="form-label">Id</label>
                <input type="text" class="form-control" name="id" value="<?= $libro->id?>" disabled>
            </div>

            <!-- titulo -->
            <div class="mb-3">
                <label for="titulo" class="form-label">Titulo</label>
                <input type="text" class="form-control" name="titulo" value="<?= $libro->titulo?>" disabled>
            </div>

            <!-- autor -->
            <div class="mb-3">
                <label for="autor" class="form-label">Autor</label>
                <input type="text" class="form-control" name="autor" value="<?= $libro->autor?>" disabled>
            </div>

            <!-- editorial -->
            <div class="mb-3">
                <label for="editorial" class="form-label">Editorial</label>
                <input type="text" class="form-control" name="editorial" value="<?= $libro->editorial?>" disabled>
            </div>

            <!-- Precio -->
            <div class="mb-3">
                <label for="precio" class="form-label">Precio (€)</label>
                <input type="number" class="form-control" name="precio" step="0.01" value="<?= $libro->precio?>" disabled>
            </div>

            <!-- Unidades -->
            <div class="mb-3">
                <label for="precio" class="form-label">Unidades</label>
                <input type="number" class="form-control" name="precio" step="0.01" value="<?= $libro->stock?>" disabled>
            </div>

            <!-- fecha_edicion -->
            <div class="mb-3">
                <label for="fecha_edicion" class="form-label">Fecha Edición</label>
                <input type="date" class="form-control" name="fecha_edicion" value="<?= $libro->fecha_edicion?>" disabled>
            </div>

            <!-- ISBN -->
            <div class="mb-3">
                <label for="precio" class="form-label">ISBN</label>
                <input type="number" class="form-control" name="precio" step="0.01" value="<?= $libro->isbn?>" disabled>
            </div>

            <!-- Géneros -->
            <div class="mb-3">
                <label for="generos" class="form-label">Géneros</label>
                <input type="text" class="form-control" name="generos" value="<?=implode(', ',$conexion->get_generos_asociados($libro->generos_id));?>" disabled>
            </div>

            <!-- botones de acción -->
            <a class="btn btn-primary" href="index.php" role="button">Cancelar</a>

        </form>

        <!-- Fin formulario nuevo artículo -->



    </div>
    <br><br><br>

    <!-- Pie del documento -->
    <?php include 'views/partials/partial.footer.php'; ?>

    <!-- Bootstrap Javascript y popper -->
    <?php include 'views/layouts/layout.javascript.html'; ?>


</body>

</html>