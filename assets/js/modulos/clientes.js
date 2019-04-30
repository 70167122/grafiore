clientes();

$('#datatable').dataTable({
    "language": {
        "url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json"
    }
});

function clientes(){
    $.ajax({
        url : './clientes/lista',
        type : 'GET',
        success : function(response){
            let clientes = JSON.parse(response);
            console.log(clientes);
            let indice = 0;
            let template = "";
            clientes.forEach(cliente => {
                template = `
                <tr>
                    <td>${indice + 1}</td>
                    <td>${cliente.nombres} ${cliente.apellidos}</td>
                    <td>${cliente.documento_identidad}</td>
                    <td>${cliente.direccion}</td>
                    <td>${cliente.telefono}</td>
                    <td>${cliente.email}</td>
                    <td>
                        <button type="button" class="btn btn-success"><i class="fa fa-edit"></i></button>
                        <button type="button" class="btn btn-danger"><i class="fa fa-trash-alt"></i></button>
                    </td>
                </tr>
                `;
                indice++;
            });

            document.getElementById("contenido_clientes").innerHTML = template;
        }
    });
}

$("#tipo_documento").change(function(){
    let tipo = $(this).val();
    if (tipo == 1) {
        let html = `
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
        `;
        $("#de_acuerdo_documento").html(html);
    }else{
        let html = `
            <div class="col-md-12">
                <div class="form-group">
                    <label for="exampleFormControlInput1">Razón social</label>
                    <input type="text" class="form-control" name="razon" required>
                </div>
            </div>
        `;

        $("#de_acuerdo_documento").html(html);
    }
});

$("#form-agregar").submit(function(e){
    let datos = $(this).serialize();

    $.post("./clientes/add",datos,function(response){
        if (response == 1) {
            alert("Se agrego correctamente");
            $("#modal_agregar").modal("hide");
            clientes();
        }else{
            alert("hubo un error al insertar");
        }
    });

    e.preventDefault();
});