$(document).ready(function () {



});

var url = "";
var tipoPeticion = "POST";
const campoRequerido = document.querySelectorAll(".campo-requerido");

const $popUpError = document.getElementById("box-error");
const divform = document.getElementById("div-form");
const $mensajeRespuesta = document.getElementById("mensaje-respuesta");
const clases = ["modal", "fade"];

var usuarioModal = document.getElementById("usuarioModal");
const btnClose = document.getElementById("btnClose");
const $btnCerrar = document.getElementById("btn-cerrar");



function validarFormulario() {
    let respuesta = true;

    console.log("numero de clases " + campoRequerido.length);
    var elements = document.getElementById("usuario_form").elements;
    var obj = {};
    let newObjeto = {};
    let indiceClase = 1;

    for (var i = 1; i < 8; i++) {
        indiceClase = 1;
        var item = elements.item(i);
        console.warn(i);
        obj[item.name] = item.value;
        newObjeto = JSON.stringify(obj);
        if (obj[item.name] == null || obj[item.name] === "") {
            campoRequerido.forEach((el) => {

                if (i === indiceClase) {
                    console.warn(indiceClase);
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

document.addEventListener("DOMContentLoaded", function (event) {
    console.log("DOM fully loaded and parsed");
    document.body.style.backgroundColor = "";

});

function mostrarFormularo() {
    if (usuarioModal.classList.contains("hide-form")) {

        divform.classList.add("div-form-show");
        usuarioModal.style.zIndex = "9999";
        usuarioModal.classList.add("show-form");
        usuarioModal.classList.remove("hide-form");
        usuarioModal.style.opacity = "1";
        usuarioModal.classList.add("show-form");
        usuarioModal.style.width = "500px";
        console.log(usuarioModal.classList);
        document.body.style.background = "rgb(170, 170, 170)";

    }
}


function mostrarDatos() {
    var jqxhr = $.get(
        "http://localhost:8081/Presupuestos/usuarios/obtenerTodos",
        function (data, status) {
            const datos = JSON.parse(data);
            console.log(datos[0]);

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
                buttons: [
                    {
                        text: "Pdf",
                        className: "btn btn-secondary"
                    },
                    {
                        text: "excelHtml5",
                        className: "btn btn-secondary"
                    }
                ],

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
                    }
                ]
            });

            //m(data);
        }
    )
        .done(function () {
            //alert( "second success" );
        })
        .fail(function () { })
        .always(function () { });
}

mostrarDatos();

function desabilitarCampos() {
    $("#apellido").attr("disabled", "disabled");
    $("#nombre").attr("disabled", "disabled");
}

const btnGuardar = document.getElementById("btnGuardar");
btnGuardar.addEventListener("click", () => { });

btnClose.addEventListener("click", () => {
   cerrarFormulario();

});

function cerrarFormulario() {
    
    if (usuarioModal.classList.contains("hide-form")) {
        usuarioModal.classList.remove("hide-form");
        usuarioModal.classList.opacity = "1";
        limpiar();
        
    } else {
        divform.classList.remove("div-form-show");
        console.log(divform.classList);
        usuarioModal.style.opacity = "1";
        //usuarioModal.style.background="";
        usuarioModal.classList.add("hide-form");
        limpiarMensajEsErrores();
        
    }
}


function resetearCampos() {

}
function recargarTabla() {


}



$("#usuario_form").on("submit", function (e) {
    //const datosFormulario= $('#usuario_form').serialize();
    e.preventDefault();

    //var formStr = new String(datosFormulario);

    //var formDataParsed=JSON.stringify(datosFormulario);

    //console.warn(typeof formDataParsed);
    //var password1 = $("#password1").val();
    //var password2 = $("#password2").val();

    //si el password conincide entonces se envia el formulario
    //if (password1 == password2) {

    switch (tipoPeticion) {
        case "POST":
            url = "http://localhost:8081/Presupuestos/usuarios/guardar";

            break;

        case "PUT":
            url = "http://localhost:8081/Presupuestos/usuarios/modificar";
            break;
        default:
            break;
    }


    const xhr = new XMLHttpRequest();
    xhr.open(tipoPeticion, url);

    const frmUsuario = document.getElementById("usuario_form");
    const FD = new FormData(frmUsuario);
    const objetoUsuario = {};

    FD.forEach(function (value, key) {
        objetoUsuario[key] = value;
    });

    const jsonUsuario = JSON.stringify(objetoUsuario);
    console.log(jsonUsuario);

    xhr.setRequestHeader("Content-Type", "application/json");
    const msg = "";
    xhr.addEventListener("readystatechange", function (event) {
        if (xhr.readyState === 4 && xhr.status === 200) {
            //msg=JSON.parse(event.target.responseText);
            const respuesta = JSON.parse(event.target.responseText);
            const status = respuesta.status;
            console.error(respuesta);

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

                    if (status == 201) {

                        limpiar();
                        limpiarMensajEsErrores();
                        cerrarFormulario();
                        
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

            /* $("#usuario_data")
                 .DataTable()
                 .ajax.reload(); */
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
    xhr.addEventListener("error", function (event) {
        alert("Ocurrio un error");
    });

    jQuery.noConflict();

});




$btnCerrar.addEventListener("click", () => {

    if ($popUpError.classList.contains("show-box")) {

        $popUpError.classList.remove('show-box');
        $popUpError.classList.add(...clases);

        usuarioModal.style.opacity = "1.0";

        divform.style.opacity = "0.5";
        divform.style.backgroundColor = "#333";



    } else {

    }

});



//Asigna el valor `POST`  a la variable tipoPeticion
(() => {
    const $addButton = document.getElementById("add_button");
    $addButton.addEventListener("click", () => {
        tipoPeticion = "POST";

        mostrarFormularo();
        //document.getElementsByClassName('modal-backdrop').style.backgroundColor="";

    });
})();

function limpiar(id) {

    $('#nombre').val("");
    $('#apellido').val("");
    $('#email').val("");
    $('#dui').val("");
    $('#sexo').val("");
    $('#cargo').val("");
    $('#telefono').val("");

}


function mostrar(id) {
    tipoPeticion = "PUT";
    mostrarFormularo();
    //jQuery.noConflict();
    //$("#usuarioModal").modal("show");
}

function eliminar(id) { }

/*
$("#peticion_put").on("submit", function (e) {
    alert("submit");
    e.preventDefault();
    const xhr = new XMLHttpRequest();
    tipoPeticion = "PUT";

    const datos = {
        nombre: "lenovo"
    }

    url = "http://localhost:8081/Presupuestos/usuarios/modificar";
    tipoPeticion = "PUT";
    xhr.open("PUT", url);
    xhr.addEventListener("readystatechange", () => {
        if (xhr.readyState === 4 && xhr.status === 200) {
            console.log("se envio y recivio")

        } else if (xhr.readyState === 4) {
            console.log("UN ERRRO");
        }
    })
    console.log(tipoPeticion),
        console.log(url);
    //xhr.send();

});*/