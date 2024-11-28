<?php
require_once("../clases/agenda.php");
require_once ("../conexion.php");
require_once ("../auth.php");
if (isset($_GET['id'])){
    $id = $_GET['id'];
    $sql = "SELECT * FROM agenda WHERE id=$id";
    $resultado = mysqli_fetch_assoc($resultado); 
}
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $id = $_POST['id'];
    $titulo = $_POST['titulo'];
    $fecha_creacion = $_POST['fecha_creacion'];
    $descripcion = $_POST['descripcion'];
    $propietario = $_POST['propietario'];
    $estado = $_POST['estado'];

    $agenda = new Agenda($conexion,$titulo,$fecha_creacion,$descripcion,$propietario,$estado);
    $agenda->editarAgenda($id);
    header("Location: index.php");

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar</title>
</head>
<body>
    <div>
        <form method="post">
           <label >Titulo :</label><br>
           <input type="text" name="titulo" value="<?php echo $resultado['titulo'] ; ?>"><br>
           <label >Fecha de Creacion :</label><br>
           <input type="date" name="fecha_creacion" value="<?php echo $resultado['fecha_creacion'] ; ?>"  required><br>
           <label >Descripcion :</label><br>
           <textarea name="descripcion" required></textarea>
           <label >Propietario:</label><br>
           <input type="text" name="propietario" value="<?php echo $resultado['propietario'] ; ?>" required><br>
           <label >Estado:</label><br>
           <select name="estado" value="<?php echo $resultado['estado'] ; ?>">
                 <option value="Activo">Activo</option>
                 <option value="No activo">No activo</option>
                 <option value="Otros...">Otros...</option>
           </select>
           <br>
           <br>
           <button type="submit">Actualizar</button>
        </form>
    </div>
</body>
</html>