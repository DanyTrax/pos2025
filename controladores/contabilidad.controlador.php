<?php

class ControladorContabilidad
{
    public static function crear()
    {
        if (isset($_POST["nuevoGasto"])) {
            $datos = array(
                "id_vendedor" => $_POST["idVendedor"],
                "fecha" => $_POST["fecha"],
                "detalle" => $_POST["detalle"],
                "valor" => $_POST["valor"],
                "medio_pago" => $_POST["nuevoMedioPago"],
                "tipo" => 'Gasto',
            );
            $respuesta = ModeloContabilidad::save($datos);
            if ($respuesta == "ok") {
                echo '<script>
                    swal({
                        type: "success",
                        title: "¡El gasto ha sido guardado correctamente!",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"
                        }).then(function(result){
                            if (result.value) {
                                window.location = "gastos";
                            }
                        });
                    </script>';
            }
        }
    }

    public static function crearEntrada()
    {
        if (isset($_POST["nuevoEntrada"])) {
            $datos = array(
                "id_vendedor" => $_POST["idVendedor"],
                "fecha" => $_POST["fecha"],
                "detalle" => $_POST["descripcion"],
                "valor" => $_POST["valor"],
                "medio_pago" => $_POST["nuevoMedioPago"],
                "tipo" => 'Entrada',
            );
            $respuesta = ModeloContabilidad::save($datos);
            if ($respuesta == "ok") {
                echo '<script>
                    swal({
                        type: "success",
                        title: "La entrada ha sido guardado correctamente!",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"
                        }).then(function(result){
                            if (result.value) {
                                window.location = "entradas";
                            }
                        });
                    </script>';
            }
        }
    }

    public static function filterBy($fechaInicial, $fechaFinal, $medioPago, $tipo)
    {
        $respuesta = ModeloContabilidad::filterBy($fechaInicial, $fechaFinal, $medioPago, $tipo);
        return $respuesta;
    }

    public static function findById($id)
    {
        $respuesta = ModeloContabilidad::findById($id);
        return $respuesta;
    }

    public static function editarGasto()
    {
        if (isset($_POST["editarGasto"])) {
            $datos = array(
                "fecha" => $_POST["fecha"],
                "detalle" => $_POST["detalle"],
                "valor" => $_POST["valor"],
                "medio_pago" => $_POST["nuevoMedioPago"],
            );
            $respuesta = ModeloContabilidad::update($_POST["id"], $datos);
            if ($respuesta == "ok") {
                echo '<script>
                    swal({
                        type: "success",
                        title: "¡El gasto ha sido actualizado correctamente!",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"
                        }).then(function(result){
                            if (result.value) {
                                window.location = "gastos";
                            }
                        });
                    </script>';
            }
        }
    }

    public static function editarEntrada()
    {
        if (isset($_POST["editarEntrada"])) {
            $datos = array(
                "fecha" => $_POST["fecha"],
                "detalle" => $_POST["descripcion"],
                "valor" => $_POST["valor"],
                "medio_pago" => $_POST["nuevoMedioPago"],
            );
            $respuesta = ModeloContabilidad::update($_POST["id"], $datos);
            if ($respuesta == "ok") {
                echo '<script>
                    swal({
                        type: "success",
                        title: "¡El entrada ha sido actualizado correctamente!",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"
                        }).then(function(result){
                            if (result.value) {
                                window.location = "entradas";
                            }
                        });
                    </script>';
            }
        }
    }

    public static function deleteGasto()
    {
        if (isset($_GET["id"])) {
            $respuesta = ModeloContabilidad::delete($_GET["id"]);
            if ($respuesta == "ok") {
                echo '<script>
                    swal({
                        type: "success",
                        title: "¡El gasto ha sido eliminado correctamente!",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"
                        }).then(function(result){
                            if (result.value) {
                                window.location = "gastos";
                            }
                        });
                    </script>';
            }
        }
    }

    public static function deleteEntrada()
    {
        if (isset($_GET["id"])) {
            $respuesta = ModeloContabilidad::delete($_GET["id"]);
            if ($respuesta == "ok") {
                echo '<script>
                    swal({
                        type: "success",
                        title: "¡El entrada ha sido eliminado correctamente!",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"
                        }).then(function(result){
                            if (result.value) {
                                window.location = "entradas";
                            }
                        });
                    </script>';
            }
        }
    }

