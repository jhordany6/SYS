const fechaInicio = document.querySelector('#fecha_inicio');
const fechaFin = document.querySelector('#fecha_fin');

const validar = () =>{
	let valueFechaInicio, valueFechaFin;
	valueFechaInicio = new Date(fechaInicio.value);
	valueFechaFin = new Date(fechaFin.value);
	if (valueFechaInicio > valueFechaFin) {
		swal({
			title: "Error",
			text: "La fecha inicial no puede ser mayor a la fecha final",
			icon: "warning",
			buttons: true,
			dangerMode: true,
		})
		fechaInicio.value = "";
		fechaFin.value = "";
	}
}
fechaInicio.addEventListener('change', () => {
	validar();
});
fechaFin.addEventListener('change', () => {
	validar();
});


async function validarPais(){
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

async function validarCiudad(){
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

const toBase64 = file => new Promise((resolve, reject) => {
  const reader = new FileReader();
  reader.readAsDataURL(file);
  reader.onload = () => resolve(reader.result);
  reader.onerror = error => reject(error);
});

async function enviarRegistroObra(evt) {
	evt.preventDefault();// Evitamos el submit en nuevos navegadores
	let pais = document.getElementById("pais");
	let departamento = document.getElementById("departamentoSelect");
	let ciudad = document.getElementById("ciudadSelect");
	let estadoObra = document.getElementById("estadoObra");
	let clienteObra = document.getElementById("clienteObra");
	let tipoObra = document.getElementById("tipoObra");
	let numeroPisos = document.getElementById("cantidadPisos");
	if (pais.value == "0" || departamento.value == "0" || ciudad.value == "0" || estadoObra.value == "0" || clienteObra.value == "0" || tipoObra.value == "0")  {
		swal({
			title: "Faltan datos por completar",
			text: "Ingresa todos los campos requeridos",
			icon: "warning",
			buttons: true,
			dangerMode: true,
		})
		.then((willDelete) => {
			if (willDelete) {
				if(pais.value == "0"){pais.focus();}
				if(departamento.value == "0"){departamento.focus();}
				if(ciudad.value == "0"){ciudad.focus();}
				if(estadoObra.value == "0"){estadoObra.focus();}
				if(clienteObra.value == "0"){clienteObra.focus();}
				if(tipoObra.value == "0"){tipoObra.focus();}
			}
		});
		return true;
	} else {
		if(numeroPisos.value > 4 && tipoObra.value == "1"){
			swal({
				title: "Error",
				text: "Una edificacion tipo casa no puede tener mas de 4 pisos",
				icon: "warning",
				buttons: true,
				dangerMode: true,
			})
			numeroPisos.value = "";
			tipoObra.value = "0";
		}else{
			let planosData = $("#planos")[0].files.length;
      let documentosData = $("#documentos")[0].files.length;
      let imagenesData = $("#imagenes")[0].files.length;
			if(planosData == "0" || documentosData == "0" || imagenesData == "0"){
				swal({
					title: "Estas seguro que deseas continuar?",
					text: "No has adjuntado toda la documentacion de tu proyecto!",
					icon: "warning",
					buttons: true,
					dangerMode: true,
				})
				.then((willDelete) => {
					if (willDelete) {
						swal("Procesando informacion!", {
							timer: 3000,
						});

            const planos = document.querySelector('[id="planos"]').files[0];
            const documentos = document.querySelector('[id="documentos"]').files[0];
            const imagenes = document.querySelector('[id="imagenes"]').files[0];

            toBase64(planos).then(result =>{ 
              const dataPlanos = {name:planos.name,base64:result}; 
              console.log(dataPlanos);
              document.querySelector('[name="planos"]').value = JSON.stringify(dataPlanos);
            });
            
            toBase64(documentos).then(result =>{
              const documentosPlanos = {name:documentos.name,base64:result};
              console.log(documentosPlanos);
              document.querySelector('[name="documentos"]').value = JSON.stringify(documentosPlanos);
            });
            
            toBase64(imagenes).then(result =>{
              const imagenesPlanos = {name:imagenes.name,base64:result};
              console.log(imagenesPlanos);
              document.querySelector('[name="imagenes"]').value = JSON.stringify(imagenesPlanos);
            });

						window.swal({
              title: "Verificando informacion...",
              text: "Porfavor espere",
              showConfirmButton: false,
              allowOutsideClick: false
            });
            
            //using setTimeout to simulate ajax request
            setTimeout(() => {
              window.swal({
                title: "Finalizado!",
                showConfirmButton: false,
                timer: 1000
              });
              document.registrarObra.submit();
            }, 2000);

					} else {
						swal("Termina de llenar tu formulario");
					}
				});
			}else{
        const planos = document.querySelector('[id="planos"]').files[0];
        const documentos = document.querySelector('[id="documentos"]').files[0];
        const imagenes = document.querySelector('[id="imagenes"]').files[0];

        toBase64(planos).then(result =>{ 
          const dataPlanos = {name:planos.name,base64:result}; 
          console.log(dataPlanos);
          document.querySelector('[name="planos"]').value = JSON.stringify(dataPlanos);
        });
        
        toBase64(documentos).then(result =>{
          const documentosPlanos = {name:documentos.name,base64:result};
          console.log(documentosPlanos);
          document.querySelector('[name="documentos"]').value = JSON.stringify(documentosPlanos);
        });
        
        toBase64(imagenes).then(result =>{
          const imagenesPlanos = {name:imagenes.name,base64:result};
          console.log(imagenesPlanos);
          document.querySelector('[name="imagenes"]').value = JSON.stringify(imagenesPlanos);
        });

        window.swal({
          title: "Verificando informacion...",
          text: "Porfavor espere",
          showConfirmButton: false,
          allowOutsideClick: false
        });
        
        //using setTimeout to simulate ajax request
        setTimeout(() => {
          window.swal({
            title: "Finalizado!",
            showConfirmButton: false,
            timer: 1000
          });
          document.registrarObra.submit();
        }, 2000);

        
      }
		}
	}
}

function openPlanosBase64(base64){
  //window.open(base64); 
  var win = window.open();
  win.document.write('<iframe src="' + base64  + '" frameborder="0" style="border:0; top:0px; left:0px; bottom:0px; right:0px; width:100%; height:100%;" allowfullscreen></iframe>');
}
