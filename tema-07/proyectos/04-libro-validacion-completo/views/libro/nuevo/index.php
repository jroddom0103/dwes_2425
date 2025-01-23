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

        <!-- capa de errores -->
        <?php require_once 'template/partials/error.partial.php' ?>

        <!-- Estilo card de bootstrap -->
        <div class="card">
            <div class="card-header">
                <!-- Protección ataques XSS -->
                <h5 class="card-title"><?= htmlspecialchars($this->title) ?></h5>
            </div>
            <div class="card-body">
                <!-- Formulario de libros  -->
                <!-- Enviar al controlador create -->
                <form action="<?= URL ?>libro/create" method="POST">

                    <!-- protección CSRF -->
                    <input type="hidden" name="csrf_token"
                        value="<?= htmlspecialchars($_SESSION['csrf_token'] ?? '') ?>">

                    <!-- Título -->
                    <div class="mb-3">
                        <label for="titulo" class="form-label">Título</label>
                        <input type="text" class="form-control
                        <?= (isset($this->error['titulo'])) ? 'is-invalid' : null ?>" id="titulo" name="titulo"
                            placeholder="Introduzca título" value="<?= htmlspecialchars($this->libro->titulo) ?>"
                            required>
                        <!-- mostrar posible error -->
                        <span class="form-text text-danger" role="alert">
                            <?= $this->error['titulo'] ??= null ?>
                        </span>
                    </div>


                    <!-- Autor -->
                    <div class="mb-3">
                        <label for="autor" class="form-label">Autor</label>
                        <select class="form-control" id="autor" name="autor">
                            <option selected disabled>Seleccione un autor</option>
                            <?php foreach ($this->autores as $indice => $autor): ?>
                                <option value="<?= $indice ?>" <?= $this->libro->autor == $indice ? 'selected' : '' ?>>
                                    <?= $autor['nombre'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <!-- mostrar posible error -->
                        <span class="form-text text-danger" role="alert">
                            <?= $this->error['autor'] ??= null ?>
                        </span>
                    </div>

                    <!-- Editorial -->
                    <div class="mb-3">
                        <label for="editorial" class="form-label">Editorial</label>
                        <select class="form-control" id="editorial" name="editorial">
                            <option selected disabled>Seleccione una editorial</option>
                            <?php foreach ($this->editoriales as $indice => $editorial): ?>
                                <option value="<?= $indice ?>" <?= $editorial == $indice ? 'selected' : '' ?>>
                                    <?= $editorial['nombre'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <!-- mostrar posible error -->
                        <span class="form-text text-danger" role="alert">
                            <?= $this->error['editorial'] ??= null ?>
                        </span>
                    </div>

                    <!-- Fecha de edición -->
                    <div class="mb-3">
                        <label for="precio" class="form-label">Fecha de Edición</label>
                        <input type="date" class="form-control
                        <?= (isset($this->error['fecha_edicion'])) ? 'is-invalid' : null ?>" id="fecha_edicion" name="fecha_edicion"
                            placeholder="Introduzca fecha de edición." value="<?= htmlspecialchars($this->libro->fecha_edicion) ?>"
                            required>

                        <!-- mostrar posible error -->
                        <span class="form-text text-danger" role="alert">
                            <?= $this->error['fecha_edicion'] ??= null ?>
                        </span>
                    </div>

                    <!-- ISBN -->
                    <div class="mb-3">
                        <label for="isbn" class="form-label">ISBN</label>
                        <input type="number" class="form-control
                        <?= (isset($this->error['isbn'])) ? 'is-invalid' : null ?>" id="isbn" name="isbn"
                            placeholder="Introduzca isbn." value="<?= htmlspecialchars($this->libro->isbn) ?>"
                            required>

                        <!-- mostrar posible error -->
                        <span class="form-text text-danger" role="alert">
                            <?= $this->error['isbn'] ??= null ?>
                        </span>
                    </div>

                    <!-- Géneros -->
                    <div class="mb-3">
                        <label for="generos" class="form-label">Géneros</label>
                        <?php foreach ($this->generos as $genero): ?>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="generos[]"
                                    value="<?= $genero['id'] ?>">
                                <label class="form-check-label" for="genero<?= $genero['id'] ?>">
                                    <?= $genero['tema'] ?>
                                </label>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <!-- Stock -->
                    <div class="mb-3">
                        <label for="stock" class="form-label">Stock</label>
                        <input type="number" class="form-control" name="stock" value="">
                    </div>

                    <!-- Precio -->
                    <div class="mb-3">
                        <label for="precio" class="form-label">Precio</label>
                        <input type="number" class="form-control
                        <?= (isset($this->error['precio'])) ? 'is-invalid' : null ?>" id="precio" name="precio"
                            placeholder="Introduzca precio." value="<?= htmlspecialchars($this->libro->precio) ?>"
                            step="0.01" required>

                        <!-- mostrar posible error -->
                        <span class="form-text text-danger" role="alert">
                            <?= $this->error['precio'] ??= null ?>
                        </span>
                    </div>

            </div>
            <div class="card-footer">
                <!-- botones de acción -->
                <a class="btn btn-secondary" href="<?= URL ?>libro" role="button">Cancelar</a>
                <button type="reset" class="btn btn-danger">Borrar</button>
                <button type="submit" class="btn btn-primary">Crear</button>
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