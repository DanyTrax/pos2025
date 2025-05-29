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

      Entradas

    </h1>

    <ol class="breadcrumb">

      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li class="active">Entradas</li>

    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">

        <a href="crear-entradas">

          <button class="btn btn-primary">

            Agregar entrada

          </button>

        </a>



        <?php

        if (count($_GET) === 1) {
        ?>
          <a class="btn btn-success" href="vistas/modulos/reporte-entradas.php">
            Reporte Excel
          </a>
        <?php
        }

        if (isset($_GET["fechaInicial"])) {
        ?>
          <a class="btn btn-success" href="vistas/modulos/reporte-entradas.php?fechaInicial=<?= $_GET["fechaInicial"] ?>&fechaFinal=<?= $_GET["fechaFinal"] ?>">
            Reporte Excel
          </a>
        <?php
        }

        if (isset($_GET["medioPago"])) {
        ?>
          <a class="btn btn-success" href="vistas/modulos/reporte-entradas.php?medioPago=<?= $_GET["medioPago"] ?>">
            Reporte Excel
          </a>
        <?php
        }

        ?>


        <?php
        $medioPago = isset($_GET['medioPago']) ? $_GET['medioPago'] : null;
        ?>
        <select class="btn pull-right" name="filter-medioPago-entrada" id="filter-medioPago-entrada" style="margin-left: 10px;">
          <option value="" <?= $medioPago === null ? 'selected' : '' ?>>Medio de Pago</option>
          <option value="">Todos</option>
          <?php foreach (MedioPago::ALL as $value) : ?>
            <option value="<?= $value ?>" <?= $medioPago === $value ? 'selected' : '' ?>><?= $value ?></option>
          <?php endforeach; ?>
        </select>

        <button type="button" class="btn btn-default pull-right" id="daterange-btn-entrada">


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
              <th>Empresa</th>
              <th>Factura</th>
              <th>Fecha</th>
              <th>Descipci&oacute;n</th>
              <th>Valor</th>
              <th>Medio Pago</th>
              <th>Forma Pago</th>
              <th>Acciones</th>

            </tr>

          </thead>

          <tbody>

            <?php
            $fechaInicial = isset($_GET["fechaInicial"]) ? $_GET["fechaInicial"] : null;
            $fechaFinal = isset($_GET["fechaFinal"]) ? $_GET["fechaFinal"] : null;
            $medioPago = isset($_GET["medioPago"]) ? $_GET["medioPago"] : null;

            $respuesta = ControladorContabilidad::filterBy($fechaInicial, $fechaFinal, $medioPago, 'Entrada');
            foreach ($respuesta as $key => $value) {
              $botones = '<div class="btn-group">';
              if ($_SESSION["perfil"] == "Administrador") {
                $botones .= '<button class="btn btn-warning btn-xs btnEditarEntrada" idEntrada="' . $value["id"] . '"><i class="fa fa-pencil"></i></button>';
                $botones .= '<button class="btn btn-danger btn-xs btnEliminarEntrada" idEntrada="' . $value["id"] . '"><i class="fa fa-times"></i></button>';
              }
              $botones .= '</div>';

              $vendedor = ControladorUsuarios::ctrMostrarUsuarios('id', $value["id_vendedor"]);

              echo '<tr>';
              echo '<td>' . ($key + 1) . '</td>';
              echo '<td>' . $vendedor["empresa"] . '</td>';
              echo '<td>' . $value["factura"] . '</td>';
              echo '<td>' . $value["fecha"] . '</td>';
              echo '<td>' . $value["detalle"] . '</td>';
              echo '<td>$ ' . numberFormat($value["valor"]) . '</td>';
              echo '<td>' . $value["medio_pago"] . '</td>';
              echo '<td>' . $value["forma_pago"] . '</td>';
              echo '<td>' . $botones . '</td>';
              echo '</tr>';
            }
            ?>
          </tbody>
        </table>
        <?php
        ControladorContabilidad::deleteEntrada();
        ?>
      </div>
    </div>
  </section>
</div>