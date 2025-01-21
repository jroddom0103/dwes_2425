<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
  <div class="container">
    <a class="navbar-brand" href="https://educacionadistancia.juntadeandalucia.es/centros/cadiz/pluginfile.php/373433/mod_assign/introattachment/0/index.php">Noticias</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item <?= ($archivo_actual == "index.php")? 'active':null ?> ">
          <a class="nav-link" href="http://localhost/dwes/tema-07/actividades/Actividad7.1/paginas/home.php">Home</a>
        </li>
        <li class="nav-item <?= ($archivo_actual == "about.php")? 'active':null ?>">
          <a class="nav-link" href="http://localhost/dwes/tema-07/actividades/Actividad7.1/paginas/about.php">About
          </a>
        </li>
        <li class="nav-item <?= ($archivo_actual == "services.php")? 'active':null ?>">
          <a class="nav-link" href="http://localhost/dwes/tema-07/actividades/Actividad7.1/paginas/services.php">Services
          </a>
        </li>
        <li class="nav-item <?= ($archivo_actual == "events.php")? 'active':null ?>">
          <a class="nav-link" href="http://localhost/dwes/tema-07/actividades/Actividad7.1/paginas/events.php">Events
          </a>
          <li class="nav-item <?= ($archivo_actual == "close.php")? 'active':null ?>">
          <a class="nav-link" href="http://localhost/dwes/tema-07/actividades/Actividad7.1/paginas/close.php">Close
          </a>
        </li>
      </ul>
    </div>
  </div>
</nav>