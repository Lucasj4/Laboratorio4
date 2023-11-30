<?php
class ControladorCategorias
{
    //Mostrar usuarios
    static public function ctrMostrarCategorias($item, $valor)
    {
        $tabla     = "categorias";
        $respuesta = ModeloCategorias::mdlMostrarCategorias($tabla, $item, $valor);
        return $respuesta;
    }


    //Agregar usuario
    public function ctrAgregarCategoria()
    {
        if (isset($_POST["nombre_categoria"]))
        {

            $tabla = "categorias"; //nombre de la tabla
            $datos = array(

            "nombre_categoria" => $_POST["nombre_categoria"],
            "descripcion_categoria" => $_POST["descripcion_categoria"]
    
            );
            //print_r($datos);
    
            //return;

            $url = ControladorPlantilla::url();

            $respuesta = ModeloCategorias::mdlAgregarCategoria($tabla, $datos);

            if ($respuesta == "ok")
            {
                echo '<script>
                Swal.fire({
                    title: "Categoria agregada exitosamente",
                    icon: "success",
                    confirmButtonColor: "#3085d6",
                    confirmButtonText: "Aceptar"
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location = "categorias";
                    }
                });
            </script>';
            }
        }
    }

    //Editar usuario

    public function ctrEditarCategoria()
    {
        if (isset($_POST["id_categoria"]))
        {
            $tabla = "categorias";
            $datos = array(
                "id_categoria" => $_POST["id_categoria"],
                "nombre_categoria" => $_POST["nombre_categoria"],
                "descripcion_categoria" => $_POST["descripcion_categoria"],
            
                // Suponiendo que se permite editar la fecha de creación
            );
            var_dump($datos);

            $respuesta = ModeloCategorias::mdlEditarCategoria($tabla, $datos);

            if ($respuesta == "ok")
            {
                echo '<script>
                alert("Categoria actualizado correctamente");
                window.location = "categorias";
                </script>';
            }
            else
            {
                echo "Error al editar el producto";
            }
        }
    }
    /*=============================================
    ELIMINAR
    =============================================*/
    static public function ctrEliminarCategoria()
    {
        
        $url = ControladorPlantilla::url() . "categorias";

        if(isset($_GET["id_categoria"]))
        {
            $dato = $_GET["id_categoria"];
            $respuesta = ModeloCategorias::mdlEliminarCategoria($dato);

            if ($respuesta == "ok")
            {
                echo '<script> 
                fncSweetAlert("success", "La categoria se eliminó correctamente", "' . $url . '");
                </script>';

            }
            
        }

    }



}
?>