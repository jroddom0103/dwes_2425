<!DOCTYPE html>
<html lang="es">

<head>
    <!-- cargar head.html -->
    <?php include "layouts/head.html" ?>
    <title>Gestión de Artículos - Home </title>
</head>

<body>
    <!-- Capa Principal -->
    <div class="container">

        <!-- Encabezado proyecto -->
        <!-- cargar partial.header.php -->
        <?php include "partials/partial.header.php" ?>

        <!-- Menú principal -->
        <!-- cargar partial.menu.php -->
        <?php include "partials/partial.menu.php" ?>

        <div class="table-responsive">
            <table class="table">
                <thead>
                    <!-- Mostramos el encabezado de la tabla -->
                    <td>id</td>
                    <td>Descripción</td>
                    <td>Modelo</td>
                    <td>Categoría</td>
                    <td>Unidades</td>
                    <td>Precio</td>
                    <td>Acciones</td>
                </thead>
                <tbody>
                    <!-- Mostramos cuerpo de la tabla -->
                    <?php foreach (generar_tabla() as $registro)?>
                    <td>

                    <th><?= $registro['id'] ?></th>
                    <th><?= $registro['descripcion'] ?></th>
                    <th><?= $registro['modelo'] ?></th>
                    <th><?= $registro['categoria'] ?></th>
                    <th class="text-end"><?= $registro['unidades'] ?></th>
                    <th class="text-end"><?= $registro['precio'] ?></th>
                    <th>
                        <i class="bi bi-trash-fill"></i>
                        <i class="bi bi-pencil-square"></i>
                        <i class="bi bi-eye-fill"></i>
                    </th>
                    </td>
                    <??>

                </tbody>
                <tfoot>
                    <!-- Mostrar el número de registros de la tabla -->
                    Número de registros: <?=array_key_last(generar_tabla())+1?>
                </tfoot>
            </table>
        </div>
    </div>
    <br><br><br>

    <!-- Pie del documento -->
    <!-- cargar partial.footer.php -->
    <?php include "partials/partial.footer.php" ?>

    <!-- Bootstrap Javascript y popper -->
    <!-- cargar javascript.php -->
    <?php include "layouts/javascript.html" ?>


</body>

</html>