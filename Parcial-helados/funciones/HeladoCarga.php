<?php
if(isset($_POST['sabor']) && isset($_POST['precio']) && isset($_POST['tipo']) && isset($_POST['cantidadKg']))
{
    $sabor = $_POST['sabor'];
    $precio = $_POST['precio'];
    $tipo = $_POST['tipo'];
    $cantidadKg = $_POST['cantidadKg'];
    if($tipo == "crema" || $tipo == "agua")
    {
        if($sabor == "chocolate" || $sabor == "dulcedeleche" || $sabor == "frutilla")
        {
            $helado = new Helado(1, $sabor, $precio, $tipo, $cantidadKg);
            if($helado->Guardar($RUTA_HELADOS))
            {
                echo "Exito.";
            }
            else
                echo "Fallo.";
        }
        else
            echo 'Error cargue "sabor" como "chocolate", "dulcedeleche" o "frutilla".';
    }
    else
        echo 'Error cargue "tipo" como "crema" o "agua".';
}
else
    echo 'Error cargue "id", "sabor", "precio", "tipo", "cantidad" y "imagen".';
?>