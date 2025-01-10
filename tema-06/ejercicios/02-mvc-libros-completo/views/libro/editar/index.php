<!doctype html>
<html lang="es">

<head>
    <?php require_once 'template/layouts/head.layout.php'; ?>
    <title><?= $this->title ?> </title>
</head>

<body>
    <!-- Menú fijo superior -->
    <?php require_once 'template/partials/menu.partial.php' ?>

    <!-- Capa Principal -->
    <div class="container">
        <br><br><br><br>

        <!-- capa de mensajes -->
        <?php require_once 'template/partials/mensaje.partial.php' ?>

        <!-- Estilo card de bootstrap -->
        <div class="card">
            <div class="card-header">
                <h5 class="card-title"><?= $this->title ?></h5>
            </div>
            <div class="card-body">
                <!-- Formulario de alumnos  -->
                <!-- Enviar al controlador update con el id del alumno -->
                <form action="<?= URL ?>alumno/update/<?= $this->id ?>" method="POST">

                    <!-- id -->
                    <div class="mb-3">
                        <label for="id" class="form-label">Id</label>
                        <input type="number" class="form-control" value="<?= $this->libro->id ?>" disabled>
                    </div>

                    <!-- Título -->
                    <div class="mb-3">
                        <label for="titulo" class="form-label">Título</label>
                        <input type="text" class="form-control" name="titulo" value="<?= $this->libro->titulo ?>">
                    </div>

                    <!-- Autor -->
                    <div class="mb-3">
                        <label for="autor" class="form-label">Autor</label>
                        <select class="form-select" name="autor_id">
                            <option selected disabled>Seleccione autor</option>
                            <?php foreach ($this->autores as $autor): ?>
                                <option value="<?= $autor->id ?>" <?= $autor->id == $this->libro->autor_id ? 'selected' : '' ?>>
                                    <?= $autor->nombre ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- Editorial -->
                    <div class="mb-3">
                        <label for="editorial" class="form-label">Editorial</label>
                        <select class="form-select" name="editorial_id">
                            <option selected disabled>Seleccione editorial</option>
                            <?php foreach ($this->editoriales as $editorial): ?>
                                <option value="<?= $editorial->id ?>" <?= $editorial->id == $this->libro->editorial_id ? 'selected' : '' ?>>
                                    <?= $editorial->nombre ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- Géneros -->
                    <div class="mb-3">
                        <label for="generos" class="form-label">Géneros</label>
                        <?php
                        // Obtener los géneros seleccionados del libro
                        $generosSeleccionados = explode(',', $this->libro->generos_id);

                        // Obtener todos los géneros desde el modelo
                        foreach ($this->get_generos() as $genero): ?>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="generos[]" value="<?= $genero->id ?>"
                                    <?= in_array($genero->id, $generosSeleccionados) ? 'checked' : '' ?>>
                                <label class="form-check-label" for="genero<?= $genero->id ?>">
                                    <?= $genero->tema ?>
                                </label>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <!-- Stock -->
                    <div class="mb-3">
                        <label for="stock" class="form-label">Stock</label>
                        <input type="number" class="form-control" name="stock" value="<?= $this->libro->stock ?>">
                    </div>

                    <!-- Precio -->
                    <div class="mb-3">
                        <label for="precio" class="form-label">Precio</label>
                        <input type="number" class="form-control" name="precio" value="<?= $this->libro->precio ?>">
                    </div>
                </form>
            </div>
            <div class="card-footer">
                <!-- botones de acción -->
                <a class="btn btn-secondary" href="<?= URL ?>alumno" role="button">Cancelar</a>
                <button type="reset" class="btn btn-danger">Borrar</button>
                <button type="submit" class="btn btn-primary">Actualizar</button>
            </div>
            </form>
            <!-- Fin formulario nuevo artículo -->
        </div>
        <br><br><br>

    </div>

    <!-- /.container -->

    <?php require_once 'template/partials/footer.partial.php' ?>
    <?php require_once 'template/layouts/javascript.layout.php' ?>

</body>

</html>