<?php

class ControladorUsuarios
{
    //Mostrar usuarios
    static public function ctrMostrarUsuarios($item = null, $valor = null)
    {
        $tabla = "usuarios";
    
        try
        {
            // Construir la consulta SQL según si se proporcionan valores o no
            $sql = "SELECT * FROM $tabla";
            if ($item !== null && $valor !== null) {
                $sql .= " WHERE $item = :$item";
            }
    
            $stmt = Conexion::conectar()->prepare($sql);
    
            // Enlazar parámetros solo si se proporcionan valores
            if ($item !== null && $valor !== null) {
                $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);
            }
    
            $stmt->execute();
            
            // Devolver todas las filas como un array asociativo
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        catch (Exception $e)
        {
            return "Error: " . $e->getMessage();
        }
    }
    
    static public function ctrMostrarRoles()
    {
        $tabla     = "roles";
        $respuesta = ModeloUsuarios::mdlMostrarRoles($tabla);
        return $respuesta;
    }

    static public function obtenerNombreRol($idRol)
{
    $tabla = "roles";
    $respuesta = ModeloUsuarios::mdlMostrarRolPorId($tabla, $idRol);
    return $respuesta["nombre_rol"];
}

   public function ctrAgregarUsuario()
    {
        if (isset($_POST["nombre_usuario"])) {
           
            $encriptar = crypt($_POST["password_usuario"], '$1$SALT$');

            $tabla = "usuarios"; 
           
            $datos = array(
                "nombre_usuario" => $_POST["nombre_usuario"],
                "email_usuario" => $_POST["email_usuario"],
                "apellido_usuario" => $_POST["apellido_usuario"],
                "rol_usuario" => $_POST["rol_usuario"],
                "password_usuario" => $encriptar,
                "estado_usuario" => 1
            );
           

            $url = ControladorPlantilla::url();

            $respuesta = ModeloUsuarios::mdlAgregarUsuario($tabla, $datos);

            if ($respuesta == "ok") {
                echo '<script>
                    window.location = "usuarios";
                    </script>';
            }
        }
    }

    

    public function ctrEditarUsuario()
    {
        if (isset($_POST["id_usuario"])) {
            // Verificar si el campo de contraseña se dejó en blanco o no
            if ($_POST["password_usuario"] == "")
            {
                $password = ControladorUsuarios::ctrMostrarUsuarios("id_usuario", $_POST["id_usuario"]);

                $password = $password["password_usuario"];
            }
            else
            {
                $password = crypt($_POST["password_usuario"], '$1$SALT$');
            }

            $tabla = "usuarios";
            $datos = array(
                "id_usuario" => $_POST["id_usuario"],
                "nombre_usuario" => $_POST["nombre_usuario"],
                "apellido_usuario" => $_POST["apellido_usuario"],
                "email_usuario" => $_POST["email_usuario"],
                "rol_usuario" => $_POST["rol_usuario"],
                "password_usuario" => $password,
                "estado_usuario" => $_POST["estado_usuario"],
            );

            // Crear una instancia de ModeloUsuarios
            $modeloUsuarios = new ModeloUsuarios();
            
            // Llamar al método de instancia, no como método estático
            $respuesta = $modeloUsuarios->mdlEditarUsuario($tabla, $datos);

            if ($respuesta == "ok") {
                echo '<script>
                    window.location.href = "usuarios";
                </script>';
            } else {
                // Manejar el error de edición
                echo '<script>
                    alert("Error al editar el usuario. Por favor, inténtelo nuevamente.");
                </script>';
            }
        }
    }
    

   


    // Asegúrate de tener el método ctrMostrarUsuarios implementado aquí

    

    


    



    /*=============================================
ELIMINAR
=============================================*/
static public function ctrEliminarUsuario()
{
    if (isset($_GET["id_usuario"])) {
        $idUsuario = $_GET["id_usuario"];

        // Obtener información del usuario
        $usuario = ModeloUsuarios::mdlMostrarUsuarios("usuarios", "id_usuario", $idUsuario);

        // Verificar si se obtuvo la información del usuario
        if ($usuario) {
            // Verificar si el rol del usuario es "Admin"
            if ($usuario["rol_usuario"] == "Admin") {
                echo '<script>
                Swal.fire({
                    icon: "error",
                    title: "No puedes eliminar a un usuario con rol de Administrador.",
                    showConfirmButton: false,
                    timer: 1500
                });
                setTimeout(() => {
                    window.location.href = "usuarios";
                }, 1500);
            </script>';
                exit();
            }

            // Intentar eliminar al usuario
            $respuesta = ModeloUsuarios::mdlEliminarUsuario($idUsuario);

            // Verificar si se eliminó correctamente
            if ($respuesta == "ok") {
                echo '<script> 
                fncSweetAlert("success", "El usuario se eliminó correctamente", "' . $url . '");
                </script>';
                exit();
            } else {
                echo '<script>
                    alert("Error al eliminar el usuario. Por favor, inténtelo nuevamente.");
                    window.location.href = "usuarios";
                </script>';
                exit();
            }
        }
    }
}


    

