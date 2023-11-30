<?php

#require_once 'conexion.php';

class ModeloEstadoCivil
{

    static public function mdlMostrarEstadosCiviles($tabla, $item = null, $valor = null)
    {
        try
        {
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla " . ($item ? "WHERE $item = :$item" : ""));
            // Enlace de parámetros si es necesario
            if ($item) {
                $stmt->bindParam(":$item", $valor, PDO::PARAM_STR);
            }
            $stmt->execute();
    
            // Utilizar fetch para obtener solo un registro
            return $item ? $stmt->fetch(PDO::FETCH_ASSOC) : $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        catch (Exception $e)
        {
            return "Error: " . $e->getMessage();
        }
    }


    static public function mdlAgregarEstadoCivil($tabla, $datos)
    {
        try
        {   
            if(!preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $datos["nombre_estado_civil"])) {
                echo '<script>
                    alert("El nombre debe contener solo letras y espacios.");
                    </script>';
                return; 
            }
            $stmtEmail = Conexion::conectar()->prepare("SELECT COUNT(*) as total FROM $tabla WHERE nombre_estado_civil = :nombre_estado_civil");
            $stmtEmail->bindParam(":nombre_estado_civil", $datos["nombre_estado_civil"], PDO::PARAM_STR);
            $stmtEmail->execute();
            $resultadoEmail = $stmtEmail->fetch(PDO::FETCH_ASSOC);
    
            if ($resultadoEmail['total'] > 0) {
                echo '<script>
                    alert("Ya existe un estado civil con el mismo nombre.");
                    </script>';
                return;
            }
            $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(nombre_estado_civil) VALUES (:nombre_estado_civil)");

            $stmt->bindParam(":nombre_estado_civil", $datos["nombre_estado_civil"], PDO::PARAM_STR);
        
          



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

    static public function mdlEditarEstadoCivil($tabla, $datos)
    {
        if(!preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $datos["nombre_estado_civil"])) {
            echo '<script>
                alert("El nombre debe contener solo letras y espacios.");
                </script>';
            return; 
        }
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre_estado_civil = :nombre_estado_civil WHERE id_estado_civil = :id_estado_civil");
    
        $stmt->bindParam(":nombre_estado_civil", $datos["nombre_estado_civil"], PDO::PARAM_STR);
        $stmt->bindParam(":id_estado_civil", $datos["id_estado_civil"], PDO::PARAM_INT); // Agregado para enlazar el parámetro id_estado_civil
        
  
        if ($stmt->execute()) {
            return "ok";
        } else {
            return $stmt->errorInfo();
        }
    }
    
    /*=============================================
    ELIMINAR DATO
    =============================================*/
    static public function mdlEliminarEstadoCivil($idEstadoCivil)
    {
        try
        {
            $stmt = Conexion::conectar()->prepare("DELETE FROM estados_civiles WHERE id_estado_civil = :id_estado_civil");
            $stmt->bindParam(":id_estado_civil", $idEstadoCivil, PDO::PARAM_INT); // Cambia $cliente a $idCategoria
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