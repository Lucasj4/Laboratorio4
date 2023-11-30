<?php

#require_once 'conexion.php';

class ModeloCategorias
{

    static public function mdlMostrarCategorias($tabla, $item = null, $valor = null)
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


    static public function mdlAgregarCategoria($tabla, $datos)
    {
        try
        {   
            if(!preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $datos["nombre_categoria"])) {
                echo '<script>
                    alert("El nombre debe contener solo letras y espacios.");
                    </script>';
                return; 
            }
    
                $stmtCategoria = Conexion::conectar()->prepare("SELECT COUNT(*) as total FROM $tabla WHERE nombre_categoria = :nombre_categoria");
                $stmtCategoria->bindParam(":nombre_categoria", $datos["nombre_categoria"], PDO::PARAM_STR);
                $stmtCategoria->execute();
                $resultadoCategoria = $stmtCategoria->fetch(PDO::FETCH_ASSOC);
              
                if (($resultadoCategoria['total']) > 0) {
                    // Mostrar el alert
                    echo '<script>
                    alert("Ya existe una categoria con el mismo nombre.");
                    </script>';
                    return;
                  }
            $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(nombre_categoria, descripcion_categoria ) VALUES (:nombre_categoria, :descripcion_categoria)");

            $stmt->bindParam(":nombre_categoria", $datos["nombre_categoria"], PDO::PARAM_STR);
            $stmt->bindParam(":descripcion_categoria", $datos["descripcion_categoria"], PDO::PARAM_STR);
                



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

    static public function mdlEditarCategoria($tabla, $datos)
    {
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre_categoria = :nombre_categoria, descripcion_categoria = :descripcion_categoria WHERE id_categoria = :id_categoria");

        $stmt->bindParam(":id_categoria", $datos['id_categoria'], PDO::PARAM_INT);
        $stmt->bindParam(":nombre_categoria", $datos['nombre_categoria'], PDO::PARAM_STR);
        $stmt->bindParam(":descripcion_categoria", $datos['descripcion_categoria'], PDO::PARAM_STR);


        if ($stmt->execute()) {
            return "ok";
        } else {
            
            return $stmt->errorInfo();
        }
}
    
    /*=============================================
    ELIMINAR DATO
    =============================================*/
    static public function mdlEliminarCategoria($idCategoria)
    {
        try
        {
            $stmt = Conexion::conectar()->prepare("DELETE FROM categorias WHERE id_categoria = :id_categoria");
            $stmt->bindParam(":id_categoria", $idCategoria, PDO::PARAM_INT); // Cambia $cliente a $idCategoria
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