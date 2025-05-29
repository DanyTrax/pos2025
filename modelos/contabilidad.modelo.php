<?php

require_once "conexion.php";

class ModeloContabilidad
{
    private const TABLA = 'contabilidad';

    public static function save($datos)
    {
        $columns = '';
        $values = '';
        foreach ($datos as $key => $value) {
            $columns .= $key . ',';
            $values .= "'" . $value . "',";
        }
        $columns = substr($columns, 0, -1);
        $values = substr($values, 0, -1);
        $sql = "INSERT INTO " . self::TABLA . " ($columns) VALUES ($values)";

        $stmt = Conexion::conectar()->prepare($sql);

        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }
    }

    public static function filterBy($fechaInicial, $fechaFinal, $medioPago, $tipo)
    {
        $sql = "SELECT * FROM " . self::TABLA . " WHERE tipo = '$tipo'";

        if ($fechaInicial != null && $fechaFinal != null) {
            $sql .= " AND fecha BETWEEN '$fechaInicial' AND '$fechaFinal'";
        }

        if ($medioPago != null) {
            $sql .= " AND medio_pago = '$medioPago'";
        }

        $sql .= " ORDER BY id DESC";

        $stmt = Conexion::conectar()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public static function findById($id)
    {
        $sql = "SELECT * FROM " . self::TABLA . " WHERE id = '$id'";
        $stmt = Conexion::conectar()->prepare($sql);
        $stmt->execute();
        return $stmt->fetch();
    }

    public static function update($id, $datos)
    {
        $columns = '';
        foreach ($datos as $key => $value) {
            $columns .= $key . "='" . $value . "',";
        }
        $columns = substr($columns, 0, -1);
        $sql = "UPDATE " . self::TABLA . " SET $columns WHERE id = :id";

        $stmt = Conexion::conectar()->prepare($sql);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }
    }

    public static function delete($id)
    {
        $sql = "DELETE FROM " . self::TABLA . " WHERE id = :id";
        $stmt = Conexion::conectar()->prepare($sql);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }
    }

    public static function sumByTipo($tipo)
    {
        $dataInicial = date('Y-m-d 00:00:00');
        $dataFinal = date('Y-m-d 23:59:59');

        $sql = "SELECT SUM(valor) AS total FROM " . self::TABLA . " WHERE tipo = '$tipo' AND fecha BETWEEN '$dataInicial' AND '$dataFinal'";
        $stmt = Conexion::conectar()->prepare($sql);
        $stmt->execute();
        return $stmt->fetch();
    }

    public static function sumByTipoAndMedio($tipo, $medioPago)
    {
        $dataInicial = date('Y-m-d 00:00:00');
        $dataFinal = date('Y-m-d 23:59:59');

        $sql = "SELECT SUM(valor) AS total FROM " . self::TABLA . " WHERE tipo = '$tipo' AND medio_pago = '$medioPago' AND fecha BETWEEN '$dataInicial' AND '$dataFinal'";
        $stmt = Conexion::conectar()->prepare($sql);
        $stmt->execute();
        return $stmt->fetch();
    }
}
