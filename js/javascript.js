const fechaInicio = document.querySelector('#fecha_inicio');
const fechaFin = document.querySelector('#fecha_fin');

const formulario = document.getElementById('registrarObra');
const inputs = document.querySelectorAll('#registrarObra input');

const expresiones = {
	usuario: /^[a-zA-Z0-9]{4,20}$/, // Letras, numeros, guion y guion_bajo
	nombre: /^[a-zA-ZÀ-ÿ\s]{1,40}$/, // Letras y espacios, pueden llevar acentos.
	password: /^.{4,12}$/, // 4 a 12 digitos.
	correo: /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/,
	telefono: /^\d{7,14}$/ // 7 a 14 numeros.
}

formulario.addEventListener('submit', (e) => {
	e.preventDefault();
	let nombreObra = document.getElementById('nombreObra').value;

	if(nombreObra.length >= 20){
		swal({
			title: "Nombre de obra no valido",
			text: "No debe terner caracteres especiales !@#, Entre 4 y 20 caracteres",
			icon: "warning",
			buttons: true,
			dangerMode: true,
		})
	}
});


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

