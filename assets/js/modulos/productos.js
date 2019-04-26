lista();

$('#datatable').dataTable({
    "language": {
        "url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json"
    }
});

function lista(){
    $.ajax({
        url : './productos/lista',
        type : 'GET',
        success : function(response){
            let productos = JSON.parse(response);
            let indice = 0;
            let template = "";

            productos.forEach(producto => {
                template += `
                    <tr>
                        <td>${indice + 1}</td>
                        <td>${producto.descripcion}</td>
                        <td>${producto.precio}</td>
                        <td>${producto.stock}</td>
                        <td>${producto.nombre}</td>
                        <td>
                            <button type="button" class="btn btn-success"><i class="fa fa-edit"></i></button>
                            <button type="button" class="btn btn-danger"><i class="fa fa-trash-alt"></i></button>
                        </td>
                    </tr>
                `;
                indice ++;
            });

            $("#contenido_productos").html(template);
        }
    });
}

function tipo(){
    $.ajax({
        url : './productos/tipo',
        type : 'GET',
        success : function(response){
            let tipos = JSON.parse(response);
            let template = ``;
            template += `<option value="0">Seleccionar</option>`;
            tipos.forEach(tipo => {
                template += `
                    <option value="${tipo.id_tipo_producto}">${tipo.nombre}</option>
                `;
            });

            $("#tipo").html(template);
        }
    });
}

tipo();