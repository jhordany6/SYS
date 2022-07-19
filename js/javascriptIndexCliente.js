function validarPais(){
	var idPais = document.getElementById("pais").value;
	if(idPais == 0){
		$("#departamentoSelect").prop("disabled", true);
		$("#ciudadSelect").prop("disabled", true);
		document.getElementById("departamentoSelect").value = "0";
		document.getElementById("ciudadSelect").value = "0";
	}else{
		$("#departamentoSelect").prop("disabled", false);

		$.ajax({
			type: 'post',
			url: 'includes/getDepartamento.php',
			dataType: 'html',
			data: {id: idPais},
			success: function(data){
				$("#departamentoSelect").html(data);
			}
		});
	}
}

function validarCiudad(){
	var idDepartamento = document.getElementById("departamentoSelect").value;
	if(idDepartamento == 0){
		$("#ciudadSelect").prop("disabled", true);
		document.getElementById("ciudadSelect").value = "0";
	}else{
		$("#ciudadSelect").prop("disabled", false);
		$.ajax({
			type: 'post',
			url: 'includes/getCiudad.php',
			dataType: 'html',
			data: {id: idDepartamento},
			success: function(data){
				$("#ciudadSelect").html(data);
			}
		});
	}
}

function enviarRegistroCliente(evt) {
  evt.preventDefault();// Evitamos el submit en nuevos navegadores

  let primerNombre = document.getElementById("primerNombre");
  //let segundoNombre = document.getElementById("segundoNombre");
  let primerApellido = document.getElementById("primerNombre");
  //let segundoApellido = document.getElementById("segundoNombre");
  let documento = document.getElementById("documento");
  let tipoDocumento = document.getElementById("tipoDocumento");
  let tipoCliente = document.getElementById("tipoCliente");
  let pais = document.getElementById("pais");
  let departamentoSelect = document.getElementById("departamentoSelect");
  let ciudadSelect = document.getElementById("ciudadSelect");
  let direccion = document.getElementById("direccion");
  let barrio = document.getElementById("barrio");
  let email = document.getElementById("email");
  

  if (email.value == "" || primerNombre.value == "" || primerApellido.value == "" || documento.value == "" || tipoDocumento.value == "" || tipoCliente.value == ""
     || pais.value == "" || departamentoSelect.value == "" || ciudadSelect.value == "" || direccion.value == "" || barrio.value == "") {
    swal({
      title: "Porfavor termina de llenar toda la informacion",
      text: "No has ingresado toda la informacion solicitada!",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
  } else {
    document.getElementById("registrarCliente").submit();
  }
}