    /*=============================================
 Renovar contraseña
 =============================================*/
 public function ctrRenovarPassword()
 {
     if (isset($_POST["resetPassword"]))
     {

         /*=============================================
        Validamos la sintaxis de los campos
        =============================================*/
         if (preg_match('/^[^0-9][.a-zA-Z0-9_]+([.][.a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["resetPassword"]))
         {
            /* echo "Hola"; 
            return; */
             /*=============================================
            Preguntamos primero si el usuario está registrado
            =============================================*/

             $tabla     = "usuarios";
             $item      = "email_usuario";
             $valor     = $_POST["resetPassword"];
             $respuesta = ModeloUsuarios::mdlMostrarUsuarios($tabla, $item, $valor);

             if (is_array($respuesta) && ($respuesta["email_usuario"] == $_POST["resetPassword"]))
             {
                 function genPassword($longitud)
                 {
                     $password = "";
                     $cadena   = "123456789abcdefghijklmnopqrstuvwxyz";
                     $password = substr(str_shuffle($cadena), 0, $longitud);
                     return $password;
                 }
                 $nuevoPassword = genPassword(8);

                 $password = crypt($_POST["ingresoPassword"], '$1$SALT$');
                 //Actualizar en la bd la nueva contraseña

                 $id_usuario = $respuesta["id_usuario"];

                 $respuesta2 = ModeloUsuarios::mdlRenovarPassword($password, $id_usuario);

                 if ($respuesta2 == "ok")
                 {
                     /*=============================================
                    Enviamos nueva contraseña al correo
                    electrónico
                    =============================================*/

                     $name    = $respuesta["nombre_usuario"];
                     $subject = "Renovación de password";
                     $email   = $respuesta["email_usuario"];
                     $message = "Su nuevo password es: " . $nuevoPassword;

                     $url       = ControladorPlantilla::url() . "login";
                     $sendEmail = ControladorPlantilla::sendEmail($name, $subject, $email, $message, $url);

                     if ($sendEmail == "ok")
                     {
                         echo '<script>
                             fncSweetAlert("success", "Se envió una nueva contraseña al correo electronico", "' . $url . '");
                             </script>';
                     }
                     else
                     {
                         echo '<script>
                     fncSweetAlert("error", "Hubo problemas al enviar la contraseña", "' . $url . '");
                     </script>';
                     }
                 }
             }
             else
             {
                 echo '<script>
             fncSweetAlert("error", "El email no existe en la base de datos", "");
             </script>';
             }
         }
         else
         {
             echo '<script>
         fncSweetAlert("error", "Error al escribir el email", "");
         </script>
         ';
         }
     }
 }
 

    /*=============================================
INGRESO DE USUARIO
=============================================*/
static public function ctrIngresoUsuario()
    {
        if (isset($_POST["ingresoEmail"]))
        {

            $url = ControladorPlantilla::url();

            if (preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][azA-Z0-9_]+)*[.][a-zAZ]{2,4}$/', $_POST["ingresoEmail"]))
            {
                //$encriptar = crypt($_POST["ingresoPassword"], '$2a$07$usesomesillyhrdrrererherhe$');

                $encriptar = crypt($_POST["ingresoPassword"], '$1$SALT$');

                $tabla = "usuarios";
                $item  = "email_usuario";
                $valor = $_POST["ingresoEmail"];

                $respuesta = ModeloUsuarios::mdlMostrarUsuarios($tabla, $item,
                $valor);
            

                if (is_array($respuesta) && ($respuesta["email_usuario"] ==
                $_POST["ingresoEmail"] && $respuesta["password_usuario"] == $encriptar))
                {

                    if ($respuesta["estado_usuario"] == 1)
                    {
                        $_SESSION["iniciarSesion"]  = "ok";
                        $_SESSION["id_usuario"]     = $respuesta["id_usuario"];
                        $_SESSION["nombre_usuario"] = $respuesta["nombre_usuario"];
                        $_SESSION["email_usuario"]  = $respuesta["email_usuario"];
                        $_SESSION["rol_usuario"]    = $respuesta["rol_usuario"];

                        /*=============================================
                        REGISTRAR FECHA PARA SABER EL ÚLTIMO LOGIN
                        =============================================*/

                        date_default_timezone_set('America/Argentina/Buenos_Aires');

                        $item1  = "fecha_ultimo_ingreso";
                        $valor1 = date('Y-m-d H:i:s');

                        $item2  = "id_usuario";
                        $valor2 = $respuesta["id_usuario"];

                        $ultimoLogin = ModeloUsuarios::mdlActualizarLogin($tabla, $item1, $valor1, $item2, $valor2);

                        echo '<script>
                        window.location = "usuarios";
                        </script>';

                    }
                    else
                    {
                        echo '<br>
                        <div class="alert alert-danger">El usuario aún no está activado</div>';
                    }
                }
                else
                {
                    echo '<script>
                    fncSweetAlert("error", "Error al intentar acceder, pruebe nuevamente", "' . $url . '")
                    </script>';
                }
            }
        }
    }
}