    public static function reporteGastos()
    {
        $fechaInicial = isset($_GET["fechaInicial"]) ? $_GET["fechaInicial"] : null;
        $fechaFinal = isset($_GET["fechaFinal"]) ? $_GET["fechaFinal"] : null;
        $medioPago = isset($_GET["medioPago"]) ? $_GET["medioPago"] : null;

        $respuesta = ControladorContabilidad::filterBy($fechaInicial, $fechaFinal, $medioPago, 'Gasto');


        /*=============================================
			CREAMOS EL ARCHIVO DE EXCEL
			=============================================*/

        $Name = 'reporte.xls';

        header('Expires: 0');
        header('Cache-control: private');
        header("Content-type: application/vnd.ms-excel"); // Archivo de Excel
        header("Cache-Control: cache, must-revalidate");
        header('Content-Description: File Transfer');
        header('Last-Modified: ' . date('D, d M Y H:i:s'));
        header("Pragma: public");
        header('Content-Disposition:; filename="' . $Name . '"');
        header("Content-Transfer-Encoding: binary");

        echo utf8_decode("<table border='0'> 

					<tr> 
					<td style='font-weight:bold; border:1px solid #eee;'>CÓDIGO</td> 
					<td style='font-weight:bold; border:1px solid #eee;'>VENDEDOR</td>
					<td style='font-weight:bold; border:1px solid #eee;'>DETALLE</td>
					<td style='font-weight:bold; border:1px solid #eee;'>VALOR</td>
					<td style='font-weight:bold; border:1px solid #eee;'>MEDIO PAGO</td>
					<td style='font-weight:bold; border:1px solid #eee;'>FECHA</td>
					</tr>");

        foreach ($respuesta as $row => $item) {

            $vendedor = ControladorUsuarios::ctrMostrarUsuarios("id", $item["id_vendedor"]);

            echo utf8_decode("<tr>
			 			<td style='border:1px solid #eee;'>" . $item["id"] . "</td> 
			 			<td style='border:1px solid #eee;'>" . $vendedor["nombre"] . "</td>
			 			<td style='border:1px solid #eee;'>" . $item["detalle"] . "</td>
			 			<td style='border:1px solid #eee;'>" . $item["valor"] . "</td>
			 			<td style='border:1px solid #eee;'>" . $item["medio_pago"] . "</td>
			 			<td style='border:1px solid #eee;'>" . $item["fecha"] . "</td>
		 			</tr>");
        }


        echo "</table>";
    }

    public static function reporteEntrada()
    {
        $fechaInicial = isset($_GET["fechaInicial"]) ? $_GET["fechaInicial"] : null;
        $fechaFinal = isset($_GET["fechaFinal"]) ? $_GET["fechaFinal"] : null;
        $medioPago = isset($_GET["medioPago"]) ? $_GET["medioPago"] : null;

        $respuesta = ControladorContabilidad::filterBy($fechaInicial, $fechaFinal, $medioPago, 'Entrada');


        /*=============================================
			CREAMOS EL ARCHIVO DE EXCEL
			=============================================*/

        $Name = 'reporte.xls';

        header('Expires: 0');
        header('Cache-control: private');
        header("Content-type: application/vnd.ms-excel"); // Archivo de Excel
        header("Cache-Control: cache, must-revalidate");
        header('Content-Description: File Transfer');
        header('Last-Modified: ' . date('D, d M Y H:i:s'));
        header("Pragma: public");
        header('Content-Disposition:; filename="' . $Name . '"');
        header("Content-Transfer-Encoding: binary");

        echo utf8_decode("<table border='0'> 

					<tr> 
					<td style='font-weight:bold; border:1px solid #eee;'>#</td> 
					<td style='font-weight:bold; border:1px solid #eee;'>Empresa</td>
					<td style='font-weight:bold; border:1px solid #eee;'>Factura</td>
					<td style='font-weight:bold; border:1px solid #eee;'>Fecha</td>
					<td style='font-weight:bold; border:1px solid #eee;'>Descipci&oacute;n</td>
					<td style='font-weight:bold; border:1px solid #eee;'>Valor</td>
					<td style='font-weight:bold; border:1px solid #eee;'>Medio Pago</td>
					<td style='font-weight:bold; border:1px solid #eee;'>Forma Pago</td>
					</tr>");

        foreach ($respuesta as $key => $item) {

            $vendedor = ControladorUsuarios::ctrMostrarUsuarios("id", $item["id_vendedor"]);

            echo utf8_decode("<tr>
			 			<td style='border:1px solid #eee;'>" . ($key + 1) . "</td> 
			 			<td style='border:1px solid #eee;'>" . $vendedor["empresa"] . "</td>
			 			<td style='border:1px solid #eee;'>" . $item["factura"] . "</td>
			 			<td style='border:1px solid #eee;'>" . $item["fecha"] . "</td>
			 			<td style='border:1px solid #eee;'>" . $item["detalle"] . "</td>
			 			<td style='border:1px solid #eee;'>" . numberFormat($item["valor"]) . "</td>
			 			<td style='border:1px solid #eee;'>" . $item['medio_pago'] . "</td>
			 			<td style='border:1px solid #eee;'>" . $item['forma_pago'] . "</td>
		 			</tr>");
        }


        echo "</table>";
    }

    public static function sumEntradas()
    {
        $sum = ModeloContabilidad::sumByTipo('Entrada');
        return $sum['total'];
    }

    public static function sumEntradasBy()
    {
        $sum = ModeloContabilidad::sumByTipoAndMedio('Entrada', 'Efectivo');
        return $sum['total'];
    }

    public static function sumGastos()
    {
        $sum = ModeloContabilidad::sumByTipo('Gasto');
        return $sum['total'];
    }

    public static function sumGastosBy()
    {
        $sum = ModeloContabilidad::sumByTipoAndMedio('Gasto', 'Efectivo');
        return $sum['total'];
    }
}
