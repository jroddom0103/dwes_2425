<!DOCTYPE html>
<html lang="es">
<head>
    <!-- incluye head -->
    <?php include('layouts/layout.head.html')?>
    <title>Gestión de jugadores - Home </title>
</head>
<body>
    <!-- Capa Principal -->
    <div class="container">

        <!-- Encabezado proyecto -->
        <!-- incluye header -->
        <?php include('partials/partial.header.php')?>
                
        <!-- Menú principal -->
        <!-- incluye menú principal -->
        <?php include('partials/partial.menu.php')?>
       
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <!-- Mostramos el encabezado de la tabla -->
                    <tr>
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>Equipo</th>
                        <th>Nacionalidad</th>
                        <th>Posiciones</th>
                        <th class='text-end'>Edad</th>
                        <th class='text-end'>Altura</th>
                        <th class='text-end'>Peso</th>
                        <th class='text-end'>Valor</th>
                        
                        <!-- columna de acciones -->
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Mostramos cuerpo de la tabla -->
                        <?php foreach($tabla as $indice => $valor):?>
                        <tr>
                            <!-- Mostramos detalles del jugador -->
                            <td><?=$valor['id']?></td>
                            <td><?=$valor['nombre']?></td>
                            <td><?=$equipos[$valor['equipo_id']]?></td>
                            <td><?=$valor['nacionalidad']?></td>
                            <td><?=implode(', ',$valor['posiciones_id'])?></td>
                            <td><?=$valor['f_nacimiento']?></td>
                            <td><?=number_format($valor['altura'],2,',','.')?></td>
                            <td><?=number_format($valor['peso'],2,',','.')?></td>
                            <td><?=number_format($valor['valor_mercado'],2,',','.')?></td>
                            <!-- Columna de acciones -->
                            <td>
                            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                <a href="eliminar.php?indice=<?=$indice?>" title="Eliminar" class="btn btn-danger" onclick="return confirm('Confirmar eliminación del jugador')"><i class="bi bi-trash-fill"></i></a>
                                <a href="editar.php?indice=<?=$indice?>" title="Editar" class="btn btn-primary"><i class="bi bi-pencil-square"></i></a>
                                <a href="mostrar.php?indice=<?=$indice?>" title="Mostrar" class="btn btn-warning"><i class="bi bi-eye-fill"></i></a>
                            </div>
                            </td>
                        </tr>
                        <?php endforeach?>
                </tbody>
                <tfoot>
                    <tr><td colspan="6">Nº Registros</td></tr>
                </tfoot>
            </table>
        </div>
    </div>
    <br><br><br>

    <!-- Pie del documento -->
     <!-- incluye footer -->
    <?php include('partials/partial.footer.php')?>
   
    <!-- Bootstrap Javascript y popper -->
    <!-- incluye javascript -->
    <?php include('layouts/layout.javascript.html')?>
    
 
</body>
</html>