<?php
include ('libs/Validacion.php');

class Controller{

    public function login(){
        try {
            $m = new Model();
            $valid = new Validacion();
            if (isset($_POST['login'])) {
                echo 'asas';
                $email = $valid->recoge("email");
                $pass = $valid->recoge("pass");
                $correcto= $m->loginComp($email,$pass);
                if($correcto[0]==$email){
                    session_start();
                    $n=explode( '.', $email );
                    $_SESSION['user']=$n[0];
                    $_SESSION['email']=$email;
                    header('Location: index.php?ctl=calendario');
                }
                else{
                    echo 'Nombre o contraseña incorrectos';
                }
            }

            if (isset($_POST['signup']) ){
                $email = $valid->recoge("email");
                $pass = $valid->recoge("pass");
                $nombre = $valid->recoge("nombre");
                $apellido = $valid->recoge("apellido");
                $errores=[];
                $extensionesValidas=['jpg','png','gif'];

                $correcto=true;
                $correcto = $this->valid->campoImagen("imagen", '\web\img', $errores, $extensionesValidas, $nombre.''.$apellido);
                $correcto=$valid->_email("email",$email);
                $correcto=$valid->_noEmpty("email",$email);
                $correcto=$valid->_noEmpty("pass",$pass);
                $correcto=$valid->_noEmpty("nombre",$nombre);
                $correcto=$valid->_noEmpty("apellido",$apellido);
                $coincide = $m->buscaUsuario($email);

                if(empty($coincide) && $correcto){
                    $pass=$this->crypt_blowfish($pass);
                    if($m->insertarUser($email,$nombre,$apellido,$pass,'/web/img/'.$nombre.''.$apellido)){
                        header('Location:index.php? ctl=login');
                    }   
                }
                else if($correcto){
                        echo 'El email ya está registrado';
                    }
            }
        } 
         catch (Exception $e) {
            error_log($e->getMessage() . microtime() . PHP_EOL, 3, "logExceptio.txt");
            header('Location: index.php?ctl=error');
        } catch (Error $e) {
            error_log($e->getMessage() . microtime() . PHP_EOL, 3, "logError.txt");
            header('Location: index.php?ctl=error');
        }
        require __DIR__ . '\vista\login.php';
    }

    function logout(){
        if (isset($_POST['logout']) ){
            session_unset();
            session_destroy();
        }
        require __DIR__ . '/vista/calendario.php';
        require __DIR__ . '/vista/admin.php';
        require __DIR__ . '/vista/reservas.php';
    }

    function crypt_blowfish($password){
        $salt = '$2a$07$encriptameesta@caradepito$';
        $pass= crypt($password, $salt);
        return $pass;
    }

    function calendario(){
        try{

        }
        catch (Exception $e) {
            error_log($e->getMessage() . microtime() . PHP_EOL, 3, "logExceptio.txt");
            header('Location: index.php?ctl=error');
        } catch (Error $e) {
            error_log($e->getMessage() . microtime() . PHP_EOL, 3, "logError.txt");
            header('Location: index.php?ctl=error');
        }
        require __DIR__ . '/vista/calendario.php';
    }

    function admin(){
        try{

        }
        catch (Exception $e) {
            error_log($e->getMessage() . microtime() . PHP_EOL, 3, "logExceptio.txt");
            header('Location: index.php?ctl=error');
        } catch (Error $e) {
            error_log($e->getMessage() . microtime() . PHP_EOL, 3, "logError.txt");
            header('Location: index.php?ctl=error');
        }
        require __DIR__ . '/vista/admin.php';
    }

    function reservas(){
        try{
            $m = new Model();
            $params= $m->reservas($_SESSION['email']);
        }
        catch (Exception $e) {
            error_log($e->getMessage() . microtime() . PHP_EOL, 3, "logExceptio.txt");
            header('Location: index.php?ctl=error');
        } catch (Error $e) {
            error_log($e->getMessage() . microtime() . PHP_EOL, 3, "logError.txt");
            header('Location: index.php?ctl=error');
        }
        require __DIR__ . '/vista/reservas.php';
    }
}

?>
