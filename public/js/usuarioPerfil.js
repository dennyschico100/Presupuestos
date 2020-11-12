const HOST='http://localhost:8081/';

var idUsuario = IdUsuarioSesion;
const CLASES = ["modal", "fade"];
const TIPO_PETICION = "PUT";
const campoRequerido = document.querySelectorAll(".campo-requerido");
const $popUpError = document.getElementById("box-error");
const divform = document.getElementById("div-form");
const $mensajeRespuesta = document.getElementById("mensaje-respuesta");
const $btnCerrar = document.getElementById("btn-cerrar");


var elements = document.getElementById("usuario_form").elements;




function validarFormulario() {
  let respuesta = true;

  console.log("numero de clases " + campoRequerido.length);

  var obj = {};
  let newObjeto = {};
  let indiceClase = 1;

  for (var i = 1; i < 7; i++) {
    indiceClase = 1;
    var item = elements.item(i);
    //console.warn(i);

    obj[item.name] = item.value;
    newObjeto = JSON.stringify(obj);
    if (obj[item.name] == null || obj[item.name] === "") {
      campoRequerido.forEach(el => {
        if (i === indiceClase) {
          //console.warn(indiceClase);

          campoRequerido.innerHTML = "valor necesaro";
          //console.error(newObjeto);
          el.innerHTML = "Campo requerido";
          respuesta = false;
        }
        indiceClase++;
      });
    }
  }

  return respuesta;
}

function limpiarMensajEsErrores() {
  campoRequerido.forEach(el => {
    el.innerHTML = "";
  });
}

function obtenerInfoUsuario(id) {
  idUsuario = id;
  //let url='http://localhost:8081/plantilla/ajax/Usuario/?id='+id_usuario;

  url =
    HOST+"Presupuestos/usuarios/obtenerUsuario/?id_usuario=" +
    id;
  const peticion = new XMLHttpRequest();

  peticion.open("GET", url);

  peticion.addEventListener("readystatechange", function(event) {
    if (peticion.readyState === 4 && peticion.status == 200) {
      const respuesta = JSON.parse(event.target.responseText);
      $("#nombre").val(respuesta.NOMBRES);
      $("#apellido").val(respuesta.APELLIDOS);
      $("#email").val(respuesta.EMAIL);
      $("#dui").val(respuesta.DUI);
      $("#sexo").val(respuesta.SEXO);
      $("#telefono").val(respuesta.TELEFONO);
      console.log(respuesta);
    } else if (peticion.readyState === 4) {
      console.log("UN ERRRO");
    }
  });

  peticion.send();

  tipoPeticion = "PUT";

  //jQuery.noConflict();
  //$("#usuarioModal").modal("show");
}

obtenerInfoUsuario(idUsuario);

$("#usuario_form").on("submit", function(e) {
  //const datosFormulario= $('#usuario_form').serialize();
  e.preventDefault();

  //var formStr = new String(datosFormulario);

  //var formDataParsed=JSON.stringify(datosFormulario);

  //console.warn(typeof formDataParsed);
  //var password1 = $("#password1").val();
  //var password2 = $("#password2").val();

  //si el password conincide entonces se envia el formulario
  //if (password1 == password2) {

  url = HOST+"Presupuestos/usuarios/modificar";

  const xhr = new XMLHttpRequest();
  xhr.open(TIPO_PETICION, url);

  const frmUsuario = document.getElementById("usuario_form");
  const FD = new FormData(frmUsuario);
  const objetoUsuario = {};

  FD.forEach(function(value, key) {
    objetoUsuario[key] = value;
  });

  if (TIPO_PETICION === "PUT") {
    objetoUsuario["idUsuario"] = parseInt(idUsuario);
  }

  const jsonUsuario = JSON.stringify(objetoUsuario);
  console.log(jsonUsuario);

  xhr.setRequestHeader("Content-Type", "application/json");
  const msg = "";
  xhr.addEventListener("readystatechange", function(event) {
    if (xhr.readyState === 4 && xhr.status === 200) {
      //msg=JSON.parse(event.target.responseText);

      console.log(event.target.responseText);
      const respuesta = JSON.parse(event.target.responseText);
      const status = respuesta.status;

      if (xhr.status === 200) {
        if (
          $popUpError.classList.contains("modal") &&
          $popUpError.classList.contains("fade")
        ) {
          $popUpError.classList.remove(...CLASES);
          //usuarioModal.style.backgroundColor="#333";
          $popUpError.classList.add("show-box");
          divform.style.opacity = "1";
          divform.style.backgroundColor = "#333";
          usuarioModal.style.opacity = "0.5";
          usuarioModal.style.zIndex = "100";
          $mensajeRespuesta.innerHTML = `${respuesta.message}`;

          success = respuesta.success;
          document.body.style.background = "#333";

          //mostrarDatos();

          console.error(respuesta);

          if (status == 201) {
            limpiar();
            limpiarMensajEsErrores();
          }
        } else {
          $popUpError.classList.add(...CLASES);
          $popUpError.classList.add("show-box");
        }
      } else {
        $("#usuario_form")[0].reset();
      }
      //jQuery.noConflict();
      //$('#resultados_ajax').html(datos);
    } else if (xhr.readyState === 4) {
      msg = JSON.parse(event.target.responseText);
    }
    //bootbox.alert(""+msg.message);
  });

  if (validarFormulario()) {
    xhr.send(jsonUsuario);
  } else {
  }
  // Define what happens in case of error
  xhr.addEventListener("error", function(event) {
    alert("Ocurrio un error");
  });

  jQuery.noConflict();
});

$btnCerrar.addEventListener("click", () => {
    if ($popUpError.classList.contains("show-box")) {
      $popUpError.classList.remove("show-box");
      $popUpError.classList.add(...CLASES);
  
      usuarioModal.style.opacity = "1.0";
  
      divform.style.opacity = "0.5";
      divform.style.backgroundColor = "#333";
  
      if (success == 0) {
      } else {
        document.location.reload();
      }
    } else {
    }
  });
  
function limpiar() {
  $("#nombre").val("");
  $("#apellido").val("");
  $("#email").val("");
  $("#dui").val("");
  $("#sexo").val("");
  $("#cargo").val("");
  $("#telefono").val("");
}
