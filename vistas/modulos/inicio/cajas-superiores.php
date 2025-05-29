<?php

$item = null;
$valor = null;
$orden = "id";

$ventas = ControladorVentas::ctrSumaTotalVentas();
$ventas1 = ControladorVentas::ctrSumaTotalVentas1();
$ventas2 = ControladorVentas::ctrSumaTotalVentas2();
$ventas3 = ControladorVentas::ctrSumaTotalVentas3();


$clientes = ControladorClientes::ctrMostrarClientes($item, $valor);
$totalClientes = count($clientes);

//$productos = ControladorProductos::ctrMostrarProductos($item, $valor, $orden);
//$totalProductos = count($productos);

$totalEntradas = ControladorContabilidad::sumEntradas();
$totalEntradasEfectivo = ControladorContabilidad::sumEntradasBy();
$totalGastos = ControladorContabilidad::sumGastos();
$totalGastosEfectivo =  ControladorContabilidad::sumGastosBy();

?>



<div class="col-lg-3 col-xs-6">

  <div class="small-box bg-aqua">

    <div class="inner">

      <h3>$<?php echo numberFormat($ventas["total"], 2, ',', '.'); ?></h3>

      <p>Ventas Infinito</p>

    </div>

    <div class="icon">

      <i class="ion ion-social-usd"></i>

    </div>

    <a href="ventas" class="small-box-footer">

      Más info <i class="fa fa-arrow-circle-right"></i>

    </a>

  </div>

</div>

<div class="col-lg-3 col-xs-6">

  <div class="small-box bg-green">

    <div class="inner">

      <h3>$<?= numberFormat($totalEntradasEfectivo - $totalGastosEfectivo, 2, ',', '.'); ?></h3>

      <p>Arqueo de efectivo</p>

    </div>

    <div class="icon">

      <i class="ion ion-social-usd"></i>

    </div>

    <a href="ventas" class="small-box-footer">

      Más info <i class="fa fa-arrow-circle-right"></i>

    </a>

  </div>

</div>

<div class="col-lg-3 col-xs-6">

  <div class="small-box bg-red">

    <div class="inner">

      <h3>$<?php echo numberFormat($ventas2["total"], 2, ',', '.'); ?></h3>

      <p>Ventas Epico</p>

    </div>

    <div class="icon">

      <i class="ion ion-social-usd"></i>

    </div>

    <a href="ventas" class="small-box-footer">

      Más info <i class="fa fa-arrow-circle-right"></i>

    </a>

  </div>

</div>

<div class="col-lg-3 col-xs-6">


  <div class="small-box bg-yellow">

    <div class="inner">

      <h3>$<?php echo numberFormat($ventas3["total"], 2, ',', '.'); ?></h3>

      <p>Total Ventas</p>

    </div>

    <div class="icon">

      <i class="ion ion-bank"></i>

    </div>

    <a href="clientes" class="small-box-footer">

      Más info <i class="fa fa-arrow-circle-right"></i>

    </a>

  </div>

</div>



<div class="col-lg-3 col-xs-6">

  <div class="small-box bg-yellow">

    <div class="inner">

      <h3>$<?= numberFormat($totalEntradas, 2, ',', '.'); ?></h3>

      <p>Total Entradas</p>

    </div>

    <div class="icon">

      <i class="ion ion-social-usd"></i>

    </div>

    <a href="ventas" class="small-box-footer">

      Más info <i class="fa fa-arrow-circle-right"></i>

    </a>

  </div>

</div>

<div class="col-lg-3 col-xs-6">

  <div class="small-box bg-red">

    <div class="inner">

      <h3>$<?= numberFormat($totalEntradasEfectivo, 2, ',', '.'); ?></h3>

      <p>Total Entradas Efectivo</p>

    </div>

    <div class="icon">

      <i class="ion ion-social-usd"></i>

    </div>

    <a href="ventas" class="small-box-footer">

      Más info <i class="fa fa-arrow-circle-right"></i>

    </a>

  </div>

</div>

<div class="col-lg-3 col-xs-6">

  <div class="small-box bg-green">

    <div class="inner">

      <h3>$<?= numberFormat($totalGastos, 2, ',', '.'); ?></h3>

      <p>Total Gastos</p>

    </div>

    <div class="icon">

      <i class="ion ion-social-usd"></i>

    </div>

    <a href="ventas" class="small-box-footer">

      Más info <i class="fa fa-arrow-circle-right"></i>

    </a>

  </div>

</div>

<div class="col-lg-3 col-xs-6">


  <div class="small-box bg-blue">

    <div class="inner">

      <h3>$<?= numberFormat($totalGastosEfectivo, 2, ',', '.'); ?></h3>

      <p>Total Gastos Efectivo</p>

    </div>

    <div class="icon">

      <i class="ion ion-bank"></i>

    </div>

    <a href="clientes" class="small-box-footer">

      Más info <i class="fa fa-arrow-circle-right"></i>

    </a>

  </div>

</div>