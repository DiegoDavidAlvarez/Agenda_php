<?php
class Agenda{
    public $conexion;

    //Metodo constructor
    public function __construct($conexion)
    {
        $this->conexion = $conexion;
    }

    //Metodo para insertar los datos
    public function insertarAgenda($titulo , $descripcion , $fecha_creacion , $propietario, $nombre_propietario, $estado){
       $sql = "INSERT INTO agenda(titulo , descripcion , fecha_creacion , propietario, nombre_propietario, estado) VALUES(?,?,?,?,?,?)";

       $stmt = mysqli_prepare($this->conexion , $sql);
       mysqli_stmt_bind_param($stmt , 'ssssss', $titulo , $descripcion , $fecha_creacion, $propietario, $nombre_propietario, $estado);

       if (mysqli_stmt_execute($stmt)) {
         echo "Agenda insertada correctamente";
       }else {
        echo " error al insertar los datos";
       }
       mysqli_stmt_close($stmt);
    }

    public function editarAgenda($id, $titulo, $descripcion, $estado) {
        // Consulta SQL para actualizar los datos
        $sql = "UPDATE agenda SET titulo = ?, descripcion = ?, estado = ? WHERE id = ?";
        
        // Preparar la consulta
        $stmt = mysqli_prepare($this->conexion, $sql);
        
        // Vincular los parámetros a la consulta
        mysqli_stmt_bind_param($stmt, 'sssi', $titulo, $descripcion, $estado, $id);
        
        // Ejecutar la consulta y verificar el resultado
        if (mysqli_stmt_execute($stmt)) {
            echo "Agenda actualizada correctamente";
        } else {
            echo "Error al actualizar la agenda: " . mysqli_error($this->conexion);
        }
        
        // Cerrar la consulta preparada
        mysqli_stmt_close($stmt);
    }
    //Metodo para eliminar
   // Método para eliminar
    function eliminarAgenda($id) {
        $sql = "DELETE FROM agenda WHERE id = ?";
        $stmt = mysqli_prepare($this->conexion, $sql);
        mysqli_stmt_bind_param($stmt, "i", $id); // Vincula solo el ID como entero

        if (mysqli_stmt_execute($stmt)) {
            echo "Registro eliminado correctamente.";
        } else {
            echo "Error al eliminar el registro: " . mysqli_error($this->conexion);
        }
        mysqli_stmt_close($stmt);
    }

    
}