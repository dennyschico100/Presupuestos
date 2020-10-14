"use strict";

const $tblPresupuesto = document.getElementById("tblPresupuesto");
const $btnGuardar = document.getElementById("btnGuardar");

var elementosFormulario = document.getElementById("asignaciones_form").elements;
const montoTotalPresupuesto=document.getElementById("montoTotalPresupuesto");
let sumaTotalPresupuesto=0;

let numFilas = 0;
var numInputs = 3;

const arrUnidades = [];
const arrMonto = [];
let arrUnidadPorMonto2 = [];


const objetoPresupuesto = {};

(() => {
    console.log("xx");
    const $btnAdd = document.getElementById("btnAdd");
    $btnAdd.addEventListener("click", () => {
        if(validarFormulario()){
            
            crearFila();
            numFilas += 4;

        }else{

        }
    })

})();

$btnGuardar.addEventListener("click", (e) => {

    e.preventDefault();
    //validarFormulario()
    if(validarFormulario()){
        
        obtenerDatosDescripcion();
        obtenerDatosUnidades();
        obtenerDatosMontos();
        obtenerUnidadPorMonto();        
    }else{

    }

    limpiarArreglos();

});

function limpiar(){
      arrMonto.length=0;
      arrUnidades.length=0;
      arrUnidadPorMonto.length=0; 
}

function limpiarArreglos(){
    arrMonto.length=0;
    arrUnidades.length=0;
    //arrUnidadPorMonto.length=0;

}
function mostrarMontoTotalFila() {

}


function obtenerUnidadPorMonto() {

    const $filas = document.querySelectorAll('.totalFila');
    sumaTotalPresupuesto=0;
    const len = $filas.length;

    let arrUnidadPorMonto = [];

    alert("filas "+len);
    //arrUnidadPorMonto.length=0;
    //arrUnidadPorMonto.splice(0,arrUnidadPorMonto.length)
    let indiceFila = 0;

    for (let index = 0; index < len; index++) {

        const $montoFila = document.querySelectorAll('.totalFila');


        let total = (arrUnidades[index] * arrMonto[index]);
        arrUnidadPorMonto.push(total);
       /* console.log(" ARAY UNIDADES "+arrUnidades);
        console.log(" ARAY UNIDADES "+arrMonto);

        console.log("Vamos a operar"+(arrUnidades[index] +" x " +arrMonto[index]));
        console.log(arrUnidadPorMonto);*/
        
        $montoFila.item(indiceFila).innerHTML="$"+arrUnidadPorMonto[indiceFila];
        //console.log("indice fila "+indiceFila);

        indiceFila++;

    }
    arrUnidadPorMonto.forEach((el)=>{

        sumaTotalPresupuesto+=el;
    
    })
    montoTotalPresupuesto.innerHTML="$"+sumaTotalPresupuesto;      
    arrUnidadPorMonto.length=0;
    
}
function obtenerDatosDescripcion() {
    const $descripcionGasto = document.querySelectorAll('.descripcionGasto');

    $descripcionGasto.forEach(element => {
        console.log(element.value);
    });
    
}


function obtenerDatosUnidades() {
    const $unidades = document.querySelectorAll('.unidades');
    arrUnidades.pop();

    $unidades.forEach(element => {
        console.log(element.value);
        arrUnidades.push(parseInt(element.value));

    });
    //arrUnidades.pop();
    console.warn(arrUnidades);

}

function obtenerDatosMontos() {
    const $montoAsignado = document.querySelectorAll('.montoAsignado');
    arrMonto.pop();
    $montoAsignado.forEach(element => {
        console.log(element.value);
        arrMonto.push(element.value);

    });

    //arrMonto.pop();
    console.warn(arrMonto);

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
                            <div class="col-md-1"></div>
                            <div class="col-md-2 form-group ">
                                <label>Total</label>
                                <label  class="totalFila form-control" for=""></label>


                                <strong>
                                </strong>
                                <br />
                            </div>                           
    `;
    $tblPresupuesto.append($fila);
    numInputs += 3;


}



function validarFormulario() {
    let respuesta = true;
    const $campoRequerido = document.querySelectorAll(".campo-requerido");
    
    alert("numero de clases " + $campoRequerido.length);
    var obj = {};
    let newObjeto = {};
    let indiceClase = 1;
    numInputs++;
    alert(numInputs);
    for (var i = 1; i < numInputs; i++) {

        indiceClase = 1;
        var item = elementosFormulario.item(i);
        //console.warn(i);

        obj[item.name] = item.value;
        newObjeto = JSON.stringify(obj);
        console.log(newObjeto);
        if (obj[item.name] == null || obj[item.name] === "") {
            $campoRequerido.forEach((el) => {
                console.warn(i + " and " + indiceClase);

                if (i === indiceClase) {
                    console.warn(indiceClase);
                    $campoRequerido.innerHTML = "valor necesaro";
                    console.error(newObjeto);
                    el.innerHTML = "Campo requerido";
                    respuesta = false;
                }
                indiceClase++;
            });
        } else {
            $campoRequerido.forEach((el) => {

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
