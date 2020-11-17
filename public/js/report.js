
const HOST = 'http://localhost:8081/';
const url = HOST + "Presupuestos/detallepresupuestocontroller/getDetail";

var urlActual = window.location;
var parameters = new URL(urlActual);
var id = parameters.searchParams.get('id');



function random_rgba() {
    var o = Math.round, r = Math.random, s = 255;
    return 'rgba(' + o(r() * s) + ',' + o(r() * s) + ',' + o(r() * s) + ')';
}

function toggleMenu() {

    var menu = document.querySelector('.detalles');
    menu.classList.toggle('active');

}

getData(id);

async function getData(id) {
    //getting details
    const response = await fetch(url);
    const data = await response.json();
  
    //getting name
    const budget = await fetch(HOST + 'Presupuestos/presupuestos/obtenerPresupuesto?id_presupuesto=' + id);
    const info = await budget.json();

    //getting category   
    const category = await fetch(HOST + 'Presupuestos/Categorias/show?id=' + info.ID_CATEGORIA);
    const cat = await category.json();

    console.log(data);
    console.log(info);
    console.log(cat);

    asignData(data.data, info, cat);
    fillTable(data.data);
}

function fillTable(info) {
    console.log('llenando la tabla');
    console.log(info);
    const tableRow = document.getElementById('tableBody');

    info.forEach(e => {

        tableRow.innerHTML += ` <tr>
                        
                <td class='v1' >${e.id}</td>
                <td class='v1'>${e.nombre}</td>
                <td class='v1'>${e.unidades}</td>
                <td class='v1'>${"$ " + e.monto}</td>
                <td class='v1'>${"$ " + e.monto_total}</td>
                <td class='v1'></td>

                
            </tr>`


    });

}

function asignData(data, info, category) {

    document.getElementById('title').innerHTML = info.NOMBRE_PRESUPUESTO;
    document.getElementById('description').innerHTML = info.DESCRIPCION_PRESUPUESTO;
    document.getElementById('progress').innerHTML = info.PORCENTAJE_EJECUTADO + "%";
    document.getElementById('initialAmount').innerHTML = "$ " + info.MONTO_INICIAL;
    document.getElementById('actualAmount').innerHTML = "$ " + info.MONTO_ACTUAL;
    document.getElementById('status').innerHTML = info.ESTADO;
    document.getElementById('category').innerHTML = category.DESCRIPCION;
    
}

/**
 * pdf name 
 */
var namePdf = "report"+new Date().getDate()+new Date().getMonth()+new Date().getFullYear()+new Date().getHours()+new Date().getMinutes()+new Date().getSeconds();

window.onload = function () {
    document.getElementById("cmd").addEventListener("click", () => {
        const pdf = this.document.getElementById("target");
        var options = {
            margin: 1,
            filename: namePdf,
            image: { type: 'jpeg', quality: 0.98 },
            html2canvas: { scale: 2 },
            jsPDF: { unit: 'cm', format: 'letter', orientation: 'portrait' }
        };
        html2pdf().from(pdf).set(options).save();
    })
}

/*
$(document).ready(function () {
    var elements = {
        "#editor": function (element, renderer) {
            return true;
        }
    };

    $("#cmd").click(function () {
        var doc = new jsPDF();

        doc.addHTML($("#target").html(), 15, 15, {
            "width": 170,
            "elementHandlers": elements
        });

        doc.save("test.pdf");

    });
});

*/