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
        document.getElementById("documento_buscado").removeAttribute("readonly");
         
    }else{
        document.getElementById("documento_buscado").removeAttribute("readonly");
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
                        document.getElementById("documento_identidad").value = respuesta.datos.id_cliente;
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
                <td contenteditable="true" class="cantidad" onkeyup="cantidad(this)">1</td>
                <td class="producto">${producto.descripcion}</td>
                <td contenteditable="true" class="descripcion">grupo grafiore</td>
                <td contenteditable="true" class="price" onkeyup="precio(this)">${producto.precio}</td>
                <td class="importe">${producto.precio}</td>
                <td><button type="button" class="btn btn-danger btn-sm delete" onclick="delete_detalle(this)"><i class=" mdi mdi-delete"></i></button></td>
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

function cantidad(t){
    var quanty = parseInt(t.innerHTML);
    var price = parseFloat(t.parentElement.querySelector(".price").innerHTML);
    var importe = t.parentElement.querySelector(".importe");

    var multi = quanty*price;
    importe.innerHTML = multi;
    sumar_importe();
}

function precio(t){
    var price = parseInt(t.innerHTML);
    var quanty = parseFloat(t.parentElement.querySelector(".cantidad").innerHTML);
    var importe = t.parentElement.querySelector(".importe");

    var multi = quanty*price;
    importe.innerHTML = multi;
    sumar_importe();
}



function add_customer(){
    let documento = document.getElementById("documento").value;

    if (documento == 0) {
        alert("Seleccionar documento");
    }else{
        if (documento == 1) {
            var template = `
                <div class="form-group col-md-3">
                    <label for="exampleFormControlInput1">Cliente</label>
                    <div class="input-group">
                        <input type="text" name="document" class="form-control" id="documento_buscado" placeholder="DNI">
                        
                    </div>
                </div>
                <div class="form-group col-md-3">
                    <label for="exampleFormControlInput1">Nombre del cliente</label>
                    <input type="text" name="cliente" class="form-control" id="cliente">
                </div>
                <div class="form-group col-md-3">
                    <label for="exampleFormControlInput1">Apellidos del cliente</label>
                    <input type="text" name="apellidos" class="form-control" id="apellidos">
                </div>
                <div class="form-group col-md-3">
                    <label for="exampleFormControlInput1">Dirección del cliente</label>
                    <input type="text" name="direccion" class="form-control" id="direccion">
                </div>
                <div class="form-group col-md-3">
                    <label for="exampleFormControlInput1">Teléfono del cliente</label>
                    <input type="text" name="telefono" class="form-control" id="telefono">
                </div>
                <div class="form-group col-md-3">
                    <label for="exampleFormControlInput1">Email del cliente</label>
                    <input type="text" name="email" class="form-control" id="email">
                </div>
                <div class="form-group col-md-3">
                    <label for="exampleFormControlInput1">Guardar datos del cliente</label>
                    <button type="button" class="btn btn-primary form-control" onclick="guardar_cliente()">GUARDAR</button>
                </div>
                <div class="form-group col-md-3">
                    <label for="exampleFormControlInput1">Cancelar</label>
                    <button type="button" class="btn btn-danger form-control" onclick="cancelar_add()">CANCELAR</button>
                </div>
            `;

            document.getElementById("form_cliente").innerHTML = template;
        }
    }
}

function guardar_cliente(){
    var tipo_documento = document.getElementById("documento").value;
    var numero_documento = document.getElementById("documento_buscado").value;
    var nombres = document.getElementById("cliente").value;
    var apellidos = document.getElementById("apellidos").value;
    var direccion = document.getElementById("direccion").value;
    var telefono = document.getElementById("telefono").value;
    var email = document.getElementById("email").value;

    if (numero_documento == "") {
        alert("Agregar dni");
        return false;
    }

    if (nombres == "") {
        alert("Agregar nombres");
        return false;
    }

    if (apellidos == "") {
        alert("Agregar apellidos");
        return false;
    }

    var datos = {numero_documento:numero_documento,nombres:nombres,apellidos:apellidos,direccion:direccion,telefono:telefono,email:email,tipo_documento:tipo_documento};

    $.post("clientes/add",datos,function(response){
        let datos = JSON.parse(response);
        if (datos.ok == 1) {
            let formulario = `
            <input type="hidden" name="documento_identidad" id="documento_identidad" value="${datos.id}">
            <div class="form-group col-md-3">
                <label for="exampleFormControlInput1">Cliente <i class="fa fa-plus text-success add_customer" onclick="add_customer()"></i></label>
                <div class="input-group">
                    <input type="text" name="document" class="form-control" id="documento_buscado" value="${numero_documento}">
                    <span class="input-group-prepend">
                        <button type="button" class="btn waves-effect waves-light btn-primary" id="buscar" onclick="buscar()"><i class="fas fa-search"></i></button>
                    </span>
                </div>
            </div>
            <div class="form-group col-md-4">
                <label for="exampleFormControlInput1">Nombre del cliente</label>
                <input type="text" name="cliente" class="form-control" id="cliente" value="${nombres} ${apellidos}">
            </div>
            <div class="form-group col-md-5">
                <label for="exampleFormControlInput1">Dirección del cliente</label>
                <input type="text" name="direccion" class="form-control" id="direccion" value="${direccion}">
            </div>
            `;
            document.getElementById("form_cliente").innerHTML = formulario;

        }else{
            alert("hubo un error al guardar");
        }
    });

}

function delete_detalle(t){
    var padre = t.parentElement.parentElement;
    padre.remove();
    sumar_importe();
}

function cancelar_add(){
    var template = `
        <input type="hidden" name="documento_identidad" id="documento_identidad">
        <div class="form-group col-md-3">
            <label for="exampleFormControlInput1">Cliente <i class="fa fa-plus text-success add_customer" onclick="add_customer()"></i></label>
            <div class="input-group">
                <input type="text" name="document" class="form-control" id="documento_buscado" placeholder="Buscar">
                <span class="input-group-prepend">
                    <button type="button" class="btn waves-effect waves-light btn-primary" id="buscar" onclick="buscar()"><i class="fas fa-search"></i></button>
                </span>
            </div>
        </div>
        <div class="form-group col-md-4">
            <label for="exampleFormControlInput1">Nombre del cliente</label>
            <input type="text" name="cliente" class="form-control" id="cliente" readonly="">
        </div>
        <div class="form-group col-md-5">
            <label for="exampleFormControlInput1">Dirección del cliente</label>
            <input type="text" name="direccion" class="form-control" id="direccion" readonly="">
        </div>
    `;

    document.getElementById("form_cliente").innerHTML = template;

}

function guardar_venta(){
    var total = document.getElementById("total").innerHTML;
    var documento = document.getElementById("documento_buscado").value;
    var tipo_venta = document.getElementById("tipo_venta").value;
    var entrega = document.getElementById("entrega").value;
    var comprobante = document.getElementById("tipo_comprobante").value;
    var serie = document.getElementById("serie").value;
    var numero = document.getElementById("numero").value;
    var documento_identidad = document.getElementById("documento_identidad").value;

    if (total == 0) {
        alert("NO PUEDE REALIZAR LA VENTA CON UN MONTO CERO");
        return false;
    }
    
    if (comprobante == 0) {
        alert("Seleccionar un tipo de comprobante");
        return false;
    }

    if (comprobante != 3) {
        if (serie == "") {
            alert("Agregar una serie para el comprobante");
            return false;
        }

        if (numero == "") {
            alert("Agregar un número para el comprobante");
            return false;
        }   

    }

    if (documento == "") {
        alert("Buscar el documento de identidad del cliente");
        return false;
    }

    if (tipo_venta == 0) {
        alert("Seleccionar un tipo de venta");
        return false;
    }

    if (entrega == 0) {
        alert("Seleccionar una entrega");
        return false;
    }

    var contenido = document.getElementById("content_detalle");
    var longitud = contenido.rows.length;
    var detalle = [];
    var idproducto = [];
    
    for (let i = 0; i < longitud; i++) {
        var c = [];
        var fila = contenido.rows[i];
        var atributo = fila.getAttribute("data-item");
        idproducto.push(atributo);
        celda = fila.getElementsByTagName("td");

        for (let j = 0; j < celda.length -1; j++) {
            var textCelda = celda[j].innerHTML;
            c.push(textCelda);
            
        }
        detalle.push(c);
    }
    
    var datos = {
        total:total,
        serie:serie,
        numero:numero,
        documento_identidad:documento_identidad,
        tipo_venta:tipo_venta,
        comprobante:comprobante,
        entrega:entrega,
        detalle:detalle,
        idproducto:idproducto
    };

    $.post("./ventas/agregar",datos,function(response){
        if (response == 1) {
            window.location.href = "./ventas";
        }else{
            alert("hubo un error al guardar la venta");
        }
    });

}