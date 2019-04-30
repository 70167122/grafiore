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

function regresar(){
    window.location.href = "./ventas";
}

function comprobante(){
    let id = document.getElementById("tipo_comprobante").value;
    
    if (id == 1) {
        let html = `<option value="1">RUC</option>`;
        document.getElementById("documento").innerHTML = html;  
    }else{
        $.ajax({
            url : './ventas/documento',
            type : 'GET',
            success : function(response){
                document.getElementById("documento").innerHTML = response; 
            }
        });
    }
}

function buscar(){
    let documento = document.getElementById("documento").value;
    
    if (documento == 0) {
        alert("Seleccionar documento");
    }else{
        let buscar = document.getElementById("documento_buscado").value;
        if (buscar == "") {
            alert("Escribir documento");
        }else{
            let datos = {buscar:buscar};
            $.ajax({
                data : datos,
                url : './ventas/cliente_buscar',
                type : 'post',
                success : function(response){
                    respuesta = JSON.parse(response);
                    if (respuesta.mensaje == "ok") {
                        document.getElementById("cliente").value = respuesta.datos.nombres + " " + respuesta.datos.apellidos;
                        document.getElementById("direccion").value = respuesta.datos.direccion;
                    }else{
                        alert(respuesta.mensaje);
                    }
                }
            });
        }
    }
}

function buscar_producto(){
    $("#modal_producto").modal("show");
    $.ajax({
        url : './ventas/traer_productos',
        type : 'GET',
        success : function(response){
            let productos = JSON.parse(response);
            let template = "";
            productos.forEach(producto => {
                if (producto.condicion == 0) {
                    var stock = "sin stock";
                }else{
                    var stock = producto.stock;
                }

                if ((producto.stock > 0 && producto.condicion == 1) || (producto.stock == 0 && producto.condicion == 0) ) {
                    var accion = "<button type='button' class='btn btn-primary btn-sm' onclick='agregar_producto_detalle("+producto.id_producto+")'><i class='fa fa-plus'></i></button>";
                }else{
                    var accion = "<button type='button' class='btn btn-danger btn-sm'><i class='fa fa-minus'></i></button>";
                }
                

                template += "<tr>";
                template += "<td>"+producto.descripcion+"</td>";
                template += "<td>"+producto.precio+"</td>";
                template += "<td>"+stock+"</td>";
                template += "<td>"+accion+"</td>";
                template += "</tr>";
            });

            $("#carga_productos").html(template);
        }
    });
}

function agregar_producto_detalle(id_producto){
    $.post("./ventas/producto",{id_producto:id_producto},function(response){
        let producto = JSON.parse(response);
        let template = "";
        template += `
            <tr data-item="${producto.id_producto}">
                <td contenteditable="true" onkeyup="cantidad()" class="cantidad">1</td>
                <td>${producto.descripcion}</td>
                <td contenteditable="true">grupo grafiore</td>
                <td contenteditable="true">${producto.precio}</td>
                <td class="importe">${producto.precio}</td>
                <td><button type="button" class="btn btn-danger btn-sm"><i class=" mdi mdi-delete"></i></button></td>
            </tr>
        `;

        $("#content_detalle").append(template);

        sumar_importe();
    });
}

function sumar_importe(){
    var total = 0;
    $(".importe").each(function(){
        total += parseInt($(this).html()) || 0;
    });

    $("#subtotal").html(total);
    $("#total").html(total);
}

function cantidad(){
    var clase = document.getElementsByClassName("cantidad").innerHTML;
    console.log(clase);
}