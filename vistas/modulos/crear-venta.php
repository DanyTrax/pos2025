<?php
if ($_SESSION["perfil"] == "Especial") {
    echo '<script>
        window.location = "inicio";
    </script>';
    return;
}
?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>Crear venta</h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li class="active">Crear venta</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-lg-7 col-xs-12">
                <div class="box box-success">
                    <div class="box-header with-border"></div>
                    <form role="form" method="post" class="formularioVenta">
                        <div class="box-body">
                            <div class="box">
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                        <input type="text" class="form-control" id="nuevoVendedor" value="<?php echo $_SESSION["nombre"]; ?>" readonly>
                                        <input type="hidden" name="idVendedor" value="<?php echo $_SESSION["id"]; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                        <?php
                                        $item = null;
                                        $valor = null;
                                        $ventas = ControladorVentas::ctrMostrarVentas($item, $valor);
                                        if (!$ventas) {
                                            echo '<input type="text" class="form-control" id="nuevaVenta" name="nuevaVenta" value="10001" readonly>';
                                        } else {
                                            foreach ($ventas as $key => $value) {
                                            }
                                            $codigo = $value["codigo"] + 1;
                                            echo '<input type="text" class="form-control" id="nuevaVenta" name="nuevaVenta" value="' . $codigo . '" readonly>';
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-users"></i></span>
                                        <select class="form-control" id="seleccionarCliente" name="seleccionarCliente" required>
                                            <option value="">Seleccionar cliente</option>
                                            <?php
                                            $item = null;
                                            $valor = null;
                                            $categorias = ControladorClientes::ctrMostrarClientes($item, $valor);
                                            foreach ($categorias as $key => $value) {
                                                echo '<option value="' . $value["id"] . '">' . $value["nombre"] . '</option>';
                                            }
                                            ?>
                                        </select>
                                        <span class="input-group-addon"><button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#modalAgregarCliente" data-dismiss="modal">Agregar cliente</button></span>
                                    </div>
                                </div>
                                <div class="form-group row nuevoProducto"></div>
                                <input type="hidden" id="listaProductos" name="listaProductos">
                                <button type="button" class="btn btn-default hidden-lg btnAgregarProducto">Agregar producto Lista</button>
                                <button type="button" class="btn btn-default  btnAgregarProducto1">Agregar producto</button>
                                <hr>
                                <div class="row">
                                    <div class="col-xs-12 pull-right">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Impuesto</th>
                                                    <th>Descuento</th>
                                                    <th>Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td style="width: 33%">
                                                        <div class="input-group">
                                                            <input type="number" class="form-control input-lg" min="0" id="nuevoImpuestoVenta" name="nuevoImpuestoVenta" value="0" required>
                                                            <input type="hidden" name="nuevoPrecioImpuesto" id="nuevoPrecioImpuesto" required>
                                                            <input type="hidden" name="nuevoPrecioNeto" id="nuevoPrecioNeto" required>
                                                            <span class="input-group-addon"><i class="fa fa-percent"></i></span>
                                                        </div>
                                                    </td>
                                                    <td style="width: 33%">
                                                        <div class="input-group">
                                                            <input type="number" class="form-control input-lg" min="0" id="nuevoDescuentoVenta" name="nuevoDescuentoVenta" value="0" required>
                                                            <input type="hidden" name="nuevoPrecioDescuento" id="nuevoPrecioDescuento" required>
                                                            <span class="input-group-addon"><i class="fa fa-percent"></i></span>
                                                        </div>
                                                    </td>
                                                    <td style="width: 33%">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>
                                                            <input type="text" class="form-control input-lg" id="nuevoTotalVenta" name="nuevoTotalVenta" total="" placeholder="00000" readonly required>
                                                            <input type="hidden" name="totalVenta" id="totalVenta">
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group">
                                    <label for="basic-url">Nota</label>
                                    <div class="input-group">
                                        <span class="input-group-addon" id="basic-addon3">Detalle o Descripción</span>
                                        <textarea class="form-control" aria-label="With textarea" id="detalle" name="detalle"></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-xs-6">
                                        <div class="input-group">
                                            <select class="form-control" id="nuevoMetodoPago" name="nuevoMetodoPago" required>
                                                <option value="">Seleccione método de pago</option>
                                                <option value="Completo">Completo</option>
                                                <option value="Abono">Abono</option>
                                                <option value="Se Debe">Se Debe</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 divNuevoMetodoPago" required></div>
                                    <div class="col-xs-12 cajasMetodoPago" style="padding-top: 10px; padding-left: 0;"></div>
                                </div>
                                <br>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary pull-right">Guardar venta</button>
                        </div>
                    </form>
                    <?php
                    $guardarVenta = new ControladorVentas();
                    $guardarVenta->ctrCrearVenta();
                    ?>
                </div>
            </div>
            <div class="col-lg-5 hidden-md hidden-sm hidden-xs">
                <div class="box box-warning">
                    <div class="box-header with-border"></div>
                    <div class="box-body">
                        <table class="table table-bordered table-striped dt-responsive tablaVentas">
                            <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Imagen</th>
                                    <th>Código</th>
                                    <th>Descripcion</th>
                                    <th>Stock</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!--=====================================
MODAL AGREGAR CLIENTE
======================================-->
<div id="modalAgregarCliente" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form role="form" method="post">
                <div class="modal-header" style="background:#3c8dbc; color:white">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Agregar cliente</h4>
                </div>
                <div class="modal-body">
                    <div class="box-body">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                <input type="text" class="form-control input-lg" name="nuevoCliente" placeholder="Ingresar nombre" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                <input type="number" min="0" class="form-control input-lg" name="nuevoDocumentoId" placeholder="Ingresar documento" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                <input type="email" class="form-control input-lg" name="nuevoEmail" placeholder="Ingresar email" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                <input type="text" class="form-control input-lg" name="nuevoTelefono" placeholder="Ingresar teléfono" data-inputmask="'mask':'(999) 999-9999'" data-mask required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                                <input type="text" class="form-control input-lg" name="nuevaDireccion" placeholder="Ingresar dirección" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
                    <button type="submit" class="btn btn-primary">Guardar cliente</button>
                </div>
            </form>
            <?php
            $crearCliente = new ControladorClientes();
            $crearCliente->ctrCrearCliente();
            ?>
        </div>
    </div>
</div>