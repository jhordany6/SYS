function enviarRegistroSubObra(evt) {
	evt.preventDefault();// Evitamos el submit en nuevos navegadores
	let unidadMedida = document.getElementById("unidadMedida");
	if (unidadMedida.value == "0")  {
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
			}
		});
		return true;
	}else{
		let descripcion = document.getElementById("descripcion");
		if(descripcion.value == ""){
			swal({
				title: "Estas seguro que deseas continuar?",
				text: "No has ingresado la descripcion de tu Sub-Obra!",
				icon: "warning",
				buttons: true,
				dangerMode: true,
			})
			.then((willDelete) => {
				if (willDelete) {
					swal("Procesando informacion!", {
						timer: 3000,
					});
					//document.getElementById("registrarSubObra").submit();
					crearSubObrafn();
				} else {
					swal("Termina de llenar tu formulario");
				}
			});
		}else{
			document.getElementById("registrarSubObra").submit();
			//crearSubObrafn();
		}
	}
}
function enviarRegistroSubObraEditar(evt) {
	evt.preventDefault();// Evitamos el submit en nuevos navegadores
	let unidadMedida = document.getElementById("unidadMedidaEditar");
	if (unidadMedida.value == "0")  {
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
			}
		});
		return true;
	}else{
		let descripcion = document.getElementById("descripcionEditar");
		if(descripcion.value == ""){
			swal({
				title: "Estas seguro que deseas continuar?",
				text: "No has ingresado la descripcion de tu Sub-Obra!",
				icon: "warning",
				buttons: true,
				dangerMode: true,
			})
			.then((willDelete) => {
				if (willDelete) {
					swal("Procesando informacion!", {
						timer: 3000,
					});
					//document.getElementById("editarSubObra").submit();
					editarSubObra();
				} else {
					swal("Termina de llenar tu formulario");
				}
			});
		}else{	
			document.getElementById("editarSubObra").submit();
			//editarSubObra();
		}
	}
}
