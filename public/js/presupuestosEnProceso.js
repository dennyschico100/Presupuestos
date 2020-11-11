const URL = "http://localhost:8081/Presupuestos";

const clases = ["modal", "fade"];
const usuarioModal = document.getElementById("usuarioModal");
const campoRequerido = document.querySelectorAll(".campo-requerido");
const $popUpError = document.getElementById("box-error");
const divform = document.getElementById("div-form");
const $mensajeRespuesta = document.getElementById("mensaje-respuesta");
const $btnCerrar = document.getElementById("btn-cerrar");

const $btnGuardar = document.getElementById("btnGuardar");
const $estado = document.getElementById("ESTADO");
let objPresupuesto = {};

async function obtenerPresupuestosEnProceso() {
  try {
    const res = await fetch(URL + "/presupuestos/obtenerTodosEnProceso");

    const data = await res.json();
    if (!res.ok) throw { statustext: res.message };

    mostrarDatos(data);
  } catch (error) {
    const message = error.statustext || "Ocurrio un error";
    
  }
}

$estado.addEventListener("change", e => {
  objPresupuesto.ESTADO = e.target.value;
});

obtenerPresupuestosEnProceso();
$btnGuardar.addEventListener("click", () => {});

$btnGuardar.addEventListener("click", e => {
  e.preventDefault();
  modificarEstado();
});

async function modificarEstado() {
  const options = {
    method: "PUT",
    body: JSON.stringify(objPresupuesto),
    headers: {
      "Content-Type": "application/json"
    }
  };

  try {
    const res = await fetch(URL + "/presupuestos/cambiarEstado",options);

    const data = await res.json();
    
    
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
      }
    ]
  });
}

async function obtenerPresupuestoPorId(id) {
  const res = await fetch(
    URL + "/presupuestos/obtenerPresupuestoEnProcesoId?id_presupuesto=" + id
  );
  const data = await res.json();
  objPresupuesto = JSON.parse(JSON.stringify(data));
  
  $("#NOMBRE_PRESUPUESTO").val(data.NOMBRE_PRESUPUESTO);
  $("#DESCRIPCION_PRESUPUESTO").val(data.DESCRIPCION_PRESUPUESTO);
  $("#MONTO_INICIAL").val(data.MONTO_INICIAL);
  $("#ESTADO").val(data.ESTADO);
  $("#USUARIO_CREA").val(data.USUARIO_CREA);
  mostrarFormularo();
}

function mostrarFormularo() {
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
}

function limpiar() {
  $("#NOMBRE_PRESUPUESTO").val("");
  $("#DESCRIPCION_PRESUPUESTO").val("");
  $("#MONTO_INICIAL").val("");
  $("#ESTADO").val("");
  $("#USUARIO_CREA").val("");
}

function desabilitarCampos() {
  $("#NOMBRE_PRESUPUESTO").attr("disabled", "disabled");
  $("#DESCRIPCION_PRESUPUESTO").attr("disabled", "disabled");
  $("#MONTO_INICIAL").attr("disabled", "disabled");

  $("#USUARIO_CREA").attr("disabled", "disabled");
}

$btnCerrar.addEventListener("click", () => {

  if ($popUpError.classList.contains("show-box")) {
    $popUpError.classList.remove("show-box");
    $popUpError.classList.add(...clases);

    /*  usuarioModal.style.opacity = "1.0";
  
          divform.style.opacity = "0.5";
          divform.style.backgroundColor = "#333";*/
  } else {
  }
});
