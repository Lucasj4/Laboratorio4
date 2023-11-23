<?php

require_once 'conexion.php';

class ModeloUsuarios
{

    static public function mdlMostrarUsuarios($tabla, $item, $valor)
    {
        if ($item != null)
        {
            try
            {
                $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
                //enlace de parametros
                $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);
                $stmt->execute();
                return $stmt->fetch(PDO::FETCH_ASSOC);
            }
            catch (Exception $e)
            {
                return "Error: " . $e->getMessage();
            }
        }
        

    }
    static public function mdlMostrarRoles($tabla)
    {
        try
        {
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        catch (Exception $e)
        {
            "Error: " . $e->getMessage();
        }
    }

    static public function mdlAgregarUsuario($tabla, $datos)
    {
        try {
            $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(nombre_usuario, apellido_usuario, email_usuario, rol_usuario, password_usuario, estado_usuario, fecha_creacion, fecha_ultimo_ingreso) 
            VALUES (:nombre_usuario, :apellido_usuario, :email_usuario, :rol_usuario, :password_usuario, :estado_usuario, :fecha_creacion, :fecha_ultimo_ingreso)");
    
            $stmt->bindParam(":nombre_usuario", $datos["nombre_usuario"], PDO::PARAM_STR);
            $stmt->bindParam(":apellido_usuario", $datos["apellido_usuario"], PDO::PARAM_STR);
            $stmt->bindParam(":email_usuario", $datos["email_usuario"], PDO::PARAM_STR);
            $stmt->bindParam(":rol_usuario", $datos["rol_usuario"], PDO::PARAM_STR);
            $stmt->bindParam(":password_usuario", $datos["password_usuario"], PDO::PARAM_STR);
            $stmt->bindParam(":estado_usuario", $datos["estado_usuario"], PDO::PARAM_INT);
            $stmt->bindParam(":fecha_creacion", $datos["fecha_creacion"], PDO::PARAM_STR);
            $stmt->bindParam(":fecha_ultimo_ingreso", $datos["fecha_ultimo_ingreso"], PDO::PARAM_STR);
            
            if ($stmt->execute()) {
                return "ok";
            } else {
                // Imprimir información de error
                var_dump($stmt->errorInfo());
                return "error";
            }
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }


public function mdlEditarUsuario($tabla, $datos)
{
    try {
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla 
                                              SET nombre_usuario = :nombre_usuario,
                                                  apellido_usuario = :apellido_usuario,
                                                  email_usuario = :email_usuario,
                                                  rol_usuario = :rol_usuario,
                                                  password_usuario = :password_usuario,
                                                  estado_usuario = :estado_usuario
                                              WHERE id_usuario = :id_usuario");

        $stmt->bindParam(":nombre_usuario", $datos["nombre_usuario"], PDO::PARAM_STR);
        $stmt->bindParam(":apellido_usuario", $datos["apellido_usuario"], PDO::PARAM_STR);
        $stmt->bindParam(":email_usuario", $datos["email_usuario"], PDO::PARAM_STR);
        $stmt->bindParam(":rol_usuario", $datos["rol_usuario"], PDO::PARAM_STR);
        $stmt->bindParam(":password_usuario", $datos["password_usuario"], PDO::PARAM_STR);
        $stmt->bindParam(":estado_usuario", $datos["estado_usuario"], PDO::PARAM_INT);
        $stmt->bindParam(":id_usuario", $datos["id_usuario"], PDO::PARAM_INT);

        if ($stmt->execute()) {
            return "ok";
        } else {
            // Imprimir información de error
            var_dump($stmt->errorInfo());
            return "error";
        }
    } catch (PDOException $e) {
        return "Error: " . $e->getMessage();
    }
}

static public function mdlEliminarUsuario($usuario)
{
    try
    {
        $stmt = Conexion::conectar()->prepare("DELETE FROM usuarios WHERE id_usuario = :id_usuario");
        $stmt->bindParam(":id_usuario", $usuario, PDO::PARAM_INT);
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

static public function mdlActualizarLogin($tabla, $item1, $valor1, $item2, $valor2)
{
    try
    {
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :$item1 WHERE $item2 = :$item2");

        $stmt->bindParam(":" . $item1, $valor1, PDO::PARAM_STR);
        $stmt->bindParam(":" . $item2, $valor2, PDO::PARAM_INT);

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
}

static public function mdlRenovarPassword($password, $id_usuario)
{
    try
    {
        $stmt = Conexion::conectar()->prepare("UPDATE usuarios SET password_usuario = '$password' WHERE id_usuario = $id_usuario");

        $stmt->bindParam(":" . $password, $password, PDO::PARAM_STR);
        $stmt->bindParam(":" . $id_usuario, $id_usuario, PDO::PARAM_INT);

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

   
}
}