<?php
class ControladorEstadoCivil
{
    //Mostrar usuarios
    static public function ctrMostrarEstadosCiviles($item, $valor)
    {
        $tabla     = "estados_civiles";
        $respuesta = ModeloEstadoCivil::mdlMostrarEstadosCiviles($tabla, $item, $valor);
     
        return $respuesta;
    }


    //Agregar usuario
    public function ctrAgregarEstadoCivil()
    {
        if (isset($_POST["nombre_estado_civil"]))
        {

            $tabla = "estados_civiles"; //nombre de la tabla
            $datos = array(

            "nombre_estado_civil" => $_POST["nombre_estado_civil"],
          
    
            );
            //print_r($datos);
    
            //return;

            $url = ControladorPlantilla::url();

            $respuesta = ModeloEstadoCivil::mdlAgregarEstadoCivil($tabla, $datos);

            if ($respuesta == "ok")
            {
                echo '<script>
                Swal.fire({
                    title: "Estado Civil agregada exitosamente",
                    icon: "success",
                    confirmButtonColor: "#3085d6",
                    confirmButtonText: "Aceptar"
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location = "estadocivil";
                    }
                });
            </script>';
            }
        }
    }

    //Editar usuario

    public function ctrEditarEstadoCivil()
    {
        if (isset($_POST["id_estado_civil"]))
        {
            $tabla = "estados_civiles";
            $datos = array(
                "id_estado_civil" => $_POST["id_estado_civil"],
                "nombre_estado_civil" => $_POST["nombre_estado_civil"]
                
            
                // Suponiendo que se permite editar la fecha de creación
            );
        

            $respuesta = ModeloEstadoCivil::mdlEditarEstadoCivil($tabla, $datos);

            if ($respuesta == "ok") {
                echo '<script>
                Swal.fire({
                    title: "Estado civil actualizado correctamente",
                    icon: "success",
                    confirmButtonColor: "#3085d6",
                    confirmButtonText: "Aceptar"
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location = "estadocivil";
                    }
                });
            </script>';
            } else {
                echo '<script>
                    alert("Error al editar el estado civil. Detalles del error: ' . json_encode($respuesta) . '");
                    window.location = "estadocivil";
                </script>';
            }
        }
    }
    /*=============================================
    ELIMINAR
    =============================================*/
    static public function ctrEliminarEstadoCivil()
    {
        
        $url = ControladorPlantilla::url() . "estadocivil";

        if(isset($_GET["id_estado_civil"]))
        {
            $dato = $_GET["id_estado_civil"];
            $respuesta = ModeloEstadoCivil::mdlEliminarEstadoCivil($dato);

            if ($respuesta == "ok")
            {
                echo '<script> 
                fncSweetAlert("success", "El estado civil se eliminó correctamente", "' . $url . '");
                setTimeout(function() {
                    window.location.href = "estadocivil";
                }, 2000); // Redirige después de 2000 milisegundos (2 segundos), ajusta según sea necesario
            </script>';

            }
            else
            {
                echo '<script>
                console.log("Error al eliminar estado civil con ID: ' . $dato . '");
                </script>';
            }
        }

    }



}
?>