<?php

parse_str(file_get_contents("php://input"), $params);

if(isset($params["id"])&&isset($params["sabor"])&&isset($params["precio"])&&isset($params["tipo"])&&isset($params["cantidadKg"]))
{
    $id = $params['id'];
    $sabor=$params['sabor'];
    $tipo=$params['tipo'];
    $precio=$params['precio'];
    $cantidadKg=$params['cantidadKg'];

    $helado=new Helado($id, $sabor, $precio, $tipo, $cantidadKg);

    if(Helado::ModificarHeladoPorId($RUTA_HELADOS, $id, $helado))
    {
        echo"<br/>Exito.";
    }else{
        echo"<br/>Falló al intentar modificar el helado.";
    }
}
?>