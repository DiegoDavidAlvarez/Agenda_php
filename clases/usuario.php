<?php
class Usuario
{
    private $conexion;
    
    // Incluye la conexion en la clase
    public function __construct($conexion) {
        $this->conexion = $conexion;
    }
    
     // Verifica si el correo electronico ya se encuentra en la base de datos y retorna true o false segun el resultado
    private function usuario_existente($email) {
        $sql = "SELECT email FROM usuario WHERE email = ?"; // Crea la consulta para buscar el email
        
        $stmt = mysqli_prepare($this->conexion, $sql); // Prepara la consulta
        
        mysqli_stmt_bind_param($stmt, "s", $email); // Remplaza los "?" por el valor de la variable enviada
        
        mysqli_stmt_execute($stmt); // Ejecuta la consulta
        
        $resultado = mysqli_stmt_get_result($stmt);
        
        if (mysqli_num_rows($resultado) > 0) { 
            return false;
        } else {
            return true; // Retorna true si el correo no existe 
        }
        
        mysqli_stmt_close($stmt);
    }
    
    // Registra un nuevo usuario con los datos de un formulario
    public function registrar_usuario($nombre, $email, $pass) {
        if ($this->usuario_existente($email)) { // Usa la funcion y si el correo no existe ejecuta el resto del codigo
            
            $hashed_pass = password_hash($pass, PASSWORD_DEFAULT); // Cifra la contraseña con el metodo hash
            
            $sql = "INSERT INTO usuario (nombre, email, pass) VALUES (?, ?, ?)"; // Crea una consulta sql para insertar datos en la bd
            
            $stmt = mysqli_prepare($this->conexion, $sql);
            
            mysqli_stmt_bind_param($stmt, "sss", $nombre, $email, $hashed_pass);
            
            if (mysqli_stmt_execute($stmt)) {
                header("Location: index.php?mensaje=Registro exitoso&resultado=success");
                exit;
            } else {
                header("Location: registrar.php?mensaje=Error al registrar el usuario&resultado=error");
                exit;
            }
            
            mysqli_stmt_close($stmt); // Cierra el stmt para evitar riesgos
            
        } else {
            header("Location: registrar.php?mensaje=El correo electronico ya esta registrado&resultado=error"); // Muestra un mensaje si el correo ya esta registrado
            exit;
        }
    }
    
    // Inicia sesion con un usuario ya existente
    public function iniciar_sesion($email, $pass) {
        $sql = "SELECT * FROM usuario WHERE email = ?"; // Crea la consulta para obtener la informacion de un usuario
        
        $stmt = mysqli_prepare($this->conexion, $sql); // Prepara la consulta
        
        mysqli_stmt_bind_param($stmt, "s", $email); // reemplaza los "?" por el correo
        
        mysqli_stmt_execute($stmt); // Ejecuta la consulta
        
        $resultado = mysqli_stmt_get_result($stmt); // Almacena los resultados de la consulta
        
        if (mysqli_num_rows($resultado) > 0) { // Comprueba si se realizo la consulta
            $usuario = mysqli_fetch_assoc($resultado); // Almacena los datos de la bd en una variable $usuario
            
            if (password_verify($pass, $usuario["pass"])) { // Verifica si la contraseña ingresada es la misma que la de la bd
                $_SESSION["usuario"] =  $usuario["nombre"]; // Crea la variable sesion "usuario con el nombre el user"
                $_SESSION["email"] =  $usuario["email"];
                $_SESSION["autenticado"] = true; // Crea la variable "autenticado" como true
                header("Location: agenda/index.php"); // Redirije a la pagina principal de la app
                exit;
            } else {
                header("Location: index.php?mensaje=Contraseña incorrecta&resultado=error");
                exit;
            }
        } else {
            header("Location: index.php?mensaje=El usuario no existe&resultado=error");
            exit;
        }
        
        mysqli_stmt_close($stmt);
    }
    
    public function eliminar_cuenta($email, $pass) {
        $sql = "SELECT * FROM usuario WHERE email = ?";
        $stmt = mysqli_prepare($this->conexion, $sql);

        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);

        $resultado = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($resultado) > 0) {
            
            $usuario = mysqli_fetch_assoc($resultado);

            if (password_verify($pass, $usuario['pass'])) {

                $sql = "DELETE FROM usuario WHERE id = ?";
                $stmt = mysqli_prepare($this->conexion, $sql);

                mysqli_stmt_bind_param($stmt, "i", $usuario["id"]);

                if (mysqli_stmt_execute($stmt)) {

                    $sql = "DELETE FROM agenda WHERE propietario = ?";
                    $stmt = mysqli_prepare($this->conexion, $sql);

                    mysqli_stmt_bind_param($stmt, "s", $_SESSION["email"]);

                    if (mysqli_stmt_execute($stmt)) {

                        header("Location: eliminar_cuenta.php?mensaje=La cuenta se elimino correctamente&resultado=success");
                        exit;
                    }
                } else {

                    header("Location: eliminar_cuenta.php?mensaje=No se puedo eliminar la cuenta&resultado=error");
                    exit;
                }
            } else {

                header("Location: eliminar_cuenta.php?mensaje=Contraseña incorrecta&resultado=error");
                exit;
            }
        } else {
            
            header("Location: eliminar_cuenta.php?mensaje=Dirección de correo incorrecta&resultado=error");
            exit;
        }
        mysqli_stmt_close($stmt);
    }
}
