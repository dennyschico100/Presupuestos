"use strict";

const elementosFormulario = document.getElementById("asignaciones_form")
  .elements;
const montoTotalPresupuesto = document.getElementById("montoTotalPresupuesto");
const arrUnidades = [],
  arrMonto = [],
  arrDescripcion = [],
  arrMontoFila = [],
  arrObjects = [],
  arrDetalle = [],
  arrUnidadPorMonto = [];
const objetoPresupuesto = {};
const URL = "http://localhost:8081/Presupuestos/presupuestos/guardar";
const URLCategoria = "http://localhost:8081/Presupuestos/categorias";
const $popUpError = document.getElementById("box-error");
const $btnCerrar = document.getElementById("btn-cerrar");
const $mensajeRespuesta = document.getElementById("mensaje-respuesta");
const $tblPresupuesto = document.getElementById("tblPresupuesto");
const $btnGuardar = document.getElementById("btnGuardar");
const $categoriaDestino = document.getElementById("destino");

const $btnFila = document.querySelectorAll(".btnFila");

let idCategoria = 0,
  datetime = 0,
  sumaTotalPresupuesto = 0,
  numFilas = 0,
  numInputs = 4,
  numCamposVacios = 4,
  contadorBtnFila = 1;
(() => {
  var currentdate = new Date();
  datetime =
    currentdate.getFullYear() +
    "-" +
    (currentdate.getMonth() + 1) +
    "-" +
    currentdate.getDate();

  console.log(datetime);
})();

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

function topFunction() {
  console.log("going to the top");
  document.body.scrollTop = 0;
  document.documentElement.scrollTop = 0;
}
const clases = ["modal", "fade"];

(() => {
  const $btnAdd = document.getElementById("btnAdd");
  $btnAdd.addEventListener("click", () => {
    if (validarFormulario()) {
      crearFila();
      numFilas += 4;
    } else {
    }
  });
})();

$btnGuardar.addEventListener("click", e => {
  e.preventDefault();
  //validarFormulario()

  const objPresupuesto = {};

  if (validarFormulario()) {
    obtenerDatosDescripcion();
    obtenerDatosUnidades();
    obtenerDatosMontos();
    obtenerUnidadPorMonto();
    objPresupuesto.ID_CATEGORIA = idCategoria;
    objPresupuesto.MONTO_INICIAL = sumaTotalPresupuesto;
    objPresupuesto.MONTO_ACTUAL = sumaTotalPresupuesto;
    objPresupuesto.PORCENTAJE_EJECUTADO = 0;
    objPresupuesto.ESTADO = "enProceso";
    objPresupuesto.USUARIO_CREA = IdUsuarioSesion;
    objPresupuesto.FECHA_CREACION = datetime;
    alert("montoactual :"+sumaTotalPresupuesto);

    sumaTotalPresupuesto = 0;

    console.log(objPresupuesto);
    arrObjects.length = 0;
    arrObjects.push(objPresupuesto);

    let lenArr = arrMonto.length;
    const $totalFila = document.querySelectorAll(".totalFila");
    let lenFilas = $totalFila.length;
    //alert(lenFilas);

    const indice = lenFilas;

    lenFilas -= 1;
    let j = 0;
    for (let i = 0; i < indice; i++) {
      j = i;
      j++;

      const objetoDetallePresupuesto = {};
      objetoDetallePresupuesto.descripcion = arrDescripcion[i];
      objetoDetallePresupuesto.unidades = arrUnidades[i];
      objetoDetallePresupuesto.monto = arrMonto[i];
      objetoDetallePresupuesto.total = arrUnidadPorMonto[i];
      objetoDetallePresupuesto.usuarioCrea = IdUsuarioSesion;
      //console.log("ITERACION "+arrDescripcion[i]);
      //console.warn(objetoDetallePresupuesto);
      arrDetalle.push(objetoDetallePresupuesto);
      //console.log(arrDetalle[i]);
      arrObjects.push(arrDetalle[i]);
      //console.error(arrObjects[j]);
    }
    const car = {
      name: "carro1",
      status: true,
      year: 2000
    };

    console.log(arrObjects);
    let options = {
      method: "POST",
      body: JSON.stringify(arrObjects),
      headers: {
        // ***
        "Content-Type": "application/json" // ***
      }
    };

    const xhr = new XMLHttpRequest();
    xhr.open(options.method, URL);
    //xhr.send(JSON.stringify(arrObjects));

    xhr.addEventListener("readystatechange", event => {
      if (xhr.readyState == 4 && xhr.status == 200) {
        console.warn(event.target.responseText);

        let json = JSON.parse(event.target.responseText);
        console.warn(json);
      } else if (xhr.readyState == 4) {
      } else {
      }
    });
    
    console.log(options.body);
    let respuesta = "";
    fetch(URL, options)
      .then(response => {
        return response.ok ? response.text() : Promise.reject(response);
      })
      .then(data => {
        respuesta = data;
        console.log(data);
        $mensajeRespuesta.innerHTML = `${respuesta.message}`;
      })
      .catch(err => {
        respuesta = err;
        console.log(err);
        $mensajeRespuesta.innerHTML = `${respuesta.message}`;
      });

    $popUpError.classList.remove(...clases);
    $popUpError.classList.add("show-box");
    topFunction();
    setTimeout(() => {
      //document.location.reload();
    }, 5500);
  } else {
  }

  limpiarArreglos();
});

