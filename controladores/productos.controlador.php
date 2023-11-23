<?php

class ControladorProductos
{
    // Mostrar productos
    static public function ctrMostrarProductos($item, $valor)
    {
        $tabla = "productos";
        $respuesta = ModeloProductos::mdlMostrarProductos($tabla, $item, $valor);
        return $respuesta;
    }

    // Agregar producto
    public function ctrAgregarProducto()
    {
        var_dump($_POST);
        if (isset($_POST["nombre_producto"]))
        {
           
            $tabla = "productos";
            $datos = array(
                "nombre_producto" => $_POST["nombre_producto"],
                "id_categoria" => $_POST["id_categoria"],
                "precio_producto" => $_POST["precio_producto"],
                "imagen_producto" => $_POST["imagen_producto"], // Asumiendo que es un ID o un indicador de imagen
                "estado_producto" => $_POST["estado_producto"],
                "stock_producto" => $_POST["stock_producto"],
                "fecha_creacion" => date("Y-m-d") // La fecha de creación podría ser automática
            );
      
            $url = ControladorPlantilla::url();
            $respuesta = ModeloProductos::mdlAgregarProducto($tabla, $datos);

            if ($respuesta == "ok")
            {
                echo '<script>
                alert("Producto agregado correctamente");
                window.location = "productos";
                </script>';
            }
        }
    }

    // Editar producto
    public function ctrEditarProducto()
    {
        if (isset($_POST["id_producto"]))
        {
            $tabla = "productos";
            $datos = array(
                "id_producto" => $_POST["id_producto"],
                "nombre_producto" => $_POST["nombre_producto"],
                "id_categoria" => $_POST["id_categoria"],
                "precio_producto" => $_POST["precio_producto"],
                "imagen_producto" => $_POST["imagen_producto"],
                "estado_producto" => $_POST["estado_producto"],
                "stock_producto" => $_POST["stock_producto"],
                // Suponiendo que se permite editar la fecha de creación
            );

            $respuesta = ModeloProductos::mdlEditarProducto($tabla, $datos);

            if ($respuesta == "ok")
            {
                echo '<script>
                alert("Producto actualizado correctamente");
                window.location = "productos";
                </script>';
            }
            else
            {
                echo "Error al editar el producto";
            }
        }
    }

    // Eliminar producto
    static public function ctrEliminarProducto($idProducto)
    {
        if ($idProducto)
        {
            $tabla = "productos";
            $respuesta = ModeloProductos::mdlEliminarProducto($tabla, $idProducto);

            if ($respuesta == "ok")
            {
                echo '<script>
                alert("Producto eliminado correctamente");
                window.location = "productos";
                </script>';
            }
            else
            {
                echo "Error al eliminar el producto";
            }
        }
    }
}
?>
