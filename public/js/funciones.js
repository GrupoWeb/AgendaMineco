function addEvento(form,link) {
    $(form).submit(function(e){
        e.preventDefault();
        let parametros = $(this).serialize()
        console.log(parametros);
        $.ajax({
            data: parametros,
            url: link,
            type: "post",
            success: function(response){
                console.log(response);
                
                if(response){
                    swal({
                        title: "Eventos",
                        text: "Dato Almacenado!",
                        icon: "success",
                        button: true,
                        dangerMode: false,
                        })
                        limpiarFormulario(form);
                }else{
                    swal({
                        
                        text: "No se puede agregar el Evento!",
                        icon: "error",
                        button: true,
                        dangerMode: false,
                        })
                }
            } 
        })
    })
}

function limpiarFormulario(nombreFormulario) {
    $(nombreFormulario)[0].reset();
}