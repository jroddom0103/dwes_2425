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
                <!-- Formulario de libros -->
                <!-- Enviar al controlador update con el id del libro -->
                <form action="<?= URL ?>libro/update/<?= $this->libro->id ?>/<?= $this->csrf_token ?>" method="POST">

                    <!-- protección CSRF -->
                    <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token']) ?>">

                    <!-- id -->
                    <input type="number" class="form-control" name="id" value="<?= htmlspecialchars($this->id) ?>"
                        hidden>

                    <!-- Título -->
                    <div class="mb-3">
                        <label for="titulo" class="form-label">Título</label>
                        <input type="text" class="form-control
                        <?= (isset($this->error['titulo'])) ? 'is-invalid' : null ?>" id="titulo" name="titulo"
                            placeholder="Introduzca el título" value="<?= htmlspecialchars($this->libro->titulo) ?>"
                            required>
                    </div>

                    <!-- Autor -->
                    <div class="mb-3">
                        <label for="autor" class="form-label">Autor</label>
                        <select class="form-select" <?= (isset($this->error['id_autor'])) ? 'is-invalid' : null ?>
                            id="autor" name="autor" required>
                            <!-- mostrar lista de autores -->
                            <?php foreach ($this->autores as $autor): ?>
                                <option value="<?= $autor['id'] ?>" <?= $autor['id'] == $this->autor_id ? 'selected' : '' ?>>
                                    <?= $autor['nombre'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- Editorial -->
                    <div class="mb-3">
                        <label for="autor" class="form-label">Editorial</label>
                        <select class="form-select" <?= (isset($this->error['id_editorial'])) ? 'is-invalid' : null ?>
                            id="editorial" name="editorial">
                            <?php foreach ($this->editoriales as $editorial): ?>
                                <option value="<?= $editorial['id'] ?>" <?= $editorial['id'] == $this->editorial_id ? 'selected' : '' ?>>
                                    <?= $editorial['nombre'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- Fecha de Edición -->
                    <div class="mb-3">
                        <label for="fecha_edicion" class="form-label">Fecha de Edición</label>
                        <input type="text" class="form-control
                        <?= (isset($this->error['fecha_edicion'])) ? 'is-invalid' : null ?>" id="fecha_edicion" name="fecha_edicion"
                            placeholder="Introduzca la fecha de edición" value="<?= htmlspecialchars($this->libro->fecha_edicion) ?>"
                            required>
                    </div>

                    <!-- ISBN -->
                    <div class="mb-3">
                        <label for="isbn" class="form-label">ISBN</label>
                        <input type="number" class="form-control
                        <?= (isset($this->error['isbn'])) ? 'is-invalid' : null ?>" id="isbn" name="isbn"
                            step="0.01" placeholder="Introduzca el isbn"
                            value="<?= htmlspecialchars($this->libro->isbn) ?>">
                    </div>

                    <!-- Géneros -->
                    <div class="mb-3">
                        <label for="generos" class="form-label">Géneros</label>
                        <?php foreach ($this->generos as $genero): ?>
                            <div class="form-check">
                                <input
                                    class="form-check-input <?= (isset($this->error['generos'])) ? 'is-invalid' : null ?>"
                                    type="checkbox" id="genero<?= $genero['id'] ?>" name="generos[]"
                                    value="<?= $genero['id'] ?>" <?= in_array($genero['id'], $this->libro_generos) ? 'checked' : '' ?>>
                                <label class="form-check-label" for="genero<?= $genero['id'] ?>">
                                    <?= $genero['tema'] ?>
                                </label>
                            </div>
                        <?php endforeach; ?>
                        <?php if (isset($this->error['generos'])): ?>
                            <div class="invalid-feedback">
                                <?= $this->error['generos'] ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Stock -->
                    <div class="mb-3">
                        <label for="stock" class="form-label">Stock</label>
                        <input type="number" class="form-control
                        <?= (isset($this->error['stock'])) ? 'is-invalid' : null ?>" id="stock" name="stock"
                            placeholder="Introduzca la cantidad" value="<?= htmlspecialchars($this->libro->stock) ?>"
                            required>
                    </div>

                    <!-- Precio -->
                    <div class="mb-3">
                        <label for="precio" class="form-label">Precio</label>
                        <input type="number" class="form-control
                        <?= (isset($this->error['stock'])) ? 'is-invalid' : null ?>" id="precio" name="precio"
                            step="0.01" placeholder="Introduzca el precio"
                            value="<?= htmlspecialchars($this->libro->precio) ?>">
                    </div>

            </div>
            <div class="card-footer">
                <!-- botones de acción -->
                <a class="btn btn-secondary" href="<?= URL ?>libro" role="button">Cancelar</a>
                <button type="reset" class="btn btn-danger">Borrar</button>
                <button type="submit" class="btn btn-primary">Actualizar</button>
            </div>
            </form>
            <!-- Fin formulario nuevo libro -->
        </div>
        <br><br><br>

    </div>

    <!-- /.container -->

    <?php require_once 'template/partials/footer.partial.php' ?>
    <?php require_once 'template/layouts/javascript.layout.php' ?>

</body>

</html>