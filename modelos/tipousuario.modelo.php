<?php
class ModeloTipoUsuario
{
    static public function mdlAgregarTipoUsuario($tabla, $datos)
    {
        try
        {
            $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(nombre) VALUES (:nombre)");

            $stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);

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

    static public function obtenerUltimoIdInsertado()
    {
        try {
            $stmt = Conexion::conectar()->query("SELECT LAST_INSERT_ID() as last_id");
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            return $result['last_id'];
        } catch (Exception $e) {
            return "Error: " . $e->getMessage();
        }
    }
}
?>
