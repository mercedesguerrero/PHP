<?php

if(isset($_GET['sabor']))
{
    $sabor = $_GET['sabor'];

    $heladosPorSabor = Helado::TraerHeladoPorSabor($RUTA_HELADOS, $sabor);

    if($heladosPorSabor != null)
    {
        echo Helado::HeladosATabla($heladosPorSabor, $RUTA_CARPETA_IMAGENES);
    }
    else
        echo "No existe ".$sabor;
    }
else
{
    echo 'Error cargue un "sabor".';
}

/*
if(isset($_GET['mostrar'])&&isset($_GET['tipo'])||isset($_GET['sabor']))
{
    $tipo = $_GET['tipo'];
    $sabor = $_GET['sabor'];
    $mostrar = $_GET['mostrar'];

    $heladosPorSabor = Helado::TraerHeladoPorsabor($RUTA_HELADOS, $sabor);
    $heladosPorTipo = Helado::TraerHeladoPorTipo($RUTA_HELADOS, $tipo);

    if($heladosPorSabor != null)
    {
        switch ($mostrar)
        {
            case 'sabor':
                echo Helado::HeladosATabla($heladosPorSabor, $RUTA_CARPETA_IMAGENES);
                break;
            case 'tipo':
                echo PizHeladoza::HeladosATabla($heladosPorTipo, $RUTA_CARPETA_IMAGENES);
                break;
            default:
                break;
        }
    }
    else
        echo "No existe ".$sabor;
}
else
{
    echo 'Error cargue "sabor" o "tipo".';
}*/
?>