<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <h4 class="page-title">Categorías </h4>
            <ol class="breadcrumb p-0 m-0">
                <li class="breadcrumb-item">
                    <a href="#">Grafiore</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="#">Almacén </a>
                </li>
                <li class="breadcrumb-item active">
                    categorías
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
                        <th>Descripción</th>
                        <th>Acciones</th>
                    </tr>
                </thead>

                <tbody id="contenido_categorias">

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
                <h5 class="modal-title" id="exampleModalLabel">Agregar Categoría</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form-agregar" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Descripción</label>
                        <input type="text" class="form-control" name="descripcion" require>
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