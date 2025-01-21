<!DOCTYPE html>
<html lang="es">
<head>
    <?php include 'views/layouts/layout.head.html'; ?>
    <title>Editar Libro - CRUD Libros </title>
</head>

<body>
    <!-- Capa Principal -->
    <div class="container">

        <!-- Encabezado proyecto -->
        <?php include 'views/partials/partial.header.php'; ?>

        <legend>Formulario Editar Libro</legend>

        <!-- Formulario Nuevo libro -->

        <form action="update.php?id=<?=$libro->id?>" method="POST">

            <!-- titulo -->
            <div class="mb-3">
                <label for="titulo" class="form-label">Titulo</label>
                <input type="text" class="form-control" name="titulo" value="<?= $libro->titulo?>">
            </div>

            <!-- autor -->
            <div class="mb-3">
                <label for="" class="form-label">Autor</label>
                <select class="form-select" name="autor_id">
                    <!-- generar lista dinámica -->
                    <?php foreach ($stmt_autores as $indice => $autor): ?>
                        <option <?= ($libro->autor == $autor) ? 'selected' : ''; ?> value="<?= $indice ?>"><?= $autor ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Editorial -->
<div class="mb-3">
    <label for="" class="form-label">Editorial</label>
    <select class="form-select" name="editorial_id">
        <!-- Generar lista dinámica de editoriales -->
        <?php foreach ($stmt_editoriales as $indice => $editorial): ?>
            <option <?= ($libro->editorial == $editorial) ? 'selected' : ''; ?> value="<?= $indice ?>"><?= $editorial ?></option>

        <?php endforeach; ?>
    </select>
</div>



            <!-- Precio -->
            <div class="mb-3">
                <label for="precio" class="form-label">Precio (€)</label>
                <input type="number" class="form-control" name="precio" step="0.01" value="<?= $libro->precio?>">
            </div>

            <!-- Unidades -->
            <div class="mb-3">
                <label for="stock" class="form-label">Unidades</label>
                <input type="number" class="form-control" name="stock" value="<?= $libro->stock?>">
            </div>

            <!-- fecha_edicion -->
            <div class="mb-3">
                <label for="fecha_edicion" class="form-label">Fecha Edición</label>
                <input type="date" class="form-control" name="fecha_edicion" value="<?= $libro->fecha_edicion?>">
            </div>

            <!-- ISBN -->
            <div class="mb-3">
                <label for="precio" class="form-label">ISBN</label>
                <input type="number" class="form-control" name="isbn" step="0.01" value="<?= $libro->isbn?>">
            </div>

            <!-- lista checbox dinámica géneros -->
            <div class="mb-3">
                <label for="generos" class="form-label">Géneros</label>
                <div class="form-control">
                    <!-- muestro el array categorías -->
                    <?php foreach ($stmt_generos as $indice => $genero): ?>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="<?=$indice?>" id="generos_id" name="generos_id[]"
                            <?= in_array($indice, explode(',', $libro->generos_id)) ? 'checked' : ''; ?>
                            >
                            <label class="form-check-label" for="flexCheckDefault">
                                <?= $genero ?>
                            </label>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- botones de acción -->
            <a class="btn btn-primary" href="index.php" role="button">Cancelar</a>
            <button type="submit" class="btn btn-danger">Enviar</button>

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


