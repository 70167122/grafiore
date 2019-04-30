<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <h4 class="page-title">Clientes </h4>
            <ol class="breadcrumb p-0 m-0">
                <li class="breadcrumb-item">
                    <a href="#">Grafiore</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="#">Ventas </a>
                </li>
                <li class="breadcrumb-item active">
                    clientes
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
                        <th>Cliente</th>
                        <th># documento</th>
                        <th>Dirección</th>
                        <th>Teléfono</th>
                        <th>Email</th>
                        <th>Acciones</th>
                    </tr>
                </thead>

                <tbody id="contenido_clientes">
                    
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Agregar-->
<div class="modal fade" id="modal_agregar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Agregar Cliente</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form-agregar" method="post">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Tipo Documento</label>
                                <select name="tipo_documento" id="tipo_documento" class="form-control">
                                    <?php foreach ($tipo as $key => $value) { ?>
                                        <option value="<?php echo $value->id_identidad ?>"><?php echo $value->descripcion ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Número Documento</label>
                                <input type="text" class="form-control" name="numero_documento" required>
                            </div>
                        </div>
                    </div>
                    <div class="row" id="de_acuerdo_documento">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Nombres</label>
                                <input type="text" class="form-control" name="nombres" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Apellidos</label>
                                <input type="text" class="form-control" name="apellidos" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Dirección</label>
                                <input type="text" class="form-control" name="direccion" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Teléfono</label>
                                <input type="text" class="form-control" name="telefono" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Email</label>
                                <input type="text" class="form-control" name="email" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>