<?php



class ControladorTipoUsuario 
{
    public function ctrAgregarTipoUsuario()
    {
        if (isset($_POST["nombre_usuario"]))
        {
            $datos = array(
                "nombre" => $_POST["tipo_usuario"],
            );

            $tabla = "tiposusuario"; // nombre de la tabla

            $url = ControladorPlantilla::url();

            $respuesta = ModeloTipoUsuario::mdlAgregarTipoUsuario($tabla, $datos);

            if ($respuesta == "ok")
            {
                echo '<script>
                    window.location = "usuarios";
                    </script>';
            }
        }
    }
}
