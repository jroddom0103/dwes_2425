<!DOCTYPE html>
<html lang="es">
<head>
    <!-- Cargar bootstrap css -->
    <?php include "layouts/head.html"?>
    <title>Gestión de Películas - Home </title>
</head>
<body>
    <!-- Capa Principal -->
    <div class="container">

        <!-- Encabezado proyecto -->
        <?php include "partials/partial.header.php";?>      
        <!-- Menú principal -->
        <?php include "partials/partial.menu.php";?>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <!-- encabezado de la tabla -->
                    <th>Id</th>
                    <th>Películas</th>
                    <th>País</th>
                    <th>Director</th>
                    <th>Género</th>
                    <th>Año</th>
                </thead>
                <tbody>
                    <?php foreach($tabla as $indice => $registro):?>
                        <tr class="align-middle">
                            <!-- Columnas de la tabla películas -->
                            
                                <td><?=$registro['id']?></td>
                                <td><?=$registro['titulo']?></td>
                                <td><?=$registro['pais']?></td>
                                <td><?=$registro['director']?></td>
                                <td><?=$registro['genero']?></td>
                                <td><?=$registro['año']?></td>
                               
                            <!-- Columna de acciones -->
                            <td>
                                <a href="delete.php?indice=<?=$indice?>" title="Eliminar" class="btn btn-secondary"><i class="bi bi-trash-fill"></i></a>
                                <a href="editar.php?indice=<?=$indice?>" title="Editar" class="btn btn-secondary"><i class="bi bi-pencil-square"></i></a>
                                <a href="mostrar.php?indice=<?=$indice?>" title="Mostrar" class="btn btn-secondary"><i class="bi bi-eye-fill"></i></a>
                            </td>
                        </tr>
                    <?php endforeach?>     
                   
                </tbody>
                <tfoot>
                    <!-- Mostrar el número de registros -->
                    <tr><td colspan="6">Nº Registros: <?=count($tabla)?></td></tr>
                </tfoot>
            </table>
        </div>
    </div>
    <br><br><br>

    <!-- Pie del documento -->
    <?php include "partials/partial.footer.php";?>
    <!-- Bootstrap Javascript y popper -->
    <?php include "layouts/javascript.html";?>
 
</body>
</html>