"use strict";


//NUEVA RAMA
const main = document.getElementById("main");

const URL = "http://localhost:8081/Presupuestos/presupuestos";

const URLCategoria = "http://localhost:8081/Presupuestos/categorias";



const $popUpError = document.getElementById("box-error");
const divform = document.getElementById("div-form");

const $mensajeRespuesta = document.getElementById("mensaje-respuesta");
const $mensajeRespuestaEliminar = document.getElementById("mensaje-respuesta-eliminar");
var usuarioModal = document.getElementById("transaccionModal");
const btnClose = document.getElementById("btnClose");
const $btnCerrarVentanaModal = document.getElementById("btn-cerrar");

const campoRequerido = document.querySelectorAll(".campo-requerido");
var elementosFormulario = document.getElementById("asignaciones_form").elements;


const $errorMontoAsignado=document.getElementById("error-monto");
const $errorCategorias=document.getElementById("error-categorias");
const $tipoAsignacion=document.getElementById("tipoAsignacion");
const $categoriaOrigen=document.getElementById("origen");
let montoDisponible=document.getElementById("");
let montoAsignado=0;




$categoriaOrigen.addEventListener("change",()=>{
    const id=$categoriaOrigen.value;
    obtenerPresupuestoPorId(id);

});

const $spinner=document.getElementById("spinner");
const $montoDisponible=document.getElementById("montoDisponible");
const $montoAsignado=document.getElementById("montoAsignado");


let presupuestoGlobalActivo=false;

async function obtenerPresupuestoPorId(id) {
    
    $montoDisponible.value=0;   
    const resp = await fetch(`${URL}/obtenerPresupuesto?id_presupuesto=`+id);
    const respData = await resp.json();
    console.log(respData);
    $montoDisponible.value=respData.MONTO_INICIAL;    

}
async function obtenerPresupuestos() {
    const resp = await fetch(`${URL}/obtenerTodos`);
    const respData = await resp.json();
    console.log(respData);
    mostrarPresupuestos(respData);
}

async function obtenerCategorias(){
    
    const resp= await fetch(`${URLCategoria}/obtenerTodos`);
    const respData=await resp.json();
    console.log(respData);
    mostrarCategorias(respData);

}

obtenerPresupuestos(URL);
obtenerCategorias();


function mostrarCategorias(categoria){
    const categoriaEl = document.getElementById("destino");
    categoria.forEach((c) => { 
        let $option =document.createElement("option");
        $option.setAttribute("value",c.ID_CATEGORIA);
        $option.innerHTML=c.DESCRIPCION; 
        categoriaEl.appendChild($option);
        //$montoDisponible.value=p.MONTO_INICIAL;
        //main.appendChild(movieEl);
        //index++;
    });
}


function mostrarPresupuestos(presupuesto){
    const presupuestoEl = document.getElementById("origen");
    presupuesto.forEach((p) => { 
        let $option =document.createElement("option");
        $option.setAttribute("value",p.ID_PRESUPUESTO);
        $option.innerHTML=p.DESCRIPCION; 
        presupuestoEl.appendChild($option);

        //$montoDisponible.value=p.MONTO_INICIAL;        
    });
}

$tipoAsignacion.addEventListener("change",(e)=>{
    $spinner.classList.add("lds-ellipsis");
    usuarioModal.style.opacity="0.5";

    setTimeout(()=>{
        $spinner.classList.remove("lds-ellipsis");
        usuarioModal.style.opacity="1";
    
    },2000);
    
});


function limpiar() {

    $('#tipoAsignacion').val("");
    $('#origen').val("");
    $('#montoDisponible').val("");
    $('#destino').val("");
    $('#montoAsignado').val("");
}


