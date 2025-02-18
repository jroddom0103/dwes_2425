<!doctype html>
<html lang="es">

<head>
    <?php require_once 'template/layouts/head.layout.php'; ?>
    <title><?= $this->title ?> </title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <!-- Menú fijo superior -->
    <?php require_once 'template/partials/menu.auth.partial.php' ?>

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
                <!-- Detalles del álbum -->
                <div class="row">
                    <div class="col-md-4">
                        <p><strong>Portada del álbum:</strong></p>
                        <?php if (!empty($this->fotos)): ?>
                            <img src="<?= URL ?>uploads/albumes/<?= $this->album->carpeta ?>/<?= $this->fotos[0] ?>"
                                class="img-fluid" alt="Portada del álbum">
                        <?php else: ?>

                            <img src="<?= URL ?>uploads/albumes/default.jpg" class="img-fluid" alt="Portada del álbum">
                        <?php endif; ?>
                    </div>
                    <div class="col-md-8">
                        <h3><?= $this->album->titulo ?></h3>
                        <p><strong>Descripción:</strong> <?= $this->album->descripcion ?></p>
                        <p><strong>Autor:</strong> <?= $this->album->autor ?></p>
                        <p><strong>Fecha:</strong> <?= $this->album->fecha ?></p>
                        <p><strong>Lugar:</strong> <?= $this->album->lugar ?></p>
                        <p><strong>Categoría:</strong> <?= $this->album->categoria ?></p>
                        <p><strong>Etiquetas:</strong> <?= $this->album->etiquetas ?></p>
                        <p><strong>Número de fotos:</strong> <?= $this->album->num_fotos ?></p>
                        <p><strong>Número de visitas:</strong> <?= $this->album->num_visitas ?></p>
                    </div>
                </div>
                <hr>
                <!-- Galería de fotos -->
                <div class="row">
                    <?php foreach ($this->fotos as $foto): ?>
                        <div class="col-md-3">
                            <div class="card mb-4 shadow-sm">
                                <img src="<?= URL ?>uploads/albumes/<?= $this->album->carpeta ?>/<?= $foto ?>"
                                    class="card-img-top" alt="<?= $foto ?>">
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="card-footer">
                <!-- botones de acción -->
                <a class="btn btn-secondary" href="<?= URL ?>album" role="button">Volver</a>
            </div>
        </div>
        <br><br><br>

    </div>

    <!-- /.container -->

    <?php require_once 'template/partials/footer.partial.php' ?>
    <?php require_once 'template/layouts/javascript.layout.php' ?>

</body>

</html>