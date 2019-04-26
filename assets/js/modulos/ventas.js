$('#datatable').dataTable({
    "language": {
        "url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json"
    }
});

$("#view_agregar_venta").click(function(){
    $.ajax({
        url : './ventas/new_venta',
        type : 'post',
        success : function(response){
            $("#contenido").html(response);
        }
    });
});