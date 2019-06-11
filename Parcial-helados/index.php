<?php
require_once 'clases/Helado.php';
require_once 'clases/Venta.php';

//constantes de archivos
$RUTA_HELADOS="./archivos/Helados.txt";
$RUTA_VENTAS="./archivos/Ventas.txt";
$RUTA_CARPETA_IMAGENES = "./imagenes/";
$RUTA_CARPETA_IMAGENES_VENTAS = "./imagenes/ventas/";
$RUTA_CARPETA_IMAGENES_BACKUP = "./backUpFotos/";

$_PUT=array();
$_DELETE=array();
$content= file_get_contents("php://input");

$caso = $_SERVER['REQUEST_METHOD'];
echo $caso . "<br>";
switch ($caso) 
{
  case "GET":
        switch (key($_GET)) {
            case 'listadodeimagenes'://GET funciona ok
                include "funciones/ListadoDeImagenes.php";
                break;
            case 'listadofiltradoporsabor'://GET
                include "funciones/ListadoFiltradoPorSabor.php";
                break;
            case 'listadofiltradoportipo'://GET funciona ok
                include "funciones/ListadoFiltradoPorTipo.php";
                break;
            case 'consultarhelado'://GET funciona ok
                include "funciones/ConsultarHelado.php";
                break;
        }
        break; 
    case "POST":
        switch (key($_POST)) {
            case 'heladocarga'://POST funciona ok
                include "funciones/HeladoCarga.php";
                break;
            case 'heladocargaconfoto'://POST funciona ok
                include "funciones/HeladoCargaConFoto.php";
                break;    
            case 'consultarhelado'://GET funciona ok
                include "funciones/ConsultarHelado.php";
                break;
            case 'altaventa'://POST funciona ok
                include "funciones/AltaVenta.php";
                break;
            case 'altaventaconimagen'://POST funciona ok
                include "funciones/AltaVentaConImagen.php";
                break;
        }
        break;
    case 'PUT'://PUT funciona Ok
        parse_str($content, $_PUT);
        include "funciones/ModificarHelado.php";
        break;
    case 'DELETE'://DELETE graba mal :(
        parse_str($content, $_DELETE);
        include "funciones/BorrarHelado.php";
        break;
}     

?>