<?php

if ($_SESSION["perfil"] == "Especial") {

  echo '<script>

    window.location = "inicio";

  </script>';

  return;
}

$xml = ControladorVentas::ctrDescargarXML();

if ($xml) {

  rename($_GET["xml"] . ".xml", "xml/" . $_GET["xml"] . ".xml");

  echo '<a class="btn btn-block btn-success abrirXML" archivo="xml/' . $_GET["xml"] . '.xml" href="ventas">Se ha creado correctamente el archivo XML <span class="fa fa-times pull-right"></span></a>';
}

?>
<div class="content-wrapper">

  <section class="content-header">

    <h1>

      Administrar ventas

    </h1>

    <ol class="breadcrumb">

      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li class="active">Administrar ventas</li>

    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">

        <a href="crear-venta">

          <button class="btn btn-primary">

            Agregar venta

          </button>

        </a>

        <!-- <---------------------------------------------------------------------- -->



        <!--=====================================        
	       <?php

          if (isset($_GET["fechaInicial"])) {

            echo '<a href="vistas/modulos/descargar-reporte.php?reporte=reporte&fechaInicial=' . $_GET["fechaInicial"] . '&fechaFinal=' . $_GET["fechaFinal"] . '">';
          } else {

            echo '<a href="vistas/modulos/descargar-reporte.php?reporte=reporte">';
          }
          ?>
       
	           <button class="btn btn-success" style="margin-top:5px">Reporte Excel</button>
	
	          </a>
