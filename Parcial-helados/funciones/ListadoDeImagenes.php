<?php

$helados = Helado::Cargar($RUTA_HELADOS);
if($helados != null)
{
    echo Helado::HeladosATabla($helados, $RUTA_CARPETA_IMAGENES);
}
else
    echo "Error no hay helados cargadas.";

?>