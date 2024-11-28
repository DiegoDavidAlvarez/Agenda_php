<?php
require_once "clases/usuario.php";
require_once "conexion.php";

$usuario = new Usuario($conexion);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['usuario'];
    $email = $_POST['email'];
    $password = $_POST['pass'];

    $usuario->registrar_usuario($nombre, $email, $password);
}
if (isset($_SESSION["usuario"]) && isset($_SESSION["autenticado"]) && $_SESSION["autenticado"] == true) {
    header("Location: agenda/index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Registrar Usuario</title>
</head>

<body>
    <?php if (isset($_GET["resultado"]) && $_GET["resultado"] == "error"): ?>
        <script>
            alert("<?= $_GET["mensaje"] ?>"); // Muestra un mensaje si el registro tuvo un error
            window.location.href = "registrar.php"; // Redirige a la misma pagina para limpiar la url
        </script>
    <?php endif; ?>
    <div class="row">
        <div class="container border border-primary rounded-4 p-4 col-10 col-md-6 col-lg-5 col-xl-4 position-absolute top-50 start-50 translate-middle shadow-lg">
            <h1>Registrar Usuario</h1>
            <form method="POST">
                <div class="mb-3">
                    <label for="usuario" class="form-label">Usuario</label>
                    <input type="text" placeholder="Usuario" class="form-control" name="usuario" id="usuario" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Correo electronico:</label>
                    <input type="email" placeholder="Correo electronico" class="form-control" name="email" id="email" required>
                </div>
                <div class="mb-3">
                    <label for="pass" class="form-label">Contraseña:</label>
                    <input type="password" placeholder="Contraseña" class="form-control" name="pass" required>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Registrar</button><br>

                </div>
                <div class="text-center mt-3">
                    <a href="index.php">¿Ya tienes una cuenta ? Iniciar Sesión</a>
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>