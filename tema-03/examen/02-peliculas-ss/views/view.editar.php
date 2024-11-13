<!DOCTYPE html>
<html lang="es">

<head>
    <!-- bootstrap css -->
    <?php include "layouts/head.html"?>
    <title>Películas - Nuevo </title>
</head>

<body>
    <!-- Capa Principal -->
    <div class="container">

        <!-- Cabecera del documento -->
        <?php include "partials/partial.header.php";?>  

        <legend>Formulario Editar Película</legend>

        <form action="update.php?indice=<?$indice?>" method="POST">

            <!-- id -->
            <div class="mb-3">
                <label for="titulo" class="form-label">Id</label>
                <input type="text" class="form-control" name="id" value="<?=$registro['id']?>">
            </div>

            <!-- Campo título -->
            <div class="mb3">
                <label class="form-label">Título</label>
                <input type="text" class="form-control" name="titulo" value="<?=$registro['titulo']?>">
            </div>

            <!-- Pais -->
            <div class="mb-3">
                <label class="form-label">Pais</label>
                <input type="text" class="form-control" name="pais" value="<?=$registro['pais']?>">
            </div>

            <!-- Campo director -->
            <div class="mb3">
                <label class="form-label">Director</label>
                <input type="text" class="form-control" name="director" value="<?=$registro['director']?>">
            </div>

             <!-- Género -->
             <div class="mb3">
                <label class="form-label">Género</label>
                <input type="text" class="form-control" name="genero" value="<?=$registro['genero']?>">
            </div>

            <!-- Año -->
            <div class="mb-3">
                <label for="unidades" class="form-label">Año</label>
                <input type="text" class="form-control" name="año" value="<?=$registro['año']?>">
            </div>

            <!-- botones de acción -->
            <a class="btn btn-secondary" href="index.php" role="button">Cancelar</a>
            <button type="reset" class="btn btn-danger">Borrar</button>
            <button type="submit" class="btn btn-primary">Enviar</button>

        </form>

        <br><br><br>

        <!-- Pie del documento -->
        <?php include "partials/partial.footer.php";?>
        <!-- Bootstrap Javascript y popper -->
        <?php include "layouts/javascript.html";?>

</body>

</html>