function limpiar() {
  arrMonto.length = 0;
  arrUnidades.length = 0;
  arrUnidadPorMonto.length = 0;
}

function limpiarArreglos() {
  arrDescripcion.length = 0;
  arrMonto.length = 0;
  arrUnidades.length = 0;
  arrUnidadPorMonto.length = 0;
}

function mostrarMontoTotalFila() {}

async function obtenerCategorias() {
  const resp = await fetch(`${URLCategoria}/obtenerTodos`);
  const respData = await resp.json();
  console.log(respData);
  mostrarCategorias(respData);
}

obtenerCategorias();
function mostrarCategorias(categoria) {
  const categoriaEl = document.getElementById("destino");
  categoria.forEach(c => {
    if (c.ID_CATEGORIA != 1) {
      let $option = document.createElement("option");
      $option.setAttribute("value", c.ID_CATEGORIA);
      $option.innerHTML = c.DESCRIPCION;
      categoriaEl.appendChild($option);
    }
  });
}

function mostrarUnidadPorMonto() {
  const $filas = document.querySelectorAll(".totalFila");
  sumaTotalPresupuesto = 0;
  const len = $filas.length;

  //alert("filas "+len);

  //arrUnidadPorMonto.length=0;
  //arrUnidadPorMonto.splice(0,arrUnidadPorMonto.length)
  let indiceFila = 0;

  for (let index = 0; index < len; index++) {
    const $montoFila = document.querySelectorAll(".totalFila");

    /* console.log(" ARAY UNIDADES "+arrUnidades);
         console.log(" ARAY UNIDADES "+arrMonto);
 
         console.log("Vamos a operar"+(arrUnidades[index] +" x " +arrMonto[index]));
         console.log(arrUnidadPorMonto);*/
    
    $montoFila.item(indiceFila).innerHTML = "$" + arrUnidadPorMonto[indiceFila];
    //console.log("indice fila "+indiceFila);

    indiceFila++;
  }
  arrUnidadPorMonto.forEach(el => {
    sumaTotalPresupuesto += el;
  });


  //MOSTRAR ESTO
  montoTotalPresupuesto.innerHTML = "$" + sumaTotalPresupuesto;


  console.log(arrUnidadPorMonto);

  //arrUnidadPorMonto.length=0;
}

async function obtenerUnidadPorMonto() {
  const $filas = document.querySelectorAll(".totalFila");
  //sumaTotalPresupuesto = 0;

  const len = $filas.length;

  for (let index = 0; index < len; index++) {
    let total = arrUnidades[index] * arrMonto[index];
    arrUnidadPorMonto.push(total);
  }

}

function obtenerDatosDescripcion() {
  const $descripcionGasto = document.querySelectorAll(".descripcionGasto");
  arrDescripcion.pop();

  $descripcionGasto.forEach(element => {
    console.log(element.value);
    arrDescripcion.push(element.value);
  });
  console.log(arrDescripcion);
}

