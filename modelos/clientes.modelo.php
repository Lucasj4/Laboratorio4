<?php

#require_once 'conexion.php';

class ModeloClientes
{

    static public function mdlMostrarClientes($tabla, $item = null, $valor = null)
    {
        try
        {
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla " . ($item ? "WHERE $item = :$item" : ""));
            // Enlace de parámetros si es necesario
            if ($item) {
                $stmt->bindParam(":$item", $valor, PDO::PARAM_STR);
            }
            $stmt->execute();
            return $item ? $stmt->fetch(PDO::FETCH_ASSOC) : $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        catch (Exception $e)
        {
            return "Error: " . $e->getMessage();
        }
    }


    static public function mdlAgregarCliente($tabla, $datos)
    {
        try
        {

            $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(nombre_cliente, apellido_cliente, email_cliente, dni_cliente, fecha_nacimiento_cliente, estado_civil) VALUES (:nombre_cliente, :apellido_cliente, :email_cliente, :dni_cliente, :fecha_nacimiento_cliente, :estado_civil)");

            $stmt->bindParam(":nombre_cliente", $datos["nombre_cliente"], PDO::PARAM_STR);
            $stmt->bindParam(":apellido_cliente", $datos["apellido_cliente"], PDO::PARAM_STR);
            $stmt->bindParam(":email_cliente", $datos["email_cliente"], PDO::PARAM_STR);
            $stmt->bindParam(":dni_cliente", $datos["dni_cliente"], PDO::PARAM_INT);
            $stmt->bindParam(":fecha_nacimiento_cliente", $datos["fecha_nacimiento_cliente"], PDO::PARAM_STR);
            $stmt->bindParam(":estado_civil", $datos["estado_civil"], PDO::PARAM_STR);


            if(!preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $datos["nombre_cliente"])) {
                echo '<script>
                    alert("El nombre debe contener solo letras y espacios.");
                    </script>';
                return; 
            }

            if(!preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $datos["apellido_cliente"])) {
                echo '<script>
                    alert("El apellido debe contener solo letras y espacios.");
                    </script>';
                return; 
            }

            if(!preg_match('/^[0-9]+$/', $datos["dni_cliente"])) {
                echo '<script>
                    alert("El DNI debe contener solo numeros.");
                    </script>';
                return; 
            }


            if(!preg_match('/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/', $datos["email_cliente"])) {
                echo '<script>
                    alert("El email tiene un formato incorrecto.");
                    </script>';
                return; 
            }

            $stmtEmail = Conexion::conectar()->prepare("SELECT COUNT(*) as total FROM $tabla WHERE email_cliente = :email_cliente");
            $stmtEmail->bindParam(":email_cliente", $datos["email_cliente"], PDO::PARAM_STR);
            $stmtEmail->execute();
            $resultadoEmail = $stmtEmail->fetch(PDO::FETCH_ASSOC);
    
            if ($resultadoEmail['total'] > 0) {
                echo '<script>
                    alert("Ya existe un usuario con el mismo correo electrónico.");
                    </script>';
                return;
            }

            $stmtEmail = Conexion::conectar()->prepare("SELECT COUNT(*) as total FROM $tabla WHERE dni_cliente = :dni_cliente");
            $stmtEmail->bindParam(":dni_cliente", $datos["dni_cliente"], PDO::PARAM_STR);
            $stmtEmail->execute();
            $resultadoDni = $stmtEmail->fetch(PDO::FETCH_ASSOC);
    
            if ($resultadoDni['total'] > 0) {
                echo '<script>
                    alert("Ya existe un cliente con el mismo DNI.");
                    </script>';
                return;
            }

            // if(!preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $datos["estado_civil"])) {
            //     echo '<script>
            //         alert("El estado civil debe contener solo letras.");
            //         </script>';
            //     return; 
            // }


            if ($stmt->execute())
            {
                return "ok";
            }
            else
            {
                return "error";
            }
        }
        catch (PDOException $e)
        {
            return "Error: " . $e->getMessage();
        }
    }

    static public function mdlEditarCliente($tabla, $datos)
    {
        try
        {
            $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET id_cliente = :id_cliente, nombre_cliente = :nombre_cliente, apellido_cliente = :apellido_cliente, email_cliente = :email_cliente, dni_cliente = :dni_cliente, estado_civil= :estado_civil WHERE id_cliente = :id_cliente");
            
            $stmt->bindParam(":id_cliente", $datos["id_cliente"], PDO::PARAM_INT);
            $stmt->bindParam(":nombre_cliente", $datos["nombre_cliente"], PDO::PARAM_STR);
            $stmt->bindParam(":apellido_cliente", $datos["apellido_cliente"], PDO::PARAM_STR);
            $stmt->bindParam(":email_cliente", $datos["email_cliente"], PDO::PARAM_STR);
            $stmt->bindParam(":dni_cliente", $datos["dni_cliente"], PDO::PARAM_INT);
         
            $stmt->bindParam(":estado_civil", $datos["estado_civil"], PDO::PARAM_STR);

            if(!preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $datos["nombre_cliente"])) {
                echo '<script>
                    alert("El nombre debe contener solo letras y espacios.");
                    </script>';
                return; 
            }

            if(!preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $datos["apellido_cliente"])) {
                echo '<script>
                    alert("El apellido debe contener solo letras y espacios.");
                    </script>';
                return; 
            }

            if(!preg_match('/^[0-9]+$/', $datos["dni_cliente"])) {
                echo '<script>
                    alert("El DNI debe contener solo numeros.");
                    </script>';
                return; 
            }


            if(!preg_match('/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/', $datos["email_cliente"])) {
                echo '<script>
                    alert("El email tiene un formato incorrecto.");
                    </script>';
                return; 
            }

            // if(!preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $datos["estado_civil"])) {
            //     echo '<script>
            //         alert("El estado civil debe contener solo letras.");
            //         </script>';
            //     return; 
            // }

            if ($stmt->execute())
            {
                return "ok";
            }
            else
            {
                return print_r(Conexion::conectar()->errorInfo());
            }
        }
        catch (PDOException $e)
        {
            return "Error: " . $e->getMessage();
        }

        return print_r($stmt->errorInfo());
    }
    /*=============================================
    ELIMINAR DATO
    =============================================*/
    static public function mdlEliminarCliente($idCliente)
    {
        try
        {
            $stmt = Conexion::conectar()->prepare("DELETE FROM clientes WHERE id_cliente = :id_cliente");
            $stmt->bindParam(":id_cliente", $idCliente, PDO::PARAM_INT);
            if ($stmt->execute())
            {
                return "ok";
            }
            else
            {
                return "error";
            }
        }
        catch (Exception $e)
        {
            return "Error: " . $e->getMessage();
        }
    }
}