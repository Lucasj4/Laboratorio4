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
        
        if (isset($_POST["nombre_producto"]))
        {
           
            $tabla = "productos";
            $datos = array(
                "nombre_producto" => $_POST["nombre_producto"],
                "categoria_producto" => $_POST["categoria_producto"],
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
                Swal.fire({
                    title: "Producto agregada exitosamente",
                    icon: "success",
                    confirmButtonColor: "#3085d6",
                    confirmButtonText: "Aceptar"
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location = "productos";
                    }
                });
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
                "categoria_producto" => $_POST["categoria_producto"],
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
                Swal.fire({
                    title: "Producto editado exitosamente",
                    icon: "success",
                    confirmButtonColor: "#3085d6",
                    confirmButtonText: "Aceptar"
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location = "productos";
                    }
                });
            </script>';
            }
            else
            {
               echo' <script>
                Swal.fire({
                  icon: "error",
                  title: "Error",
                  text: "Error a editar producto",
                });
              </script>';
            }
        }
    }

    // Eliminar producto
    static public function ctrEliminarProducto()
    {
        $url = ControladorPlantilla::url() . "productos";

        if (isset($_GET["id_producto"])) {
            $idProducto = $_GET["id_producto"];
            $respuesta = ModeloProductos::mdlEliminarProducto($idProducto);

            if ($respuesta == "ok") {
                echo '<script>
                    Swal.fire({
                        title: "Éxito",
                        text: "Producto eliminado exitosamente",
                        icon: "success",
                        confirmButtonColor: "#3085d6",
                        confirmButtonText: "Aceptar"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location = "productos";
                        }
                    });
                </script>';
            } else {
                echo '<script>
                    alert("Error al eliminar el producto: ' . $respuesta . '");
                </script>';
            }
        }
    }
}
?>
