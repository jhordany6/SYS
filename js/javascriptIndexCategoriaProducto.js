function enviarRegistroCategoriaProducto(evt) {
    evt.preventDefault();// Evitamos el submit en nuevos navegadores
    let nombre = document.getElementById("nombre");
    if (nombre.value == "") {
        swal({
            title: "Estas seguro que deseas continuar?",
            text: "No has ingresado el nombre de la categoria tarea!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
            .then((willDelete) => {
                if (willDelete) {
                    swal("Procesando informacion!", {
                        timer: 3000,
                    });
                    document.getElementById("registrarCategoriaProducto").submit();
                } else {
                    swal("Termina de llenar tu formulario");
                }
            });
    } else {
        document.getElementById("registrarCategoriaProducto").submit();
    }
}
function enviarRegistroCategoriaProductoEditar(evt) {
    evt.preventDefault();// Evitamos el submit en nuevos navegadores
    let nombre = document.getElementById("nombreEditar");
        if (nombre.value == "" && descripcion.value == "") {
            swal({
                title: "Estas seguro que deseas continuar?",
                text: "No has ingresado el nombre o la descripcion de la categoria tarea",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        swal("Procesando informacion!", {
                            timer: 3000,
                        });
                        document.getElementById("editarCategoriaProducto").submit();
                    } else {
                        swal("Termina de llenar tu formulario");
                    }
                });
        } else {
            document.getElementById("editarCategoriaProducto").submit();
        }
    }

