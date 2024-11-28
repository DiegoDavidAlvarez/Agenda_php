<?php
session_start();
if (!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] !== true) {
    header("Location: ../index.php");
    exit;
}
if (isset($_SESSION['ultimo_acceso']) && (time() - $_SESSION['ultimo_acceso']) > 60) {
    session_destroy();
    header("Location: ../index.php?mensaje=Su sesión a expirado&resultado=error");
    exit;
}
$_SESSION['ultimo_acceso'] = time();