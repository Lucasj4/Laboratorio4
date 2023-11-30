<?php

class ControladorClientes
{
    //Mostrar usuarios
    static public function ctrMostrarClientes($item, $valor)
    {
        $tabla     = "clientes";
        $respuesta = ModeloClientes::mdlMostrarClientes($tabla, $item, $valor);
        return $respuesta;
    }
    static public function mdlMostrarEstadosCiviles()
    {
        try
        {
            $stmt = Conexion::conectar()->prepare("SELECT * FROM estado_civil");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        catch (Exception $e)
        {
            return "Error: " . $e->getMessage();
        }
    }

    //Agregar usuario
    public function ctrAgregarCliente()
    {
        if (isset($_POST["nombre_cliente"]))
        {

            $tabla = "clientes"; //nombre de la tabla
            $datos = array(
            "nombre_cliente" => $_POST["nombre_cliente"],
            "apellido_cliente" => $_POST["apellido_cliente"],
            "email_cliente" => $_POST["email_cliente"],
            "dni_cliente" => $_POST["dni_cliente"],
            "fecha_nacimiento_cliente" => date("Y-m-d", strtotime($_POST["fecha_nacimiento_cliente"])),
            "estado_civil" => $_POST["estado_civil"],
            );
            //print_r($datos);

            //return;

            $url = ControladorPlantilla::url();

            $respuesta = ModeloClientes::mdlAgregarCliente($tabla, $datos);

            if ($respuesta == "ok")
            {
                echo '<script>
                Swal.fire({
                    title: "Cliente agregado exitosamente",
                    icon: "success",
                    confirmButtonColor: "#3085d6",
                    confirmButtonText: "Aceptar"
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location = "clientes";
                    }
                });
            </script>';
            }
        }
    }

    //Editar usuario

    public function ctrEditarCliente()
    {
        

        if (isset($_POST["id_cliente"]))
        {
            $tabla = "clientes"; //nombre de la tabla
            $datos = array(
            "id_cliente" => $_POST["id_cliente"],
            "nombre_cliente" => $_POST["nombre_cliente"],
            "apellido_cliente" => $_POST["apellido_cliente"],
            "email_cliente" => $_POST["email_cliente"],
            "dni_cliente" => $_POST["dni_cliente"],
            "estado_civil" => $_POST["estado_civil"],
            );

            $url = ControladorPlantilla::url();

            $respuesta = ModeloClientes::mdlEditarCliente($tabla, $datos);

            if ($respuesta == "ok") {
                echo '<script>
                Swal.fire({
                    title: "Cliente editado exitosamente",
                    icon: "success",
                    confirmButtonColor: "#3085d6",
                    confirmButtonText: "Aceptar"
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location = "clientes";
                    }
                });
            </script>';
            } else {
                echo "Error al editar el cliente: " . $respuesta;
            }
        }


    }

    /*=============================================
    ELIMINAR
    =============================================*/


    static public function ctrEliminarCliente()
    {
        $url = ControladorPlantilla::url() . "clientes";
    
        if(isset($_GET["id_cliente"]))
        {
            $dato = $_GET["id_cliente"];
            $respuesta = ModeloClientes::mdlEliminarCliente($dato);
    
            if ($respuesta == "ok")
            {
                echo '<script> 
                fncSweetAlert("success", "El cliente se eliminó correctamente", "' . $url . '");
                </script>';
            }
            else
            {
                echo '<script>
                console.log("Error al eliminar el cliente con ID: ' . $dato . '");
                </script>';
            }
        }
    }

    static public function ctrobtenerEdadCliente($idCliente)
    {
        try {
            $stmt = Conexion::conectar()->prepare("SELECT fecha_nacimiento_cliente FROM clientes WHERE id_cliente = :id_cliente");
            $stmt->bindParam(":id_cliente", $idCliente, PDO::PARAM_INT);
            $stmt->execute();

            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($resultado) {
                // Calcular la edad
                $fechaNacimiento = new DateTime($resultado['fecha_nacimiento_cliente']);
                $hoy = new DateTime();
                $edad = $hoy->diff($fechaNacimiento)->y;

                return $edad;
            } else {
                return "Cliente no encontrado";
            }
        } catch (PDOException $e) {
            return "Error al obtener la edad del cliente: " . $e->getMessage();
        }
    }


}