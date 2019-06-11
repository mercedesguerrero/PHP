<?php
require_once './clases/Helado.php';
class Venta
{
    public $id;
    public $email;
    public $sabor;
    public $tipo;
    public $cantidadKg;

function __construct($id, $email, $sabor, $tipo, $cantidadKg)
{
    $this->id = $id;
    $this->email = $email;
    $this->sabor = $sabor;
    $this->tipo = $tipo;
    $this->cantidadKg = $cantidadKg;
}

//funciones de GUARDAR
public function Guardar($ruta)
{
    $ventas = self::Cargar($ruta);
    if($ventas != null)
    {
        $maxId = self::TraerMayorId($ventas);
        $this->id = $maxId + 1;
        if(!self::ExisteVentaEnLista($ventas, $this))
        {
            if(file_exists($ruta))
            {
                $archivo = fopen($ruta, "a");
                return fwrite($archivo, $this->DevolverJson().PHP_EOL);
            }
            $archivo = fopen($ruta, "w");
            return fwrite($archivo, $this->DevolverJson().PHP_EOL);
        }
    }
    else
    {
        if(file_exists($ruta))
        {
            $archivo = fopen($ruta, "a");
            return fwrite($archivo, $this->DevolverJson().PHP_EOL);
        }
        $archivo = fopen($ruta, "w");
        return fwrite($archivo, $this->DevolverJson().PHP_EOL);
    }
    return false;
}

public static function GuardarTodo($ventas, $ruta)
{
    if(file_exists($ruta))
    {
        foreach ($ventas as $key => $pi)
        {
            if($key == 0)
            {
                $archivo = fopen($ruta, "w");
                fwrite($archivo, json_encode($ventas[0]).PHP_EOL);
                fclose($archivo);
            }
            else
            {
                $archivo = fopen($ruta, "a");
                fwrite($archivo, json_encode($ventas[$key]).PHP_EOL);
                fclose($archivo);
            }
        }
        return true;
    }
    return false;
}

//funcion de CARGAR
public static function Cargar($ruta)
{
    if(file_exists($ruta))
    {
        $archivo = fopen($ruta, "r");
        $ventas = array();
        while(!feof($archivo))
        {
            $linea = fgets($archivo);
            if($linea != "")
            {
                $objeto = json_decode($linea);
                if(isset($objeto)!=null)
                {
                    $venta = new Venta($objeto->id, $objeto->email, $objeto->sabor, $objeto->tipo, $objeto->cantidadKg);
                    array_push($ventas, $venta);
                }
                
            }
        }
        fclose($archivo);
        if(count($ventas) > 0)
            return $ventas;
    }
    return null;
}

private static function ExisteVentaEnLista($ventas, $venta)
{
    foreach ($ventas as $sold)
    {
        if($sold->id == $venta->id)
            return true;
    }
    return false;
}

public static function TraerVentaPorId($ruta, $id)
{
    $ventas = self::Cargar($ruta);
    if($ventas != null)
    {
        foreach ($ventas as $sold)
        {
            if($sold->id == $id)
                return $sold;
        }
    }
    return null;
}

//manejo de IMAGENES
public function CargarImagen($files, $rutaCarpetaImagenes)
{
    if(isset($files))
    {
        $extension = self::TraerExtensionImagen($files);
        if($extension != null)
        {
            date_default_timezone_set("America/Argentina/Buenos_Aires");
            $nombreDelArchivoImagen = strtolower($this->sabor)."_".date('Ymd').$extension;
            $rutaCompletaImagen = $rutaCarpetaImagenes.$nombreDelArchivoImagen;
            return move_uploaded_file($files["tmp_name"], $rutaCompletaImagen);
        }
    }
    return false;
}
//fin de manejo de IMAGENES

public function BorrarVenta($ruta)
{
    $ventas = self::Cargar($ruta);
    if($ventas != null)
    {
        if(self::VentaIsInListVentas($ventas, $this))
        {
            foreach ($ventas as $key => $sold)
            {
                if($sold->ATR1 == $this->ATR1)
                {
                    unset($ventas[$key]);
                    break;
                }
            }
            return self::GuardarTodo($ventas, $ruta);
        }
    }
    return false;
}

public static function TraerMayorId($ventas)
{
    $maxId = $ventas[0]->id;
    foreach ($ventas as $sold)
    {
        if($sold->id > $maxId)
            $maxId = $sold->id;
    }
    return $maxId;
}

public static function TraerExtensionImagen($files)
{
    switch ($files["type"])
    {
        case 'image/jpeg':
            $extension = ".jpg";
            break;
        case 'image/png':
            $extension = ".png";
            break;
        default:
            return null;
            break;
    }
    return $extension;
}

public function DevolverJson()
{
    return json_encode($this, JSON_UNESCAPED_UNICODE);
}
}
?>