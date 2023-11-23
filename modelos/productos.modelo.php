<?php

include 'conexion.php';

class ModeloProductos
{
    /*=============================================
    MOSTRAR PRODUCTOS
    =============================================*/
    static public function mdlMostrarProductos($tabla, $item = null, $valor = null)
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

    /*=============================================
    AGREGAR PRODUCTO
    =============================================*/
    static public function mdlAgregarProducto($tabla, $datos)
    {
        try {
            // Corregir la consulta SQL y agregar fecha_creacion
            $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (nombre_producto, id_categoria, precio_producto, imagen_producto, estado_producto, stock_producto, fecha_creacion) VALUES (:nombre_producto, :id_categoria, :precio_producto, :imagen_producto, :estado_producto, :stock_producto, NOW())");
    
            $stmt->bindParam(":nombre_producto", $datos['nombre_producto'], PDO::PARAM_STR);
            $stmt->bindParam(":id_categoria", $datos['id_categoria'], PDO::PARAM_INT);
            $stmt->bindParam(":precio_producto", $datos['precio_producto'],PDO::PARAM_INT);
            $stmt->bindParam(":imagen_producto", $datos['imagen_producto'],PDO::PARAM_STR);
            $stmt->bindParam(":estado_producto", $datos['estado_producto'], PDO::PARAM_STR);
            $stmt->bindParam(":stock_producto", $datos['stock_producto'], PDO::PARAM_INT);
            
            if ($stmt->execute()) {
                return "ok";
            } else {
                echo "Error en la ejecución de la consulta: ";
                print_r($stmt->errorInfo());
            }
        } catch (PDOException $e) {
            return "Error al agregar producto: " . $e->getMessage();
        }
    }
    
    /*=============================================
    EDITAR PRODUCTO
    =============================================*/
    static public function mdlEditarProducto($tabla, $datos)
    {
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre_producto = :nombre_producto, id_categoria = :id_categoria, precio_producto = :precio_producto, imagen_producto = :imagen_producto, estado_producto = :estado_producto, stock_producto = :stock_producto WHERE id_producto = :id_producto");

        $stmt->bindParam(":id_producto", $datos['id_producto'], PDO::PARAM_INT);
        $stmt->bindParam(":nombre_producto", $datos['nombre_producto'], PDO::PARAM_STR);
        $stmt->bindParam(":id_categoria", $datos['id_categoria'], PDO::PARAM_INT);
        $stmt->bindParam(":precio_producto", $datos['precio_producto'], PDO::PARAM_STR);
        $stmt->bindParam(":imagen_producto", $datos['imagen_producto'], PDO::PARAM_STR);
        $stmt->bindParam(":estado_producto", $datos['estado_producto'], PDO::PARAM_INT);
        $stmt->bindParam(":stock_producto", $datos['stock_producto'], PDO::PARAM_INT);

        if ($stmt->execute()) {
            return "ok";
        } else {
            return $stmt->errorInfo();
        }
}

    /*=============================================
    ELIMINAR PRODUCTO
    =============================================*/
    static public function mdlEliminarProducto($tabla, $idProducto)
    {
        $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");

        $stmt->bindParam(":id", $idProducto, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return "ok";
        } else {
            return $stmt->errorInfo();
        }
    }
    static public function mdlMostrarCategoriasProductos()
{
    try {
        $stmt = Conexion::conectar()->prepare("SELECT * FROM categorias");
        $stmt->execute();
        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

   

        return $resultados;
    } catch (PDOException $e) {
        echo "Error al agregar producto: " . $e->getMessage();
        echo "<pre>";
        print_r($datos);
        echo "</pre>";
        return "Error: " . $e->getMessage();
    }
}

}
?>