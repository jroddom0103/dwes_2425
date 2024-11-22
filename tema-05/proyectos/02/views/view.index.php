<!DOCTYPE html>
<html lang="es">

<head>
    <?php include 'views/layouts/layout.head.html'; ?>
    <title>Gestión de Libros - Home </title>
</head>

<body>
    <!-- Capa Principal -->
    <div class="container">

        <!-- Encabezado proyecto -->
        <?php include 'views/partials/partial.header.php'; ?>


        <!-- Menú principal -->
        <?php include 'views/partials/partial.menu.php'; ?>

        <div class="table-responsive">
            <table class="table">
                <thead>
                    <!-- Mostramos el encabezado de la tabla -->
                    <tr>
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>Apellidos</th>
                        <th>Email</th>
                        <th>Telefono</th>
                        <th>Nacionalidad</th>
                        <th>Materia</th>
                        <th>Curso</th>
                        <th class='text-end'>Edad</th>
                        <!-- columna de acciones -->
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Mostramos cuerpo de la tabla -->
                    <?php while ($alumno=$alumnos->fetch_object()):?>
                        <tr class="align-middle">
                            <td><?= $alumno->id ?></td>
                            <td><?= $alumno->nombre ?></td>
                            <td><?= $alumno->apellidos ?></td>
                            <td><?= $alumno->email ?></td>
                            <td><?= $alumno->telefono ?></td>
                            <td><?= $alumno->nacionalidad ?></td>
                            <td><?= $alumno->dni ?></td>
                            <td><?= $alumno->curso ?></td>
                            <td class="text-end"><?= $alumno->edad?></td>
                            <!-- Columna de acciones -->
                            <td>
                                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                    <a href="eliminar.php?indice=<?= $indice ?>" title="Eliminar" class="btn btn-danger" onclick="return confirm('Confimar elimación del artículo')"><i class="bi bi-trash-fill"></i></a>
                                    <a href="editar.php?indice=<?= $indice ?>" title="Editar" class="btn btn-primary"><i class="bi bi-pencil-square"></i></a>
                                    <a href="mostrar.php?indice=<?= $indice ?>" title="Mostrar" class="btn btn-warning"><i class="bi bi-eye-fill"></i></a>
                                </div>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="9">Nº Registros <?= $alumnos->num_rows ?></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
    <br><br><br>

    <!-- Pie del documento -->
    <?php include 'views/partials/partial.footer.php'; ?>

    <!-- Bootstrap Javascript y popper -->
    <?php include 'views/layouts/layout.javascript.html'; ?>


</body>

</html>