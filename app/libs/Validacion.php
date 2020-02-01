<?php
//Aqui pondremos las funciones de validación de los campos

class Validacion{

    protected $_atributos;
    protected $_error;
    public $mensaje;
    
    public function rules($rule = array(),$data)
    {
        
        if(!is_array($rule)){
            $this->mensaje = "las reglas deben de estar en formato de arreglo";
            return $this;
        }
        foreach($rule as $key => $rules){
            $reglas = explode(',',$rules['regla']);
            if(array_key_exists($rules['name'],$data)){
                foreach($data as $indice => $valor){
                    if($indice === $rules['name']){
                        foreach($reglas as $clave => $valores){
                            $validator = $this->_getInflectedName($valores);
                            if(!is_callable(array($this, $validator))){
                                throw new BadMethodCallException("No se encontro el metodo actual");
                            }
                            $boolean = $this->$validator($rules['name'], $valor);
                            if(!$boolean)
                                $respuesta = $boolean;
                        }
                        break;
                    }
                }
            }
            else{
                $this->mensaje[$rules['name']] = "el campo $valor no esta dentro de la regla de validación o en el formulario";
            }
        }
        if(!$respuesta){
            return $this;
        }
        else{
            return true;
        }
    }
    
    //Por medio de este metodo llamamos a las reglas de validacion que se generen
    private function _getInflectedName($text)
    {
        $_validator = preg_replace('/[^A-Za-z0-9]+/',' ',$text);
        $arrayValidator = explode(' ',$_validator);
        if(count($arrayValidator) > 1){
            foreach($arrayValidator as $key => $value){
                if($key == 0){
                    $validator .= "_".$value;
                }
                else{
                    $validator .= ucwords($value);
                }
            }
        }
        else{
            $validator = "_".$_validator;
        }
        return $validator;
    }
    
    protected function _noEmpty($campo,$valor)
    {
        if(isset($valor) && !empty($valor)){
            return true;
        }
        else{
            $this->mensaje[$campo][] = "el campo $campo debe de estar lleno";
            return false;
        }
    }

    protected function _numeric($campo,$valor)
    {
        if(is_numeric($valor)){
            return true;
        }
        else{
            $this->mensaje[$campo][] = "el campo $campo debe de ser numerico";
            return false;
        }
    }
    

    protected function _email($campo,$valor)
    {
        if(preg_match("/^[a-z]+([\.]?[a-z0-9_-]+)*@[a-z]+([\.-]+[a-z0-9]+)*\.[a-z]{2,}$/",$valor)){
            if(explode('@', $valor)[1]!='iesabastos.org'){
                return false;
            }
            else return true;
        }
        else{
            $this->mensaje[$campo][] = "el campo $campo de estar en el formato de email usuario@servidor.com";
            return false;
        }
    }

public function recoge($var)
{
    if (isset($_REQUEST[$var]))
        $tmp=strip_tags($this->sinEspacios($_REQUEST[$var]));
        else
            $tmp= "";
            
            return $tmp;
}

public function sinEspacios($frase) {
    $texto = trim(preg_replace('/ +/', ' ', $frase));
    return $texto;
}

function campoImagen($nombre, $dir, &$errores, $extensionesValidas, $usuario){
    if ($_FILES[$nombre]['error'] != 0) {
        switch ($_FILES[$nombre]['error']) {
            case 1:
                $errores[$nombre] = "File is too heavy";
                break;
            case 2:
                $errores[$nombre] = 'File size is too big';
                break;
            case 3:
                $errores[$nombre] = 'File could not be uploaded';
                break;
            case 4:
                $errores[$nombre] = 'File could not be uploaded';
                break;
            case 6:
                $errores[$nombre] = "Image folder is not created";
                break;
            case 7:
                $errores[$nombre] = "File could not be uploaded";
                break;
            default:
                $errores[$nombre] = 'Unknow error';
        }
        return 0;
    } else {

        $nombreArchivo = $_FILES[$nombre]['name'];
        $directorioTemp = $_FILES[$nombre]['tmp_name'];
        $extension = $_FILES['imagen']['type'];
        if (! in_array($extension, $extensionesValidas)) {
            $errores[$nombre] = "File extension is not alloweb. Use png/ jpg/ gif<br>";
            return 0;
        }

        if (! isset($errores[$nombre])) {
            $nombreArchivo = $dir . $usuario;

            if (is_dir($dir))
                if (move_uploaded_file($directorioTemp, $nombreArchivo)) {
                    return $nombreArchivo;
                } else {
                    $errores[$nombre] = "Error: File could not be moved to its destiny";
                    return 0;
                }
            else
                $errores[] = "Error: File could not be moved to its destiny";
        }
    }
}

}
?>

