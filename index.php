<!-- Login -->
<?php
require_once "clases/usuario.php";
require_once "conexion.php";
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = mysqli_real_escape_string($conexion, $_POST['email']);
    $pass = $_POST['pass'];
    $usuario = new Usuario($conexion);
    $usuario->iniciar_sesion($email, $pass);
}
if (isset($_SESSION["usuario"]) && isset($_SESSION["autenticado"]) && $_SESSION["autenticado"] == true) {
    header("Location: agenda/index.php");
    exit;
}
hola
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>
    <?php if (isset($_GET["resultado"]) && $_GET["resultado"] == "success"): ?>
        <script>
            alert("<?= $_GET["mensaje"] ?>"); // Muestra un mensaje si el registro fue exitoso
            window.location.href = "index.php"; // Redirige a la misma pagina para limpiar la url
        </script>
    <?php elseif (isset($_GET["resultado"]) && $_GET["resultado"] == "error"): ?>
        <script>
            alert("<?= $_GET["mensaje"] ?>");
            window.location.href = "index.php";
        </script>
    <?php endif; ?>
    <div class="row">
        <div class="container border border-primary p-4 rounded-4 col-10 col-md-6 col-lg-5 col-xl-4 position-absolute top-50 start-50 translate-middle shadow-lg">
            <h1>Iniciar Sesión</h1>
            <hr>
            <form method="POST" class="needs-validation" novalidate>
                <div class="mb-3">
                    <label for="email" class="form-label"><i class="bi bi-envelope"></i> Correo electronico:</label>
                    <input type="email" placeholder="Escriba aqui..." class="form-control" name="email" id="email" required>
                    <div class="invalid-feedback">
                        Ingresa una dirección de correo electronico.
                    </div>
                </div>
                <div class="mb-3">
                    <label for="pass" class="form-label"><i class="bi bi-key"></i> Contraseña:</label>
                    <input type="password" placeholder="Escriba aqui..." class="form-control" name="pass" id="exampleInputPassword1" required>
                    <div class="invalid-feedback">
                        Ingresa la contraseña.
                    </div>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Ingresar</button>
                </div>
                <div class="text-center mt-3">
                    <a href="registrar.php">¿No tienes una cuenta? Registrarse</a>
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
        (() => {
            'use strict'

            const forms = document.querySelectorAll('.needs-validation')

            Array.from(forms).forEach(form => {
                form.addEventListener('submit', event => {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }

                    form.classList.add('was-validated')
                }, false)
            })
        })()
    </script>
</body>

</html>