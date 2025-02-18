<!doctype html>
<html lang="es">

<head>
    <?php require_once 'template/layouts/head.layout.php'; ?>
    <title>Álbumes - Gestión GesÁlbumes </title>
    <link rel="stylesheet" href="views/album/main/index.css">
</head>

<body>
    <!-- Menú fijo superior -->
    <?php require_once 'template/partials/menu.auth.partial.php' ?>

    <!-- Capa Principal -->
    <div class="container">
        <br><br><br><br>

        <!-- capa de errores -->
        <?php require_once 'template/partials/error.partial.php' ?>

        <!-- capa de mensajes -->
        <?php require_once 'template/partials/mensaje.partial.php' ?>

        <!-- Estilo card de bootstrap -->
        <div class="card">
            <div class="card-header">
                <h5 class="card-title"><?= $this->title ?></h5>
            </div>
            <div class="card-body">

                <!-- detalles de albums  -->

                <!-- Menú principal panel de albums  -->
                <?php include 'views/album/partials/menu.album.partial.php'; ?>

                <!-- tabla de albums -->
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <!-- Mostramos el encabezado de la tabla -->
                            <tr>
                                <th>Id</th>
                                <th>Título</th>
                                <th>Descripción</th>
                                <th>Autor</th>
                                <th>Fecha</th>
                                <th>Lugar</th>
                                <th>Categoría</th>
                                <th>Etiquetas</th>
                                <th class='text-end'>Nº Fotos</th>
                                <th class='text-end'>Nº Visitas</th>
                                <th>Carpeta</th>
                                <!-- columna de acciones -->
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Mostramos cuerpo de la tabla -->
                            <?php while ($album = $this->albumes->fetch()): ?>
                                <tr class="align-middle">
                                    <!-- Detalles de artículos -->
                                    <td><?= $album->id ?></td>
                                    <td><?= $album->titulo ?></td>
                                    <td><?= $album->descripcion ?></td>
                                    <td><?= $album->autor ?></td>
                                    <td><?= $album->fecha ?></td>
                                    <td><?= $album->lugar ?></td>
                                    <td><?= $album->categoria ?></td>
                                    <td><?= $album->etiquetas ?></td>
                                    <td class='text-end'><?= $album->num_fotos ?></td>
                                    <td class='text-end'><?= $album->num_visitas ?></td>
                                    <td><?= $album->carpeta ?></td>

                                    <!-- Columna de acciones -->
                                    <td>
                                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                            <a href="<?= URL ?>album/eliminar/<?= $album->id ?>/<?= $_SESSION['csrf_token'] ?>"
                                                title="Eliminar"
                                                class="btn btn-danger
                                                <?= !in_array($_SESSION['role_id'], $GLOBALS['album']['eliminar']) ? 'disabled' : null ?>"
                                                onclick="return confirm('Confimar elimación del álbum')"
                                                aria-label="Eliminar album"><i class="bi bi-trash-fill"></i></a>
                                            <a href="<?= URL ?>album/editar/<?= $album->id ?>/<?= $_SESSION['csrf_token'] ?>"
                                                title="Editar"
                                                class="btn btn-primary
                                                <?= !in_array($_SESSION['role_id'], $GLOBALS['album']['editar']) ? 'disabled' : null ?>">
                                                <i class="bi bi-pencil-square"></i></a>
                                            <a href="<?= URL ?>album/mostrar/<?= $album->id ?>/<?= $_SESSION['csrf_token'] ?>"
                                                title="Mostrar"
                                                class="btn btn-warning 
                                                <?= !in_array($_SESSION['role_id'], $GLOBALS['album']['mostrar']) ? 'disabled' : null ?>">
                                                <i class="bi bi-eye-fill"></i></a>

                                            <!-- Botón para abrir el modal -->
                                            <a href="#"
                                                class="btn btn-success btnAbrirModal 
                                            <?= !in_array($_SESSION['role_id'], $GLOBALS['album']['subir']) ? 'disabled' : null ?>"
                                                data-id="<?= $album->id ?>">
                                                <i class="bi bi-cloud-upload"></i>
                                            </a>


                                        </div>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>

                    </table>

                    <!-- Modal de subida de imágenes -->
                    <div id="modalSubida" class="modal">
                        <div class="modal-content">
                            <span class="close">&times;</span>
                            <h2>Subir imágenes al álbum</h2>
                            <form id="formSubida" action="<?= URL ?>album/subir" method="POST"
                                enctype="multipart/form-data">
                                <input type="hidden" name="album_id" id="album_id">
                                <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                                <input type="hidden" name="MAX_FILE_SIZE" value="5242880">
                                <input type="file" id="imagenes" name="imagenes[]"
                                    accept="image/png, image/jpeg, image/gif" multiple required>
                                <p id="mensajeError" style="color: red; display: none;"></p>
                                <button type="submit">Subir Imágenes</button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
            <div class="card-footer">
                Nº albums <?= $this->albumes->rowCount() ?>
            </div>
        </div>
        <br><br><br>

    </div>

    <!-- /.container -->

    <?php require_once 'template/partials/footer.partial.php' ?>
    <?php require_once 'template/layouts/javascript.layout.php' ?>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const modal = document.getElementById("modalSubida");
            const btnCerrar = document.querySelector(".close");
            const form = document.getElementById("formSubida");
            const inputImagenes = document.getElementById("imagenes");
            const mensajeError = document.getElementById("mensajeError");

            // Ocultar el modal al inicio
            modal.style.display = "none";

            // Seleccionar todos los botones de abrir modal
            document.querySelectorAll(".btnAbrirModal").forEach(btn => {
                btn.addEventListener("click", function (event) {
                    event.preventDefault(); // Evita comportamiento por defecto del enlace
                    modal.style.display = "block";

                    // Opcional: Si necesitas saber el álbum relacionado
                    let albumId = this.getAttribute("data-id");
                    document.getElementById("album_id").value = albumId;
                });
            });

            // Cerrar modal
            btnCerrar.addEventListener("click", () => {
                modal.style.display = "none";
            });

            // Cerrar modal si el usuario hace clic fuera del contenido
            window.addEventListener("click", (event) => {
                if (event.target === modal) {
                    modal.style.display = "none";
                }
            });
        });


    </script>
</body>

</html>