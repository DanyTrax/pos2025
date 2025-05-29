<?php

require_once "conexion.php";

class ModeloVentas
{

	/*=============================================
	MOSTRAR VENTAS
	=============================================*/

	static public function mdlMostrarVentas($tabla, $item, $valor)
	{

		if ($item != null) {

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item ORDER BY id ASC");

			$stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);

			$stmt->execute();

			return $stmt->fetch();
		} else {

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY id ASC");

			$stmt->execute();

			return $stmt->fetchAll();
		}

		$stmt->close();

		$stmt = null;
	}

	/*=============================================
	REGISTRO DE VENTA
	=============================================*/
	static public function mdlIngresarVenta($tabla, $datos)
	{
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(codigo,id_cliente,id_vendedor,productos,impuesto,descuento,neto,total,detalle,metodo_pago,fecha_venta,abono,id_vend_abono,fecha_abono, pago, Ult_abono, medio_pago) VALUES (:codigo,:id_cliente,:id_vendedor,:productos,:impuesto,:descuento,:neto,:total,:detalle,:metodo_pago,:fecha_venta,:abono,:id_vend_abono,:fecha_abono, '', 0, :medio_pago)");
		$stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_INT);
		$stmt->bindParam(":id_cliente", $datos["id_cliente"], PDO::PARAM_INT);
		$stmt->bindParam(":id_vendedor", $datos["id_vendedor"], PDO::PARAM_INT);
		$stmt->bindParam(":productos", $datos["productos"], PDO::PARAM_STR);
		$stmt->bindParam(":impuesto", $datos["impuesto"], PDO::PARAM_STR);
		$stmt->bindParam(":descuento", $datos["descuento"], PDO::PARAM_STR);
		$stmt->bindParam(":neto", $datos["neto"], PDO::PARAM_STR);
		$stmt->bindParam(":total", $datos["total"], PDO::PARAM_STR);
		$stmt->bindParam(":detalle", $datos["detalle"], PDO::PARAM_STR);
		$stmt->bindParam(":metodo_pago", $datos["metodo_pago"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_venta", $datos["fecha_venta"], PDO::PARAM_STR);
		$stmt->bindParam(":id_vend_abono", $datos["id_vend_abono"], PDO::PARAM_INT);
		$stmt->bindParam(":abono", $datos["abono"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_abono", $datos["fecha_abono"], PDO::PARAM_STR);
		$stmt->bindParam(":medio_pago", $datos["medio_pago"], PDO::PARAM_STR);
		if ($stmt->execute()) {
			return "ok";
		} else {
			return "error";
		}
		$stmt = null;
	}

	/*=============================================
	EDITAR VENTA
	=============================================*/
	static public function mdlEditarVenta($tabla, $datos)
	{
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET id_cliente=:id_cliente,id_vendedor=:id_vendedor,productos=:productos,impuesto=:impuesto,neto=:neto,total=:total,detalle=:detalle,metodo_pago=:metodo_pago,fecha_venta=:fecha_venta,abono=:abono,id_vend_abono=:id_vend_abono,fecha_abono=:fecha_abono,pago=:pago, medio_pago = :medio_pago WHERE codigo=:codigo");
		$stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_INT);
		$stmt->bindParam(":id_cliente", $datos["id_cliente"], PDO::PARAM_INT);
		$stmt->bindParam(":id_vendedor", $datos["id_vendedor"], PDO::PARAM_INT);
		$stmt->bindParam(":productos", $datos["productos"], PDO::PARAM_STR);
		$stmt->bindParam(":impuesto", $datos["impuesto"], PDO::PARAM_STR);
		$stmt->bindParam(":neto", $datos["neto"], PDO::PARAM_STR);
		$stmt->bindParam(":total", $datos["total"], PDO::PARAM_STR);
		$stmt->bindParam(":detalle", $datos["detalle"], PDO::PARAM_STR);
		$stmt->bindParam(":metodo_pago", $datos["metodo_pago"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_venta", $datos["fecha_venta"], PDO::PARAM_STR);
		$stmt->bindParam(":id_vend_abono", $datos["id_vend_abono"], PDO::PARAM_INT);
		$stmt->bindParam(":abono", $datos["abono"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_abono", $datos["fecha_abono"], PDO::PARAM_STR);
		$stmt->bindParam(":pago", $datos["pago"], PDO::PARAM_STR);
		$stmt->bindParam(":medio_pago", $datos["medio_pago"], PDO::PARAM_STR);
		if ($stmt->execute()) {
			return "ok";
		} else {
			return "error";
		}
		$stmt = null;
	}

	// ACTUALIZAR ABONO
	static public function mdlActualizarDatosAbono($tabla, $datos)
	{
		$sql = "UPDATE $tabla SET metodo_pago=:metodo_pago,id_vend_abono=:id_vend_abono,abono=:abono,fecha_abono=:fecha_abono,Ult_abono=:Ult_abono WHERE id=:id";
		$stmt = Conexion::conectar()->prepare($sql);
		$stmt->bindParam(":metodo_pago", $datos["metodo_pago"], PDO::PARAM_STR);
		$stmt->bindParam(":id_vend_abono", $datos["id_vend_abono"], PDO::PARAM_INT);
		$stmt->bindParam(":abono", $datos["abono"], PDO::PARAM_STR);
		$stmt->bindParam(":Ult_abono", $datos["Ult_abono"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_abono", $datos["fecha_abono"], PDO::PARAM_STR);
		$stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);
		if ($stmt->execute()) {
			return "ok";
		} else {
			return "error";
		}
		$stmt = null;
	}

	/*=============================================
	ELIMINAR VENTA
	=============================================*/

	static public function mdlEliminarVenta($tabla, $datos)
	{

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");

		$stmt->bindParam(":id", $datos, PDO::PARAM_INT);

		if ($stmt->execute()) {

			return "ok";
		} else {

			return "error";
		}

		$stmt->close();

		$stmt = null;
	}

	/*=============================================
	RANGO FECHAS
	=============================================*/

	static public function mdlRangoFechasVentas($tabla, $fechaInicial, $fechaFinal)
	{
		if ($fechaInicial == null) {

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY id DESC");
			// $stmt->bindParam(":fecha_venta", $fechaFinal, PDO::PARAM_STR);

			$stmt->execute();

			return $stmt->fetchAll();
		} else if ($fechaInicial == $fechaFinal) {

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE fecha_venta like '%$fechaFinal%'");

			// $stmt->bindParam(":fecha_venta", $fechaFinal, PDO::PARAM_STR);

			$stmt->execute();

			return $stmt->fetchAll();
		} else {

			$fechaActual = new DateTime();
			$fechaActual->add(new DateInterval("P1D"));
			$fechaActualMasUno = $fechaActual->format("Y-m-d");

			$fechaFinal2 = new DateTime($fechaFinal);
			$fechaFinal2->add(new DateInterval("P1D"));
			$fechaFinalMasUno = $fechaFinal2->format("Y-m-d");

			if ($fechaFinalMasUno == $fechaActualMasUno) {

				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE fecha_venta BETWEEN '$fechaInicial' AND '$fechaFinalMasUno'");
			} else {


				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE fecha_venta BETWEEN '$fechaInicial' AND '$fechaFinal'");
			}

			$stmt->execute();

			return $stmt->fetchAll();
		}
	}
	/*=============================================
	SUMAR EL TOTAL DE VENTAS
	=============================================*/

	static public function mdlSumaTotalVentas3($tabla3)
	{

		$stmt = Conexion::conectar()->prepare("SELECT SUM(total) as total FROM $tabla3");

		$stmt->execute();

		return $stmt->fetch();

		$stmt->close();

		$stmt = null;
	}

	/*=============================================
	SUMAR EL TOTAL DE VENTAS Infinito
	=============================================*/

	static public function mdlSumaTotalVentas($tabla)
	{
		$iniciofc = date("Y-m-01");

		$finfc = date("Y-m-t");

		$stmt = Conexion::conectar()->prepare("SELECT SUM(v.total) as total FROM usuarios u, ventas v WHERE u.id = v.id_vendedor AND u.empresa = 'Infinito' AND (v.fecha_venta) BETWEEN '$iniciofc' AND '$finfc'");

		$stmt->execute();

		return $stmt->fetch();

		$stmt->close();

		$stmt = null;
	}
	//SUMAR EL TOTAL DE VENTAS LEMA
	//=============================================//

	static public function mdlSumaTotalVentas1($tabla1)
	{
		$iniciofc = date("Y-m-01");

		$finfc = date("Y-m-t");

		$stmt = Conexion::conectar()->prepare("SELECT SUM(v.total) as total FROM usuarios u, ventas v WHERE u.id = v.id_vendedor AND u.empresa = 'Lema' AND (v.fecha_venta) BETWEEN '$iniciofc' AND '$finfc'");

		$stmt->execute();

		return $stmt->fetch();

		$stmt->close();

		$stmt = null;
	}
	//SUMAR EL TOTAL DE VENTAS EPICO
	//=============================================//

	static public function mdlSumaTotalVentas2($tabla1)
	{
		$iniciofc = date("Y-m-01");

		$finfc = date("Y-m-t");

		$stmt = Conexion::conectar()->prepare("SELECT SUM(v.total) as total FROM usuarios u, ventas v WHERE u.id = v.id_vendedor AND u.empresa = 'Epico' AND (v.fecha_venta) BETWEEN '$iniciofc' AND '$finfc'");

		$stmt->execute();

		return $stmt->fetch();

		$stmt->close();

		$stmt = null;
	}

	// Ultimo C¨®digo de Venta
	static public function mdlLastCodVenta($tabla)
	{
		$sql = "SELECT MAX(codigo) FROM $tabla";
		$stmt = Conexion::conectar()->prepare($sql);
		$stmt->execute();
		return $stmt->fetch();
		$stmt = null;
	}

	public static function mdlFilterBy($tabla, $fechaInicial, $fechaFinal, $medioPago, $formaPago)
	{
		$sql = "SELECT * FROM $tabla";

		$filter = false;

		if ($fechaInicial != null) {
			$where = $filter ? " AND " : " WHERE ";
			$sql .= "$where fecha_venta BETWEEN '$fechaInicial' AND '$fechaFinal'";
			$filter = true;
		}

		if ($medioPago != null) {
			$where = $filter ? " AND " : " WHERE ";
			$sql .= "$where medio_pago = '$medioPago'";
			$filter = true;
		}

		if ($formaPago != null) {
			$where = $filter ? " AND " : " WHERE ";
			$sql .= "$where metodo_pago = '$formaPago'";
			$filter = true;
		}

		$stmt = Conexion::conectar()->prepare("$sql ORDER BY id DESC");
		$stmt->execute();

		return $stmt->fetchAll();
	}
}
