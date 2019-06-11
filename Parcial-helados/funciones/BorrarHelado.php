<?php
//Funciona con "x-www-form-urlencoded"

parse_str(file_get_contents("php://input"), $params);
//var_dump($params);
if(isset($params["id"]))
{
    $id = $params['id'];

    $helado = Helado::TraerHeladoPorId($RUTA_HELADOS, $id);
    if($helado != null){

        if($helado->MoverImagenABackUp($RUTA_CARPETA_IMAGENES_BACKUP, $RUTA_CARPETA_IMAGENES, $RUTA_HELADOS))
        {
            if($helado->BorrarHelado($RUTA_HELADOS)!=null)
            {
                echo "La imagen se pudo subir correctamente al Backup y borrar el item.";
            }
            else{
                echo "echo No se pudo borrar el id.";
            }
                
        }
        else{
            echo "No se pudo hacer el backUp de la imagen.";
        }
    }else{
        echo "No existe ".$id;
    }
}
else
{
    echo 'Error cargue "id".';
}
?>