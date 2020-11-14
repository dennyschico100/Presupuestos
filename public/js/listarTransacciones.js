const URL = "http://localhost:8081/Presupuestos";

const clases = ["modal", "fade"];
const usuarioModal = document.getElementById("usuarioModal");
const campoRequerido = document.querySelectorAll(".campo-requerido");
const $popUpError = document.getElementById("box-error");
const $btnCerrar = document.getElementById("btn-cerrar");

const divform = document.getElementById("div-form");
const $mensajeRespuesta = document.getElementById("mensaje-respuesta");



const $btnGuardar = document.getElementById("btnGuardar");
const $estado = document.getElementById("ESTADO");

let objTransaccion = {};

async function obtenerTransacciones() {
  const res = await fetch(URL + "/transacciones/obtenerTodos");

  const data = await res.json();
  //if (!res.ok ) throw { statustext: res.message };
  console.log(URL);
  console.log(data);

  mostrarDatos(data);
}

obtenerTransacciones();

async function obtenerTransaccionPorId(id) {
  const res = await fetch(
    URL + "/transacciones/obtenerTransaccionPorId?id_transaccion=" + id
  );
  const data = await res.json();
  objTransaccion = JSON.parse(JSON.stringify(data));
    console.log(data);
  $("#idTransaccion").val(data.ID_TRANSACCION);
  $("#idUsuario").val(data.ID_USUARIO);
  $("#MONTO_INICIAL").val(data.MONTO);
  $("#idOrigen").val(data.ID_PRESUPUESTO_ORIGEN);
  $("#idDestino").val(data.ID_PRESUPUESTO_DESTINO);
  $("#ESTADO").val(data.ESTADO);

  mostrarFormulario();
}
$btnCerrar.addEventListener("click", () => {
  if ($popUpError.classList.contains("show-box")) {
    $popUpError.classList.remove("show-box");
    $popUpError.classList.add(...clases);

    usuarioModal.style.opacity = "1.0";

    divform.style.opacity = "0.5";
    divform.style.backgroundColor = "#333";
    setTimeout(document.location.reload(),1000);

  } else {
  }
});
$estado.addEventListener("change", e => {
  objTransaccion.ESTADO = e.target.value;
});

$btnGuardar.addEventListener("click", e => {
  e.preventDefault();
  modificarEstado();
});
async function modificarEstado() {
  const options = {
    method: "PUT",
    body: JSON.stringify(objTransaccion),
    headers: {
      "Content-Type": "application/json"
    }
  };

  try {
    const res = await fetch(URL + "/transacciones/cambiarEstado", options);

    const data = await res.json();
    console.log(data);

    $mensajeRespuesta.innerHTML = `${data.message}`;
    if (!res.ok) throw { statustext: res.message };
  } catch (error) {
    $mensajeRespuesta.innerHTML = error.statustext || "Ocurrio un error";
    //console.log(message);
  } finally {
    $popUpError.classList.remove(...clases);
    $popUpError.classList.add("show-box");
    cerrarFormulario();
  }
}

function mostrarFormulario() {
  desabilitarCampos();

  if (usuarioModal.classList.contains("hide-form")) {
    divform.classList.add("div-form-show");
    usuarioModal.style.zIndex = "9999";
    usuarioModal.classList.add("show-form");
    usuarioModal.classList.remove("hide-form");
    usuarioModal.style.opacity = "1";
    usuarioModal.classList.add("show-form");
    usuarioModal.style.width = "500px";
    document.body.style.background = "rgb(170, 170, 170)";
  }
}

function desabilitarCampos() {
  $("#idTransaccion").attr("disabled", "disabled");
  $("#idUsuario").attr("disabled", "disabled");
  $("#MONTO_INICIAL").attr("disabled", "disabled");
  $("#idOrigen").attr("disabled", "disabled");
  $("#idDestino").attr("disabled", "disabled");
  
}

function cerrarFormulario() {
  if (usuarioModal.classList.contains("hide-form")) {
    usuarioModal.classList.remove("hide-form");
    usuarioModal.classList.opacity = "1";
    limpiar();
    
  
  } else {
    divform.classList.remove("div-form-show");
    usuarioModal.style.opacity = "1";
    //usuarioModal.style.background="";
    usuarioModal.classList.add("hide-form");
    //limpiarMensajEsErrores();
  }
  topFunction();
    
}
function topFunction() {
  console.log("going to the top");
  document.body.scrollTop = 0;
  document.documentElement.scrollTop = 0;
}

function mostrarDatos(datos) {
  $("#usuario_data").DataTable({
    data: datos,
    oPaginate: {
      sFirst: "Primero",

      sLast: "Último",

      sNext: "Siguiente",

      sPrevious: "Anterior"
    },
    aProcessing: true, //Activamos el procesamiento del datatables
    aServerSide: true, //Paginación y filtrado realizados por el servidor
    dom: "Bfrtip", //Definimos los elementos del control de tabla
    buttons: [],

    bDestroy: true,
    responsive: true,
    bInfo: true,
    iDisplayLength: 10, //Por cada 10 registros hace una paginación
    order: [[0, "desc"]],
    columns: [
      {
        data: [0]
      },
      {
        data: [1]
      },
      {
        data: [2]
      },
      {
        data: [3]
      },
      {
        data: [4]
      },
      {
        data: [5]
      },
      {
        data: [6]
      },
      {
        data: [7]
      },
      {
        data: [8]
      }
    ]
  });
}
