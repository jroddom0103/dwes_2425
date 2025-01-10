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
                <!-- Formulario de alumnos  sin edicion-->
                <form>

                    <!-- id -->
                    <div class="mb-3">
                        <label for="id" class="form-label">Id</label>
                        <input type="number" class="form-control" value="<?= $this->libro->id ?>" disabled>
                    </div>

                    <!-- Título -->
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Título</label>
                        <input type="text" class="form-control" value="<?= $this->libro->titulo ?>" disabled>
                    </div>

                    <!-- Nombre -->
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Autor</label>
                        <input type="text" class="form-control" value="<?= $this->libro->autor ?>" disabled>
                    </div>
                    <!-- Apellidos -->
                    <div class="mb-3">
                        <label for="apellidos" class="form-label">Editorial</label>
                        <input type="text" class="form-control" value="<?= $this->libro->editorial ?>" disabled>
                    </div>
                    <!-- Géneros -->
                    <div class="mb-3">
                        <label for="generos" class="form-label">Géneros</label>
                        <input type="text" class="form-control" value="<?= $this->libro->generos[$this->libro->generos_id] ?>" disabled>
                    </div>
                    <!-- Stock -->
                    <div class="mb-3">
                        <label for="dni" class="form-label">Stock</label>
                        <input type="number" class="form-control" value="<?= $this->libro->stock ?>" disabled>
                    </div>
                    <!-- Precio -->
                    <div class="mb-3">
                        <label for="dni" class="form-label">Precio</label>
                        <input type="number" class="form-control" value="<?= $this->libro->precio ?>" disabled>
                    </div>

            </div>
            <div class="card-footer">
                <!-- botones de acción -->
                <a class="btn btn-secondary" href="<?= URL ?>libro" role="button">Volver</a>
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