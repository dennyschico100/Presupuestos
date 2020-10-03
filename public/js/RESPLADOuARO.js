
$(document).ready(function () {
    


});

var url = "";
var tipoPeticion = "POST";
//document.body.style.opacity="0"

setTimeout(() => {
    //document.body.style.opacity="1";  

}, 3000);

document.addEventListener("DOMContentLoaded", function (event) {
    console.log("DOM fully loaded and parsed");
    document.body.style.backgroundColor = "";

});

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

function cerrarFormulario() {



}
function resetearCampos() {


}
function recargarTabla() {


}

const $popUpError = document.getElementById("d");

const clases = ["modal", "fade"];


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
            console.error();
            const respuesta = JSON.parse(event.target.responseText);
            const status = respuesta.status;

            if (status === 422) {
                if($popUpError.classList.contains("modal") &&  $popUpError.classList.contains("fade")  ){
                    $popUpError.classList.remove(...clases);
                    
                    $popUpError.classList.add('show-box');
                    
                }else{
                    $popUpError.classList.add(clases);
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

    xhr.send(jsonUsuario);

    // Define what happens in case of error
    xhr.addEventListener("error", function (event) {
        alert("Ocurrio un error");
    });

    jQuery.noConflict();

});


const $btnCerrar=document.getElementById("btn-cerrar");
/*
$btnCerrar.addEventListener("click",()=>{
    
        
    if($popUpError.classList.contains("show-box")  ){
        
        $popUpError.classList.remove('show-box');
        $popUpError.classList.add(...clases);
        

    }else{
    
    }
    
}) */

const $mostrarButton = document.getElementById("mostrar");

$mostrarButton.addEventListener("click", (e) => {
    console.log(e.target);
    console.log($popUpError.classList);

    //modal fade

});

//Asigna el valor `POST`  a la variable tipoPeticion
(() => {
    const $addButton = document.getElementById("add_button");
    //const modalBackdrop=document.querySelector(".modal-backdrop");

    $addButton.addEventListener("click", () => {
        tipoPeticion = "POST";
        

        const usuarioModal= document.getElementById("usuarioModal");
        const wrapper =document.getElementById("wrapper");
        usuarioModal.classList.add("caja");
       setTimeout( ()=>{
        if(!usuarioModal.classList.contains("smodal")){
            usuarioModal.classList.remove("modal");
            usuarioModal.classList.remove("show");
            usuarioModal.classList.remove("caja");
            
            usuarioModal.style.zIndex="9999";

            
            usuarioModal.style.opacity="1";
            usuarioModal.style.position="absolute";

            usuarioModal.classList.add("caja2");
            
            console.log(usuarioModal.classList);
            document.body.style.background="#333";
            wrapper.style.zIndex="9998";
            //wrapper.style.opacity="0.5";
            
        }
       } ,1000);
       
    
        //document.getElementsByClassName('modal-backdrop').style.backgroundColor="";
        


    });
})();

function limpiar(id) { }

function mostrar(id) {
    tipoPeticion = "PUT";
    jQuery.noConflict();
    $("#usuarioModal").modal("show");
}
function eliminar(id) { }

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

});
