<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registro de Palabras en Inglés</title>
    <!-- css bootstrap 533 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- bootstrap icons 1.11.3 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        .custom-margin {
            margin-top: 60px;
            /* Ajusta este valor según lo necesites */
        }
    </style>

</head>

<body>
    <div class="container d-flex flex-column min-vh-100">
        <!-- Contenido principal -->
        <main class="py-4 flex-fill">
            <h1>ENDB</h1>
            <p class="lead">Accede con tu cuenta para comenzar a registrar las palabras inglesas que conoces y aprender más.</p>

            <?php
            session_start();
            if (isset($_SESSION['mensaje'])) {
                echo '<div class="alert alert-success" role="alert">';
                echo "<p>" . $_SESSION['mensaje'] . "</p>";
                echo '</div>';
                unset($_SESSION['mensaje']); // Eliminar el mensaje después de mostrarlo
            }
            ?>
            
            <!-- Formularios de inicio de sesión/registro -->
            <div class="row custom-margin"> <!-- Agrega aquí mt-4 para margen superior -->
                <div class="col-md-6 mt-5">
                    <h2>Iniciar Sesión</h2>
                    <form action="login.php" method="post">
                        <div class="mb-3 mt-4 col-md-8">
                            <label for="email" class="form-label">Correo Electrónico</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3 mt-4 col-md-8">
                            <label for="password" class="form-label">Contraseña</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="mb-3 mt-5">
                            <button type="submit" class="btn btn-primary">Iniciar Sesión</button>
                        </div>  
                    </form>
                </div>
                <div class="col-md-6 mt-4"> <!-- Agrega aquí mt-4 para margen superior -->
                    <h2>Registrarse</h2>
                    <form action="../controladores/registro.php" method="post">
                        <div class="mb-3 mt-5">
                            <label for="nombre" class="form-label">Nombre de Usuario</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" required>
                        </div>
                        <div class="mb-3 mt-5">
                            <label for="email" class="form-label">Correo Electrónico</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3 mt-5">
                            <label for="password" class="form-label">Contraseña</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="mb-3 mt-5">
                            <button type="submit" class="btn btn-success">Registrarse</button>
                        </div>  
                    </form>
                </div>
            </div>
        </main>


        <footer class="footer mt-auto py-3 bg-light">
            <div class="container">
                <span class="text-muted">© 2024 Juan Antonio Rodríguez - Proyecto de Registro de Palabras en
                    Inglés</span>
            </div>
        </footer>
    </div>
</body>


</html>