function obtenerMontoFila() {
  const $totalFila = document.querySelectorAll(".totalFila");
  //arrDescripcion.pop();
  arrMontoFila.pop();
  $totalFila.forEach(element => {
    arrMontoFila.push(element.value);
  });

  console.log(arrMontoFila);
}

function obtenerDatosUnidades() {
  const $unidades = document.querySelectorAll(".unidades");
  arrUnidades.pop();

  $unidades.forEach(element => {
    console.log(element.value);
    arrUnidades.push(parseInt(element.value));
  });
  //arrUnidades.pop();
  console.warn(arrUnidades);
}

function obtenerDatosMontos() {
  const $montoAsignado = document.querySelectorAll(".montoAsignado");
  arrMonto.pop();
  $montoAsignado.forEach(element => {
    console.log(element.value);
    arrMonto.push(element.value);
  });

  //arrMonto.pop();
  console.warn(arrMonto);
}

$(document).on("click", ".btnFila", function() {
  limpiarArreglos();

  if (validarFormulario()) {
        mostrarDato();
    

  }
});
async function mostrarDato(){
    obtenerDatosDescripcion();
    obtenerDatosUnidades();
    obtenerDatosMontos();
    obtenerUnidadPorMonto();
    await mostrarUnidadPorMonto();
    
}
//CREANDO LA FILA
function crearFila() {
  const $fila = document.createElement("div");
  $fila.classList.add("row");
  $fila.innerHTML = `
    <div class="col-md-4 form-group ">
                                <label>Descripcion </label>
                                <textarea class="form-control descripcionGasto " id="" rows="1"></textarea>

                                <span class="text-danger  campo-requerido"><strong></strong></span>
                            </div>
                            <div class="col-md-1 form-group ">

                            </div>
                            <div class="col-md-2 form-group ">
                                <label>Unidades</label>
                                <input type="number" min="1" name="" id=""
                                    class="form-control unidades" placeholder="$0" />
                                <span class="text-danger  campo-requerido"><strong></strong></span>
                                <br />
                            </div>
                            <div class="col-md-2 form-group ">
                                <label>Monto</label>
                                <input type="number"min="1" name="montoAsignado" id="" class="montoAsignado form-control"
                                    placeholder="00000000" />
                                <span class="text-danger  campo-requerido"><strong></strong></span>
                                <strong>

                                    <span class="text-danger" id="">

                                    </span>
                                </strong>
                                <br />

                            </div>

                            <div class="col-md-1 form-group ">
                                <label>Total</label>
                                <label  class="totalFila form-control" for=""></label>


                                <strong>
                                </strong>
                                <br />
                            </div>         
                            <div class="col-md-1 form-group ">
                            <label style="visibility:hidden;" >Total</label>
                            
                             <button  class="btnFila btn btn-success" type="button">Agregar</button>         

                            <br />

                        </div>                  
    `;
  $tblPresupuesto.append($fila);
  numInputs += 3;
}

$categoriaDestino.addEventListener("change", () => {
  idCategoria = $categoriaDestino.value;

  //obtenerPresupuestoPorId(id);
});

function validarFormulario() {
  let respuesta = true;
  const $campoRequerido = document.querySelectorAll(".campo-requerido");

  //alert("numero de clases " + $campoRequerido.length);
  var obj = {};
  let newObjeto = {};
  let indiceClase = 1;
  numInputs++;
  //alert(numInputs);

  for (var i = 1; i < numInputs; i++) {
    indiceClase = 1;
    var item = elementosFormulario.item(i);
    //console.warn(i);

    obj[item.name] = item.value;
    newObjeto = JSON.stringify(obj);
    //console.log(newObjeto);
    if (obj[item.name] == null || obj[item.name] === "") {
      $campoRequerido.forEach(el => {
        //console.warn(i + " and " + indiceClase);

        if (i === indiceClase) {
          //console.warn(indiceClase);
          $campoRequerido.innerHTML = "valor necesaro";
          //console.error(newObjeto);
          el.innerHTML = "Campo requerido";
          respuesta = false;
        }
        indiceClase++;
      });
    } else {
      $campoRequerido.forEach(el => {
        if (i === indiceClase) {
          $campoRequerido.innerHTML = "";

          el.innerHTML = "";
          respuesta = true;
        }
        indiceClase++;
      });
    }
  }
  numInputs -= 1;

  return respuesta;
}
