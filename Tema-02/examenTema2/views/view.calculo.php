<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Examen Práctico Tema 2</title>

    <!-- css bootstrap 533 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- bootstrap icons 1.11.3 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>
    <!-- capa principal -->
    <div class="container">

        <!-- cabecera documento -->
        <header class="pb-3 mb-4 border-bottom">
            <i class="bi bi-calculator"></i>
            <span class="fs-6">Proyecto: Movimiento Circular Uniforme</span>
        </header>

        <table class="table table-dark table-striped">
        <tr>
            <th>Radio</th>
            <th><input class="form-control" type="text" value="<?=$radio?> metros" aria-label="readonly input example" readonly></th>
        </tr>
        <tr>
            <th>Frecuencia</th>
            <th><input class="form-control" type="text" value="<?=$frecuencia?> Hz" aria-label="readonly input example" readonly></th>
        </tr>
        <tr>
            <th>Masa</th>
            <th><input class="form-control" type="text" value="<?=$masa?> kg" aria-label="readonly input example" readonly></th>
        </tr>
        <tr>
            <th>Velocidad Tangencial</th>
            <th><input class="form-control" type="text" value="<?=$velocidadT?> m/s" aria-label="readonly input example" readonly></th>
        </tr>
        <tr>
            <th>Aceleración Centrípeda</th>
            <th><input class="form-control" type="text" value="<?=$acelerC?> m/s2" aria-label="readonly input example" readonly></th>
        </tr>
        <tr>
            <th>Fuerza Centrípeda</th>
            <th><input class="form-control" type="text" value="<?=$fuerzaC?> N" aria-label="readonly input example" readonly></th>
        </tr>
        <tr>
            <th>Periodo</th>
            <th><input class="form-control" type="text" value="<?=$periodo?> s" aria-label="readonly input example" readonly></th>
        </tr>
        </table>

        <button type="submit" class="btn btn-warning" formaction="index.php">Volver</button>

        <!-- Pie del documento -->
        <footer class="footer mt-auto py-3 fixed-bottom bg-light">
            <div class="container">
                <span class="text-muted">© 2024
                    Juan Antonio Rodríguez Domínguez - DWES - 2º DAW - Curso 24/25</span>
            </div>
        </footer>

    </div>
    <!-- javascript bootstrap 533 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>