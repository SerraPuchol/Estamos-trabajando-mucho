<?php
include_once ('Config.php');

class Model extends PDO{

    protected $conexion;

    public function __construct(){  
            $this->conexion = new PDO('mysql:host=' . Config::$mvc_bd_hostname . ';dbname=' . Config::$mvc_bd_nombre . '', Config::$mvc_bd_usuario, Config::$mvc_bd_clave);
            $this->conexion->exec("set names utf8");
            $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function insertarUser($email,$nombre,$apellido,$pass,$img){
        $consulta = "insert into usuario (Mail,Nombre,Apellido,Password,Imagen,Admin,DadoAlta) values (?, ?, ?, ?, ?, ?, ?)";
            
            $result = $this->conexion->prepare($consulta);
            $result->bindParam(1, $email);
            $result->bindParam(2, $nombre);
            $result->bindParam(3, $apellido);
            $result->bindParam(4, $pass);
            $result->bindParam(5, $img);
            $result->bindParam(6, false);
            $result->bindParam(7, false);
            $result->execute();
                
            return $result;       
    }

    public function loginComp($nombre,$pass){
            $consulta = "select Mail from usuario where Mail=:nombre AND Password=:pass";
            
            $result = $this->conexion->prepare($consulta);
            $result->bindParam(':nombre', $nombre);
            $result->bindParam(':pass', $pass);
            $result->execute();
            return $result->fetch();       
    }

    public function buscaUsuario($nombre){
            $consulta = "select Mail from usuario where Mail=:nombre";
            
            $result = $this->conexion->prepare($consulta);
            $result->bindParam(':nombre', $nombre);
            $result->execute();
            return $result->fetch();       
    }

    public function rutaImagen($email){
        $consulta = "select Imagen from usuario where Mail=:nombre";
        
        $result = $this->conexion->prepare($consulta);
        $result->bindParam(':nombre', $email);
        $result->execute();
        return $result->fetch();       
    }

    public function esAdmin($email){
        $consulta = "select Admin from usuario where Mail=:nombre";
                
        $result = $this->conexion->prepare($consulta);
        $result->bindParam(':nombre', $email);
        $result->execute();
        return $result->fetch();       
    }

    public function Autorizado($email){
        $consulta = "select DadoAlta from usuario where Mail=:nombre";
        
        $result = $this->conexion->prepare($consulta);
        $result->bindParam(':nombre', $email);
        $result->execute();
        return $result->fetch();       
    }

    public function reservas($email){
        $consulta = "select IdAula,Fecha,Hora from reserva where MailProfesor=:mail";
        
        $result = $this->conexion->prepare($consulta);
        $result->bindParam(':mail', $email);
        $result->execute();
        return $result->fetch();   
    }
}
?>
