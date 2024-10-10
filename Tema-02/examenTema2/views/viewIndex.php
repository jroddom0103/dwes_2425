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

    <h1>Introduce los datos:</h1>

    <form method="GET">
      <div class="row g-3 align-items-center">
        <div class="col-auto">
          <label for="inputPassword6" class="col-form-label">Radio</label>
        </div>
        <div class="col-auto">
          <input type="text" id="radio" class="form-control" aria-describedby="radio" name="radio">
        </div>
        <div class="col-auto">
          <span id="passwordHelpInline" class="form-text">
            Tiene que estar en m.
          </span>
        </div>
      </div>
      <div class="row g-3 align-items-center">
        <div class="col-auto">
          <label for="inputPassword6" class="col-form-label">Frecuencia</label>
        </div>
        <div class="col-auto">
          <input type="text" id="frecuencia" class="form-control" aria-describedby="frecuencia" name="frecuencia">
        </div>
        <div class="col-auto">
          <span id="passwordHelpInline" class="form-text">
            Debe estar en HZ.
          </span>
        </div>
      </div>
      <div class="row g-3 align-items-center">
        <div class="col-auto">
          <label for="inputPassword6" class="col-form-label">Masa</label>
        </div>
        <div class="col-auto">
          <input type="text" id="inputPassword6" class="form-control" aria-describedby="masa" name="masa">
        </div>
        <div class="col-auto">
          <span id="passwordHelpInline" class="form-text">
            Tiene que estar en kg.
          </span>
        </div>
      </div>

      <div class="btn-group" role="group">
        <button type="submit" class="btn btn-warning" formaction="calcular.php">Calcular</button>
      </div>

    </form>


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