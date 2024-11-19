<!DOCTYPE html>
<html lang="es">

<head>
    <!-- inclye head -->
    <?php include('layouts/layout.head.html')?>
    <title>Nuevo Jugador - CRUD Jugadores </title>
</head>

<body>
    <!-- Capa Principal -->
    <div class="container">

        <!-- Encabezado proyecto -->
       <!-- incluye header -->
       <?php include('partials/partial.header.html')?>

        <legend>Formulario Nuevo Jugador</legend>

        <!-- Formulario Nuevo libro -->

        <form>

            <!-- id -->
            <div class="mb-3">
                <label for="id" class="form-label">Id</label>
                <input type="text" class="form-control">
            </div>

            <!-- nombre -->
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control">
            </div>

            <!-- f_nacimiento -->
            <div class="mb-3">
                <label for="fecha_edicion" class="form-label">Fecha Nacimiento</label>
                <input type="date" class="form-control">
            </div>

            <!-- nacionalidad -->
            <div class="mb-3">
                <label for="nacionalidad" class="form-label">Nacionalidad</label>
                <input type="text" class="form-control" >
            </div>

            <!-- Nº Camiseta -->
            <div class="mb-3">
                <label for="num_camiseta" class="form-label">num_camiseta</label>
                <input type="number" class="form-control">
            </div>

            <!-- altura -->
            <div class="mb-3">
                <label for="altura" class="form-label">Altura (m)</label>
                <input type="number" class="form-control" step="0.01">
            </div>

            <!-- peso -->
            <div class="mb-3">
                <label for="peso" class="form-label">Peso (Kg)</label>
                <input type="number" class="form-control" step="0.01">
            </div>

            <!-- valor mercado -->
            <div class="mb-3">
                <label for="valor_mercado" class="form-label">Valor Mercado (€)</label>
                <input type="number" class="form-control" step="0.01">
            </div>

            <!-- Select Dinámico Equipo -->
            <div class="mb-3">
                <label for="equipo_id" class="form-label">Equipo</label>
                <select class="form-select" >
                    <option selected disabled>Seleccione equipo</option>
                    <!-- mostrar lista equipos -->
                    
                </select>

            </div>

            <!-- lista checbox dinámica posiciones_id -->
            <div class="mb-3">
                <label for="posiciones_id" class="form-label">Posiciones de juego</label>
                <div class="form-control">
                    <!-- muestro el array posiciones -->
                    
                </div>
            </div>

            <!-- botones de acción -->
            <a class="btn btn-secondary" href="index.php" role="button">Cancelar</a>
            <button type="reset" class="btn btn-danger">Borrar</button>
            <button type="submit" class="btn btn-primary">Enviar</button>

        </form>

        <!-- Fin formulario nuevo jugador -->



    </div>
    <br><br><br>

    <!-- Pie del documento -->
    <!-- incluye footer -->
    <?php include('partials/partial.footer.html')?>
    <!-- Bootstrap Javascript y popper -->
    <!-- inclye javascript -->
    <?php include('layouts/layout.javascript.html')?>


</body>

</html>