function enviarRegistroUnidadMedida(evt) {
    evt.preventDefault();// Evitamos el submit en nuevos navegadores
    let nombre = document.getElementById("nombre");
    let descripcion = document.getElementById("descripcion");
    if (nombre.value == "") {
        swal({
            title: "Estas seguro que deseas continuar?",
            text: "No has ingresado el nombre de la unidad de medida!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
            .then((willDelete) => {
                if (willDelete) {
                    swal("Procesando informacion!", {
                        timer: 3000,
                    });
                    document.getElementById("registrarUnidadMedida").submit();
                } else {
                    swal("Termina de llenar tu formulario");
                }
            });
    } else {
        document.getElementById("registrarUnidadMedida").submit();
    }
}
function enviarRegistroUnidadMedidaEditar(evt) {
    evt.preventDefault();// Evitamos el submit en nuevos navegadores
    let nombre = document.getElementById("nombreEditar");
    let descripcion = document.getElementById("descripcionEditar");
        if (nombre.value == "" && descripcion.value == "") {
            swal({
                title: "Estas seguro que deseas continuar?",
                text: "No has ingresado el nombre o la descripcion de la unidad de medida!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        swal("Procesando informacion!", {
                            timer: 3000,
                        });
                        document.getElementById("editarUnidadMedida").submit();
                    } else {
                        swal("Termina de llenar tu formulario");
                    }
                });
        } else {
            document.getElementById("editarUnidadMedida").submit();
        }
    }

