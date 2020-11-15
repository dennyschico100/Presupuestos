"use strict";
const HOST='http://localhost:8081/';
const main = document.getElementById("main");

let url = "http://localhost:8081/Presupuestos/presupuestos/obtenerTodos";

const COLORES = ["#ef476f", "#fb8500", "#06d6a0", "#118ab2", "#f94144"];


const campoRequerido = document.querySelectorAll(".campo-requerido");

const $popUpError = document.getElementById("box-error");
const divform = document.getElementById("div-form");

const $mensajeRespuesta = document.getElementById("mensaje-respuesta");
const $mensajeRespuestaEliminar = document.getElementById("mensaje-respuesta-eliminar");


const clasesFormulario = ["modal", "fade"];

var usuarioModal = document.getElementById("presupuestoModal");
const btnClose = document.getElementById("btnClose");
const $btnCerrarVentanaModal = document.getElementById("btn-cerrar");

var elementosFormulario = document.getElementById("presupuestos_form").elements;

let presupuestoGlobalActivo = false;


obtenerPresupuestos(url);

async function obtenerPresupuestos() {
    const resp = await fetch(url);
    const respData = await resp.json();
    //console.warn(respData);
    console.log(respData);
    mostrarPresupuestos(respData);
}

function mostrarPresupuestos(presupuesto) {
    const urlDetail = HOST+'Presupuestos/detallepresupuestocontroller/detail';
    main.innerHTML = "";
    let index = 0;
    presupuesto.forEach((p) => {

        const movieEl = document.createElement("div");
        movieEl.classList.add("movie");
        movieEl.style.backgroundColor = COLORES[index];

        movieEl.innerHTML = `
            <img
                src=""
                alt=""
            />
            <div class="movie-info">
                <a href='${urlDetail + '?id='+ p.ID_PRESUPUESTO}'>
                    <h3 class='text-black'>${p.DESCRIPCION} </h3><strong  class='ejecutado' >Ejecutado</strong>
                    </a>
                
                        <span class="">${p.PORCENTAJE_EJECUTADO}%</span>
                    <div class='div-montoInicial' ><h5>Monto Inicial</h5>
                        <span class=''>${p.MONTO_INICIAL}</span>
                        </div>
                    </div>
                    <div class="overview">  
                    <h4>Monto Inicial :</h4>$
                    ${p.MONTO_INICIAL}
                        <h4>Monto Actual :</h4>$
                    ${p.MONTO_ACTUAL}
                
            </div>
        `;

        main.appendChild(movieEl);
        index++;
    });
}

function limpiar() {

}

function validarFormulario() {
    let respuesta = true;
    console.log("numero de clases " + campoRequerido.length);
    var obj = {};
    let newObjeto = {};
    let indiceClase = 1;
    for (var i = 1; i < 8; i++) {

        indiceClase = 1;
        var item = elementosFormulario.item(i);
        //console.warn(i);

        obj[item.name] = item.value;
        newObjeto = JSON.stringify(obj);
        if (obj[item.name] == null || obj[item.name] === "") {
            campoRequerido.forEach((el) => {

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

    campoRequerido.forEach((el) => {
        el.innerHTML = "";

    });
}


function limpiarCampos() {

    $('#nombre').val("");
    $('#apellido').val("");
    $('#email').val("");
    $('#dui').val("");
    $('#sexo').val("");
    $('#cargo').val("");
    $('#telefono').val("");

}

function mostrarFormulario() {

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
        limpiarCampos();

    } else {
        divform.classList.remove("div-form-show");

        usuarioModal.style.opacity = "1";
        //usuarioModal.style.background="";
        usuarioModal.classList.add("hide-form");
        limpiarMensajEsErrores();

    }
}

function topFunction() {
    console.log("going to the top");
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
}
(() => {
    const $addButton = document.getElementById("add_button");
    $addButton.addEventListener("click", () => {

        mostrarFormulario();
        //document.getElementsByClassName('modal-backdrop').style.backgroundColor="";

    });
})();

$btnCerrarVentanaModal.addEventListener("click", () => {

    if ($popUpError.classList.contains("show-box")) {

        $popUpError.classList.remove('show-box');
        $popUpError.classList.add(...clasesFormulario);

        usuarioModal.style.opacity = "1.0";

        divform.style.opacity = "0.5";
        divform.style.backgroundColor = "#333";



    } else {

    }

});


$("#roles_form").on("submit", function (e) {
    e.preventDefault();

    url = HOST+"Presupuestos/usuariosRoles/modificar";

    const xhr = new XMLHttpRequest();
    xhr.open("POST", url);
    const frmUsuarioRol = document.getElementById("roles_form");
    const FD = new FormData(frmUsuarioRol);
    const objetoUsuarioRol = {};

    FD.forEach(function (value, key) {
        objetoUsuarioRol[key] = value;
    });

    /*
    if (tipoPeticion === "PUT") {

        
    }*/
    objetoUsuarioRol["idUsuario"] = parseInt(idUsuario);

    const jsonUsuarioRol = JSON.stringify(objetoUsuarioRol);
    console.log(jsonUsuarioRol);

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

                    $popUpError.classList.remove(...clasesFormulario);
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

                        limpiarCampos();
                        limpiarMensajEsErrores();
                        cerrarFormulario();
                        topFunction();

                        // $("#usuario_data").DataTable().ajax.reload();

                    }

                } else {
                    $popUpError.classList.add(...clases);
                    $popUpError.classList.add("show-box");
                }
            } else {
                $("#usuarioModal").modal("hide");

                $("#roles_form")[0].reset();
            }
            //jQuery.noConflict();
            //$('#resultados_ajax').html(datos);

        } else if (xhr.readyState === 4) {
            msg = JSON.parse(event.target.responseText);
        }
        //bootbox.alert(""+msg.message);
    });

    if (validarFormulario()) {

        xhr.send(jsonUsuarioRol);

    } else {

    }
    // Define what happens in case of error
    xhr.addEventListener("error", function (event) {
        alert("Ocurrio un error");
    });

    jQuery.noConflict();

});