<?php
if(isset($_GET['tipo']))
{
    $tipo = $_GET['tipo'];

    $heladosPorTipo = Helado::TraerHeladoPorTipo($RUTA_HELADOS, $tipo);

    if($heladosPorTipo != null)
    {
        echo Helado::HeladosATabla($heladosPorTipo, $RUTA_CARPETA_IMAGENES);
    }
    else
        echo "No existe ".$tipo;
    }
else
{
    echo 'Error cargue "mostrar" y elija un "tipo".';
}
?>