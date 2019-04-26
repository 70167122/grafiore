$("#form-login").submit(function(e){
    let datos = $(this).serialize();
    
    $.ajax({
        data : datos,
        url : './login/acceso',
        type : 'post',
        success : function(response){
            if(response == 1){
                window.location.href = "./inicio";
            }else{
                console.log("fallido");
            }
        }
    });

    e.preventDefault();
});