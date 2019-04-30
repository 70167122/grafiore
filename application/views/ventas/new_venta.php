<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <h4 class="page-title">Nueva Venta </h4>
            <ol class="breadcrumb p-0 m-0">
                <li class="breadcrumb-item">
                    <a href="#">Grafiore</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="#">Ventas </a>
                </li>
                <li class="breadcrumb-item active">
                    Nueva Venta
                </li>
            </ol>
            <div class="clearfix"></div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <div class="card-box">
            <h4 class="text-center">Registrar nueva venta</h4>
            <div class="row">
                <div class="form-group col-md-3">
                    <label for="exampleFormControlInput1">Tipo de comprobante</label>
                    <select name="tipo_comprobante" id="tipo_comprobante" class="form-control" onchange="comprobante()">
                        <option value="0">Seleccionar</option>
                        <?php foreach ($comprobante as $key => $value) { ?>
                            <option value="<?php echo $value->id_tipo_documento ?>"><?php echo $value->descripcion ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label for="exampleFormControlInput1">Serie</label>
                    <input type="text" name="serie" class="form-control">
                </div>
                <div class="form-group col-md-3">
                    <label for="exampleFormControlInput1">Número</label>
                    <input type="text" name="numero" class="form-control">
                </div>
                <div class="form-group col-md-3">
                    <label for="exampleFormControlInput1">Tipo de documento</label>
                    <select name="documento" id="documento" class="form-control">
                        <option value="0">Seleccionar</option>
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-3">
                    <label for="exampleFormControlInput1">Cliente <i class="fa fa-plus text-success"></i></label>
                    <div class="input-group">
                        <input type="text" name="document" class="form-control" id="documento_buscado" placeholder="Buscar">
                        <span class="input-group-prepend">
                            <button type="button" class="btn waves-effect waves-light btn-primary" id="buscar" onclick="buscar()"><i class="fas fa-search"></i></button>
                        </span>
                    </div>
                </div>
                <div class="form-group col-md-4">
                    <label for="exampleFormControlInput1">Nombre del cliente</label>
                    <input type="text" name="cliente" class="form-control" id="cliente">
                </div>
                <div class="form-group col-md-5">
                    <label for="exampleFormControlInput1">Dirección del cliente</label>
                    <input type="text" name="direccion" class="form-control" id="direccion">
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-4">
                    <label for="exampleFormControlInput1">Tipo de venta</label>
                    <select name="tipo_venta" id="" class="form-control">
                        <option value="0">Seleccionar</option>
                        <?php foreach ($tipo_venta as $key => $value) { ?>
                            <option value="<?php echo $value->id_tipo_venta ?>"><?php echo $value->descripcion ?></option>
                        <?php } ?>
                    </select>         
                </div>
                <div class="form-group col-md-4">
                    <label for="exampleFormControlInput1">Entrega</label>
                    <select name="entrega" id="" class="form-control">
                        <option value="0">Seleccionar</option>
                        <option value="1">Por entregar</option>
                        <option value="2">Entregado</option>
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label for="exampleFormControlInput1">Buscar producto</label>
                    <button type="button" class="btn btn-success form-control" id="buscar_producto" onclick="buscar_producto()">Buscar <i class="fa fa-search"></i></button>
                </div>
            </div>
            <h4>DETALLE DE LA VENTA</h4>
            <div class="row">
                <div class="col-md-12 table-responsive">
                    <table class="table" id="detalle">
                        <thead>
                            <tr>
                                <th style="width:150px">CANT</th>
                                <th>PRODUCTO</th>
                                <th>DESCRIPCIÓN</th>
                                <th style="width:100px">PRECIO</th>
                                <th>IMPORTE</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="content_detalle">
                            
                        </tbody>
                    </table>
                </div>

                <div class="col-md-9 m-t-15">
                    
                </div>
                <div class="col-md-3 m-t-15">
                    <table class="table">
                        <tbody>
                            <tr>
                                <th>Subtotal:</th>
                                <td class="text-center" id="subtotal">150</td>
                            </tr>
                            <tr>
                                <th>IGV:</th>
                                <td class="text-center">0</td>
                            </tr>
                            <tr>
                                <th>TOTAL:</th>
                                <th class="text-center" id="total">150</th>
                            </tr>
                        </tbody>
                    </table>
                    <button type="button" class="btn btn-success btn-block">GUARDAR VENTA</button>
                    <button type="button" class="btn btn-danger btn-block" onclick="regresar()">CANCELAR</button>
                </div>
                         
            </div>

        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modal_producto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" style="width:55%; max-width: none;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Buscar Producto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-sm" id="products">
                        <thead>
                            <tr>
                                <th>Producto</th>
                                <th>Precio</th>
                                <th>Stock</th>
                                <th>Elegir</th>
                            </tr>
                        </thead>
                        <tbody id="carga_productos">
                           
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<script>
    $('#products').dataTable({
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json"
        }
    });
</script>
