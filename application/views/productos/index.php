<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <h4 class="page-title">Productos </h4>
            <ol class="breadcrumb p-0 m-0">
                <li class="breadcrumb-item">
                    <a href="#">Grafiore</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="#">Almacén </a>
                </li>
                <li class="breadcrumb-item active">
                    productos
                </li>
            </ol>
            <div class="clearfix"></div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <div class="card-box table-responsive">
            <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#modal_agregar">Agregar</button>

            <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Producto</th>
                        <th>Precio</th>
                        <th>Stock</th>
                        <th>Categoría</th>
                        <th>Acciones</th>
                    </tr>
                </thead>

                <tbody id="contenido_productos">

                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal -->
<div id="modal_agregar" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title mt-0">Agregar Producto</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="field-3" class="control-label">Nombre</label>
                            <input type="text" class="form-control" name="nombre" id="field-3">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="field-3" class="control-label">Precio</label>
                            <input type="text" class="form-control" name="precio" id="field-3">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="field-3" class="control-label">Tipo</label>
                            <select name="tipo" class="form-control" id="tipo">

                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="1">
                            <label class="form-check-label" for="exampleRadios1">
                                Con stock
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="2">
                            <label class="form-check-label" for="exampleRadios2">
                                Sin stock
                            </label>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-info waves-effect waves-light">Guardar</button>
            </div>
        </div>
    </div>
</div>