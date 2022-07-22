function enviarRegistroTarea(evt) {
	evt.preventDefault();// Evitamos el submit en nuevos navegadores
	let unidadMedida = document.getElementById("unidadMedida");
	let categoriaProducto = document.getElementById("categoriaProducto");
	if (unidadMedida.value == "0" || categoriaProducto.value == "0" )  {
		swal({
			title: "Faltan datos por completar",
			text: "Ingresa todos los campos requeridos",
			icon: "warning",
			buttons: true,
			dangerMode: true,
		})
		.then((willDelete) => {
			if (willDelete) {
				if(unidadMedida.value == "0"){unidadMedida.focus();}
				if(categoriaProducto.value == "0"){categoriaProducto.focus();}
			}
		});
		return true;
	}else{
		let descripcion = document.getElementById("descripcion");
		if(descripcion.value == ""){
			swal({
				title: "Estas seguro que deseas continuar?",
				text: "No has ingresado la descripcion de tu tarea!",
				icon: "warning",
				buttons: true,
				dangerMode: true,
			})
			.then((willDelete) => {
				if (willDelete) {
					swal("Procesando informacion!", {
						timer: 3000,
					});
					document.getElementById("registrarTarea").submit();
				} else {
					swal("Termina de llenar tu formulario");
				}
			});
		}else{
			document.getElementById("registrarTarea").submit();
		}
	}
}
function enviarRegistroTareaEditar(evt) {
	evt.preventDefault();// Evitamos el submit en nuevos navegadores
	let unidadMedida = document.getElementById("unidadMedidaEditar");
	let categoriaProducto = document.getElementById("categoriaProductoEditar");
	if (unidadMedida.value == "0" || categoriaProducto.value == "0" )  {
		swal({
			title: "Faltan datos por completar",
			text: "Ingresa todos los campos requeridos",
			icon: "warning",
			buttons: true,
			dangerMode: true,
		})
		.then((willDelete) => {
			if (willDelete) {
				if(unidadMedida.value == "0"){unidadMedida.focus();}
				if(categoriaProducto.value == "0"){categoriaProducto.focus();}
			}
		});
		return true;
	}else{
		let descripcion = document.getElementById("descripcionEditar");
		if(descripcion.value == ""){
			swal({
				title: "Estas seguro que deseas continuar?",
				text: "No has ingresado la descripcion de tu tarea!",
				icon: "warning",
				buttons: true,
				dangerMode: true,
			})
			.then((willDelete) => {
				if (willDelete) {
					swal("Procesando informacion!", {
						timer: 3000,
					});
					document.getElementById("editarTarea").submit();
				} else {
					swal("Termina de llenar tu formulario");
				}
			});
		}else{
			document.getElementById("editarTarea").submit();
		}
	}
}