======================================-->

            
           
            

        <!-- <---------------------------------------------------------------------- -->
        <?php
        $formaPago = isset($_GET['formaPago']) ? $_GET['formaPago'] : null;
        ?>
        <select class="btn pull-right" name="filter-formaPago" id="filter-formaPago" style="margin-left: 10px;">
          <option value="" <?= $formaPago === null ? 'selected' : '' ?>>Forma de Pago</option>
          <option value="">Todos</option>
          <?php foreach (FormaPago::ALL as $value) : ?>
            <option value="<?= $value ?>" <?= $formaPago === $value ? 'selected' : '' ?>><?= $value ?></option>
          <?php endforeach; ?>
        </select>

        <?php
        $medioPago = isset($_GET['medioPago']) ? $_GET['medioPago'] : null;
        ?>
        <select class="btn pull-right" name="filter-medioPago" id="filter-medioPago" style="margin-left: 10px;">
          <option value="" <?= $medioPago === null ? 'selected' : '' ?>>Medio de Pago</option>
          <option value="">Todos</option>
          <?php foreach (MedioPago::ALL as $value) : ?>
            <option value="<?= $value ?>" <?= $medioPago === $value ? 'selected' : '' ?>><?= $value ?></option>
          <?php endforeach; ?>
        </select>

        <button type="button" class="btn btn-default pull-right" id="daterange-btn">


          <span>
            <i class="fa fa-calendar"></i>

            <?php

            if (isset($_GET["fechaInicial"])) {

              echo $_GET["fechaInicial"] . " - " . $_GET["fechaFinal"];
            } else {

              echo 'Rango de fecha';
            }

            ?>
          </span>

          <i class="fa fa-caret-down"></i>

        </button>

      </div>
        
      <div class="box-body">

        <table class="table table-bordered table-striped dt-responsive tablas" width="100%">

          <thead>

            <tr>

              <th style="width:3px">#</th>
              <th style="width:20px">Cod.factura</th>
              <th>Cliente</th>
              <th style="width:3px">Emp</th>
              <th>Vendedor</th>
              <th>V_Abono</th>
              <th style="width:80px">Forma de pago</th>
              <th>Neto</th>
              <th>Total</th>
              <th>Fecha Venta</th>
              <th>Abono</th>
              <th>Ult_Abono</th>
              <th>Pago</th>
              <th>Medio Pago</th>
              <th>Acciones</th>

            </tr>

          </thead>

          <tbody>

            <?php
            
            $fechaInicial = isset($_GET["fechaInicial"]) ? $_GET["fechaInicial"] : null;
            $fechaFinal = isset($_GET["fechaFinal"]) ? $_GET["fechaFinal"] : null;
            $medioPago = isset($_GET["medioPago"]) ? $_GET["medioPago"] : null;
            $formaPago = isset($_GET["formaPago"]) ? $_GET["formaPago"] : null;
            
             // Establecer el valor mínimo (inicia en 700 por defecto)
            $valor_min = isset($_GET["minimo"]) && is_numeric($_GET["minimo"]) ? (int)$_GET["minimo"] : 900;
            
            // Obtener los datos filtrados
            $respuesta = ControladorVentas::filterBy($fechaInicial, $fechaFinal, $medioPago, $formaPago);
            
            // Inicializar el contador
            $contador = 0;
            
            foreach ($respuesta as $key => $value) {
                // Aplicar el límite según el valor mínimo
                if ($contador >= $valor_min) {
                    break; // Detener el bucle si alcanzamos el límite
                }
                
                
              echo '<tr>
              <td>' . ($key + 1) . '</td>
              <td>' . $value["codigo"] . '</td>';

              $respuestaCliente = ControladorClientes::ctrMostrarClientes("id", $value["id_cliente"]);
              echo '<td>' . $respuestaCliente["nombre"] . '</td>';
              $respuestaUsuario = ControladorUsuarios::ctrMostrarUsuarios("id", $value["id_vendedor"]);
              $respuestaUsuario_ab = ControladorUsuarios::ctrMostrarUsuarios("id", $value["id_vend_abono"]);

              if ($value["abono"] != 0) {
                $botones = '<div class="btn-group">
                  
                  <button class="btn btn-info btn-xs btnImprimirFactura" codigoVenta="' . $value["codigo"] . '">
                    <i class="fa fa-print"></i>
                  </button>';
                if ($_SESSION["perfil"] == "Administrador") {
                  $botones .= '<button class="btn btn-warning btn-xs btnEditarVenta" idVenta="' . $value["id"] . '"><i class="fa fa-pencil"></i></button>
                    <button class="btn btn-danger btn-xs btnEliminarVenta" idVenta="' . $value["id"] . '"><i class="fa fa-times"></i></button>';
                }
                $botones .= '<button class="btn btn-primary btn-xs btnAbonar" idVenta="' . $value["id"] . '" idUsuarioAbo="' . $_SESSION["id"] . '" data-toggle="modal" data-target="#modalAbonar" title="Abonar"><i class="fa fa-money"></i></button></div>';
              } else {
                $botones = '<div class="btn-group">
                  
                  <button class="btn btn-info btn-xs btnImprimirFactura" codigoVenta="' . $value["codigo"] . '">
                    <i class="fa fa-print"></i>
                  </button>';
                if ($_SESSION["perfil"] == "Administrador") {
                  $botones .= '<button class="btn btn-warning btn-xs btnEditarVenta" idVenta="' . $value["id"] . '"><i class="fa fa-pencil"></i></button>
                    <button class="btn btn-danger btn-xs btnEliminarVenta" idVenta="' . $value["id"] . '"><i class="fa fa-times"></i></button>';
                }
                if ($_SESSION['perfil'] == 'Vendedor' || $_SESSION['perfil'] == 'Contador' || $_SESSION["perfil"] == "Administrador") {
                  if ($value["metodo_pago"] == 'Se Debe') {
                    $botones .= '<button class="btn btn-primary btn-xs btnAbonar" idVenta="' . $value["id"] . '" idUsuarioAbo="' . $_SESSION["id"] . '" data-toggle="modal" data-target="#modalAbonar" title="Abonar"><i class="fa fa-money"></i></button></div>';
                  }
                }
                $botones .= '</div>';
              }

              echo '<td>' . (isset($respuestaUsuario_ab["empresa"]) ? $respuestaUsuario_ab["empresa"] : '') . '</td>
              <td>' . (isset($respuestaUsuario["nombre"]) ? $respuestaUsuario["nombre"] : '') . '</td>
              <td>' . (isset($respuestaUsuario_ab["nombre"]) ? $respuestaUsuario_ab["nombre"] : '') . '</td>
              <td>' . $value["metodo_pago"] . '</td>
              <td>$ ' . numberFormat($value["neto"], 0) . '</td>
              <td>$ ' . numberFormat($value["total"], 0) . '</td>
              <td>' . $value["fecha_abono"] . '</td>
              <td>$ ' . numberFormat($value["abono"], 0) . '</td>
              <td>$ ' . numberFormat($value["Ult_abono"], 0) . '</td>
              <td>' . $value["pago"] . '</td>
              <td>' . $value["medio_pago"] . '</td>
              <td>' . $botones . '</td>
            </tr>';
                // Incrementa el contador
                $contador++;
            
            }
            ?>
          </tbody>
        </table>
        <?php
        $eliminarVenta = new ControladorVentas();
        $eliminarVenta->ctrEliminarVenta();
        ?>
      </div>
    </div>
     <?php
                        $valor_min = filter_input(INPUT_GET, "minimo", FILTER_VALIDATE_INT, ["options" => ["default" => 900, "min_range" => 1]]);
            ?>
                          <!-- FILTRO MAXIMO DE REGISTROS -->
                  <!-- Formulario con campo de entrada y botón -->
            <div style="margin-bottom: 20px;">
                <form method="GET">
                    <label for="bt_minimo">Filtrar por Items:</label>
                    <input type="number" id="bt_minimo" name="minimo" value="<?php echo $valor_min; ?>" min="1" required style="width: 100px; margin-left: 10px;">
                    <button type="submit" class="btn btn-primary">Filtrar</button>
                </form>
            </div>
            
            <!-- Ajustar el código PHP para manejar el parámetro -->
                  <!-- ..----------------------------- -->
  </section>
</div>

<!-- MODAL AGREGAR ABONO -->
<div id="modalAbonar" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <form role="form" method="post">
        <div class="modal-header" style="background:#3c8dbc; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Agregar Abono</h4>
        </div>
        <div class="modal-body">
          <div class="box-body">
            <div class="form-group">
              <div class="input-group col-xs-12">
                <label>Dinero Restante</label>
                <input type="text" class="form-control dinRestante" disabled>
              </div>
            </div>
            <input type="hidden" class="form-control idUsuarioAbo" name="idUsuarioAbo">
            <input type="hidden" class="form-control idVentaAbo" name="idVentaAbo">
            <div class="form-group">
              <div class="input-group col-xs-12">
                <span class="input-group-addon"><i class="fa fa-money"></i></span>
                <input type="text" class="form-control nuevoAbono" name="nuevoAbono" placeholder="Ingrese Nuevo Abono" required>
              </div>
            </div>
            <div class="form-group">
              <div class="input-group">
                <select class="form-control" id="nuevoMedioPago" name="nuevoMedioPago" required>
                  <option value="">Seleccione medio de pago</option>
                  <?php foreach (MedioPago::ALL as $medio) : ?>
                    <option value="<?= $medio ?>"><?= $medio ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Guardar Abono</button>
        </div>
        <?php
        $crearAbono = new ControladorVentas();
        $crearAbono->ctrCrearAbono();
        ?>
      </form>
    </div>
  </div>
</div>

