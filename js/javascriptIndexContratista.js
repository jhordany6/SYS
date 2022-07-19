function enviarRegistroContratista(evt) {
	evt.preventDefault();// Evitamos el submit en nuevos navegadores
	let nombre = document.getElementById("nombre");
	let codigoIdentificacion = document.getElementById("codigoIdentificacion");
	if (nombre.value == "" || codigoIdentificacion.value == "" )  {
		swal({
			title: "Faltan datos por completar",
			text: "Ingresa todos los campos requeridos",
			icon: "warning",
			buttons: true,
			dangerMode: true,
		})
		.then((willDelete) => {
			if (willDelete) {
				if(nombre.value == ""){nombre.focus();}
				if(codigoIdentificacion.value == ""){codigoIdentificacion.focus();}
			}
		});
		return true;
	}else{
		let codigoIdentificacion = document.getElementById("codigoIdentificacion");
		if(descripcion.value == ""){
			swal({
				title: "Estas seguro que deseas continuar?",
				text: "No has ingresado la descripcion de tu producto!",
				icon: "warning",
				buttons: true,
				dangerMode: true,
			})
			.then((willDelete) => {
				if (willDelete) {
					swal("Procesando informacion!", {
						timer: 3000,
					});
					document.getElementById("registrarContratista").submit();
				} else {
					swal("Termina de llenar tu formulario");
				}
			});
		}else{
			document.getElementById("registrarContratista").submit();
		}
	}
}
function enviarRegistroProductoEditar(evt) {
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
				text: "No has ingresado la descripcion de tu producto!",
				icon: "warning",
				buttons: true,
				dangerMode: true,
			})
			.then((willDelete) => {
				if (willDelete) {
					swal("Procesando informacion!", {
						timer: 3000,
					});
					document.getElementById("editarProducto").submit();
				} else {
					swal("Termina de llenar tu formulario");
				}
			});
		}else{
			document.getElementById("editarProducto").submit();
		}
	}
}
