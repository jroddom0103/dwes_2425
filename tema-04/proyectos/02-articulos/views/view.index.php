<!DOCTYPE html>
<html lang="es">

<head>
    <?php include 'layouts/layout.head.html'; ?>
    <title>Gestión de Artículos - Home </title>
</head>

<body>
    <!-- Capa Principal -->
    <div class="container">

        <!-- Encabezado proyecto -->
        <?php include 'partials/partial.header.php'; ?>


        <!-- Menú principal -->
        <?php include 'partials/partial.menu.php'; ?>

        <div class="table-responsive">
            <table class="table">
                <thead>
                    <!-- Mostramos el encabezado de la tabla -->
                    <tr>
                        <th>Id</th>
                        <th>Descripción</th>
                        <th>Modelo</th>
                        <th>Marca</th>
                        <th>Categorías</th>
                        <th class='text-end'>Unidades</th>
                        <th class='text-end'>Precio</th>
                        <!-- columna de acciones -->
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Mostramos cuerpo de la tabla -->
                    <?php foreach ($t_articulos as $articulo): ?>
                        <tr>
                            <!-- Detalles de artículos -->
                            <td><?= $articulo->getId() ?></td>
                            <td><?= $articulo->getDescripcion() ?></td>
                            <td><?= $articulo->getModelo() ?></td>
                            <td><?= $marcas[$articulo->getMarca()] ?></td>
                            <td><?= implode(', ', $articulo->getCategorias()) ?></td>
                            <td class='text-end'><?= number_format($articulo->getUnidades(), 1, ',', '.') ?></td>
                            <td class='text-end'><?= number_format($articulo->getPrecio(), 2, ',', '.') . ' €' ?></td>

                            <!-- Columna de acciones -->
                            <td>
                                <a href="eliminar.php?id=<?= $articulo->getId() ?>" title="Eliminar"><i
                                        class="bi bi-trash-fill"></i></a>
                                <a href="editar.php?id=<?= $articulo->getId() ?>" title="Editar"><i
                                        class="bi bi-pencil-square"></i></a>
                                <a href="mostrar.php?id=<?= $articulo->getId() ?>" title="Mostrar"><i
                                        class="bi bi-eye-fill"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="6">Nº Registros <?= count($t_articulos) ?></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
    <br><br><br>

    <!-- Pie del documento -->
    <?php include 'partials/partial.footer.php'; ?>

    <!-- Bootstrap Javascript y popper -->
    <?php include 'layouts/layout.javascript.html'; ?>


</body>

</html>