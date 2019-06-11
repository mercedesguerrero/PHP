<?php
if(isset($_GET['sabor']) && isset($_GET['tipo']))
{
    $sabor = $_GET['sabor'];
    $tipo = $_GET['tipo'];
    $respuesta = Helado::ExisteHeladoPorSaborYTipo($RUTA_HELADOS, $sabor, $tipo);
    $respuestaSabor = Helado::ExisteHeladoPorSabor($RUTA_HELADOS, $sabor);
    if($respuesta)
    {
        echo "Si Hay.";
    }
    else{
        if($respuestaSabor)
        {
            echo "Hay helado con sabor ".$sabor." pero no del tipo ".$tipo.".";
        }else{
            echo "No hay helado con sabor ".$sabor." y tipo ".$tipo.".";
        }
    }
}
else
{
    echo 'Error cargue "sabor" y "tipo".';
}
?>