categorias();

$('#datatable').dataTable({
    "language": {
        "url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json"
    }
});

function categorias(){
    $.ajax({
        url : "./categorias/lista",
        type : "GET",
        success : function(response){
            let categorys = JSON.parse(response);
            let template = "";
            let indice = 0;
            categorys.forEach(category => {
                template += `
                    <tr>
                        <td>${indice + 1}</td>
                        <td>${category.nombre}</td>
                        <td>
                            <button type="button" class="btn btn-success">Editar</button>
                            <button type="button" class="btn btn-danger">Eliminar</button>
                        </td>
                    </tr>
                `;
                indice ++;
            });
    
            $("#contenido_categorias").html(template);
        }
    });
}

$("#form-agregar").submit(function(e){
    let datos = $(this).serialize();
    $.post('./categorias/add',datos,function(response){
        if (response == 1) {
            $("#modal_agregar").modal('hide');
            categorias();
        }else{
            console.log("hubo un error");
        }
    });

    e.preventDefault();
});

