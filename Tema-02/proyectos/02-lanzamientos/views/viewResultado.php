<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>2.2 Cálculo de lanzamiento de proyectiles</title>
    <!-- css bootstrap 533 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- bootstrap icons 1.11.3 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

</head>

<body>
    <!-- capa principal  -->
    <div class="container">

        <!-- cabecera documento -->
        <header class="pb-3 mb-4 border-bottom">
            <i class="bi bi-calculator"></i>
            <span class="fs-6">Proyecto 2.2 - Cálculo de lanzamiento de proyectiles</span>
        </header>

        <!-- Formulario -->
        <legend>Resultado</legend>

        <!-- Fin del formulario -->
        <form>

            <!-- Valor 1 -->
            <div class="input-group mb-3">
                <table class="table table-bordered">
                    <tr>Valores Iniciales:</tr>
                    <tr>
                        <td><span class="input-group-text" id="inputGroup-sizing-default">Velocidad Inicial</span></td>
                        <td><?= $velocidad ?></td>
                    </tr>
                    <tr>
                        <td><span class="input-group-text" id="inputGroup-sizing-default">Ángulo en Grados</span></td>
                        <td><?= $angulo ?></td>
                    </tr>
                    <tr>Resultados:</tr>
                    <tr>
                        <td><span class="input-group-text" id="inputGroup-sizing-lg"><?= $operacion ?></span></td>
                        <td><?= $radianes ?></td>
                    </tr>
                    <tr>
                        <td><span class="input-group-text" id="inputGroup-sizing-lg"><?= $operacion2 ?></span></td>
                        <td><?= $velocidadX ?></td>
                    </tr>
                    <tr>
                        <td><span class="input-group-text" id="inputGroup-sizing-lg"><?= $operacion3 ?></span></td>
                        <td><?= $velocidadY ?></td>
                    </tr>
                    <tr>
                        <td><span class="input-group-text" id="inputGroup-sizing-lg"><?= $operacion4 ?></span></td>
                        <td><?= $alcanceMaximo ?></td>
                    </tr>
                    <tr>
                        <td><span class="input-group-text" id="inputGroup-sizing-lg"><?= $operacion5 ?></span></td>
                        <td><?= $tiempoVuelo ?></td>
                    </tr>
                    <tr>
                        <td><span class="input-group-text" id="inputGroup-sizing-lg"><?= $operacion6 ?></span></td>
                        <td><?= $alturaMaxima ?></td>
                    </tr>

                </table>
            </div>

            <!-- botones de acción -->
            <div class="btn-group" role="group">
                <a class="btn btn-primary" href="index.php" role="button">Volver</a>
            </div>

        </form>

        <!-- Pie del documento -->
        <footer class="footer mt-auto py-3 fixed-bottom bg-light">
            <div class="container">
                <span class="text-muted">© 2024
                    Juan Antonio Rodríguez - DWES - 2º DAW - Curso 24/25
                </span>
            </div>

        </footer>

    </div>
    <!-- javascript bootstrap 533 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>