function validarFormulario() {
    let respuesta = true;
    //console.log("numero de clases " + campoRequerido.length);


    var obj = {};
    let newObjeto = {};
    let indiceClase = 1;

    for (var i = 1; i < 6; i++) {

        indiceClase = 1;
        var item = elementosFormulario.item(i);
        //console.warn(i);

        obj[item.name] = item.value;
        newObjeto = JSON.stringify(obj);
        
        //console.log( obj[item.name]);


        if (obj[item.name] == null || obj[item.name] === "") {
            campoRequerido.forEach((el) => {

                if (i === indiceClase) {
                    console.warn(indiceClase);

                    campoRequerido.innerHTML = "valor necesaro";
                    console.error(newObjeto);
                    el.innerHTML = "Campo requerido";
                    respuesta = false;
                }
                indiceClase++;

            });
        }else{
            campoRequerido.forEach((el) => {

                if (i === indiceClase) {
                    
                    campoRequerido.innerHTML = "";
                    
                    el.innerHTML = "";
                    respuesta = true;
                }
                indiceClase++;

            });
        }
    }

    return respuesta;
}

function validarAsignacion(){

    montoAsignado=
    parseFloat($montoAsignado.value);
    montoDisponible=
    parseFloat($montoDisponible.value);
    
    console.log(montoAsignado+" vs"+montoDisponible);
    
    
    if( montoAsignado <= montoDisponible  ){
        
        console.log(montoAsignado);
        return true;

    }else{
        console.log(montoDisponible);
        return false;
    }

}


$("#asignaciones_form").on("submit", function (e) {
    //const datosFormulario= $('#usuario_form').serialize();
    e.preventDefault();

    //var formStr = new String(datosFormulario);

    //var formDataParsed=JSON.stringify(datosFormulario);

    //console.warn(typeof formDataParsed);
    //var password1 = $("#password1").val();
    //var password2 = $("#password2").val();

    //si el password conincide entonces se envia el formulario
    //if (password1 == password2) {

    var  urlTransaccion = "http://localhost:8081/Presupuestos/transacciones/guardar";
            
    const xhr = new XMLHttpRequest();
    xhr.open("post", urlTransaccion);

    const frmUsuario = document.getElementById("asignaciones_form");
    const FD = new FormData(frmUsuario);
    const objetoUsuario = {};

    FD.forEach(function (value, key) {
        objetoUsuario[key] = value;
    });

    /*if (tipoPeticion === "PUT") {

        //objetoUsuario["idUsuario"] = parseInt(idUsuario);


    }*/

    const jsonUsuario = JSON.stringify(objetoUsuario);
    console.log(jsonUsuario);

    xhr.setRequestHeader("Content-Type", "application/json");
    const msg = "";
    xhr.addEventListener("readystatechange", function (event) {
        if (xhr.readyState === 4 && xhr.status === 200) {
            //msg=JSON.parse(event.target.responseText);

            console.log(event.target.responseText);
            const respuesta = JSON.parse(event.target.responseText);
            const status = respuesta.status;

            if (xhr.status === 200) {

                if ($popUpError.classList.contains("modal") && $popUpError.classList.contains("fade")) {

                    $popUpError.classList.remove(...clases);
                    //usuarioModal.style.backgroundColor="#333";
                    $popUpError.classList.add('show-box');
                    divform.style.opacity = "1";
                    divform.style.backgroundColor = "#333";
                    usuarioModal.style.opacity = "0.5";
                    usuarioModal.style.zIndex = "100";
                    $mensajeRespuesta.innerHTML = `${respuesta.message}`;
                    document.body.style.background = "#333";
                    
                    //mostrarDatos();
                    topFunction();
                    console.error(respuesta);
                    
                    if (status == 201) {

                        limpiar();
                        limpiarMensajEsErrores();
                        cerrarFormulario();
                        topFunction();
                        
                        $("#usuario_data").DataTable().ajax.reload();
                    
                    }

                } else {
                    $popUpError.classList.add(...clases);
                    $popUpError.classList.add("show-box");
                }
            } else {
                $("#usuarioModal").modal("hide");

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
        
        //xhr.send(jsonUsuario);
        if(validarAsignacion()){
            $errorMontoAsignado.innerHTML="";
            alert("TODO VALIDADO");
            
        }else{
            $errorMontoAsignado.innerHTML="Cantidad supera al monto dispobible";
            montoAsignado=0;
            //xhr.send();
        }  
    } 

    // Define what happens in case of error
    xhr.addEventListener("error", function (event) {
        alert("Ocurrio un error");
    });


});