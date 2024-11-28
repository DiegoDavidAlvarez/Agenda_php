
<?php
class Agenda{
    public $titulo , $fecha_creacion , $descripcion , $propietario , $estado;
    public $conexion ;

    //Metodo constructor
    function __construct($conexion )
    {
        $this->conexion = $conexion;
    }
    //Metodo para insertar datos
    public function insertarAgenda($titulo , $fecha_creacion , $descripcion , $propietario , $estado){
        $query = "INSERT INTO agenda(titulo ,fecha_creacion ,descripcion , propietario , estado) VALUES(?,?,?,?,?)";
        $stmt = mysqli_prepare($this->conexion , $query);
        mysqli_stmt_bind_param($stmt , 'sssss' , $titulo , $fecha_creacion , $descripcion , $propietario , $estado);

        if (mysqli_stmt_execute($stmt)) {
            echo "Agenda registrada correctamente";
        }else {
            echo "Error al insertar la agenda" . mysqli_error($this->conexion);
        }
        mysqli_stmt_close($stmt);
    }

    //Metodo para editar la agenda
    public function editarAgenda($id){
        $sql= "UPDATE agenda SET titulo = ? , fecha_creacion = ? , descripcion = ? , propietario = ? , estado = ? WHERE id=?";
        $stmt = mysqli_prepare($this->conexion , $sql);
        mysqli_stmt_bind_param($stmt  , 'sssss' , $this->titulo , $this->fecha_creacion , $this->descripcion , $this->propietario , $this->estado);
        if (mysqli_stmt_execute($stmt)) {
            echo "Datos actualizados correctamente";
        }else {
            echo "Error al actualizar los datos".mysqli_error($this->conexion);
        }
        mysqli_stmt_close($stmt);
    }
    //Metodo para eliminar la agenda
    public function eliminarAgenda($id){
      $sql= "DELETE FROM agenda WHERE id = ?";
      $stmt = mysqli_prepare($this->conexion , $sql);
      mysqli_stmt_bind_param($stmt , 'i',$id);
      if(mysqli_stmt_execute($stmt)){
         echo "Agenda eliminada con exito";
      }else {
        echo "Error al eliminar la agenda".mysqli_error($this->conexion);
      }
      mysqli_stmt_close($stmt);
    }
}
?>