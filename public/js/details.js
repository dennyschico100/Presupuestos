
const HOST = 'http://localhost:8081/';
const url = HOST + "Presupuestos/detallepresupuestocontroller/getDetail";

var urlActual = window.location;
var parameters = new URL(urlActual);
var id = parameters.searchParams.get('id');


function random_rgba() {
    var o = Math.round, r = Math.random, s = 255;
    return 'rgba(' + o(r() * s) + ',' + o(r() * s) + ',' + o(r() * s) + ')';
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
                <td>${e.id}</td>
                <td>${e.nombre}</td>
                <td>${e.unidades}</td>
                <td>${"$ " + e.monto}</td>
                <td>${"$ " + e.monto_total}</td>
            </tr>`


    });

}

function asignData(data, info, category) {

    var size = Object.keys(data).length;
    const xLabels = [];
    const yValues = [];
    const colors = [];
    const label = info.NOMBRE_PRESUPUESTO;

    document.getElementById('title').innerHTML = info.NOMBRE_PRESUPUESTO;
    document.getElementById('description').innerHTML = info.DESCRIPCION_PRESUPUESTO;
    document.getElementById('progress').innerHTML = info.PORCENTAJE_EJECUTADO + "%";
    document.getElementById('initialAmount').innerHTML = "$ " + info.MONTO_INICIAL;
    document.getElementById('actualAmount').innerHTML = "$ " + info.MONTO_ACTUAL;
    document.getElementById('status').innerHTML = info.ESTADO;
    document.getElementById('category').innerHTML = category.DESCRIPCION;


    data.forEach(function (data) {
        xLabels.push(data.nombre);
        yValues.push(data.monto_total);
    });

    for (let index = 0; index < size; index++) {
        colors.push(random_rgba());
    }


    var ctx = document.getElementById('graphic').getContext('2d');
    var chart = myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: xLabels,
            datasets: [{
                label: label,
                data: yValues,
                backgroundColor: colors
            }]
        },

        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
}

$(document).ready(function () {
    var elements = {
        "#editor": function (element, renderer) {
            return true;
        }
    };

    $("#cmd").click(function () {
        var doc = new jsPDF();

        doc.fromHTML($("#target").html(),15 ,15,{
            "width": 170,
            "elementHandlers":elements
        });

        doc.save("test.pdf");

    });
});


/*
document.addEventListener("DOMContentLoaded", () => {
    const button = document.querySelector("#generatePdf");
    button.addEventListener("click", () => {
        const element2pdf = document.body;
        html2pdf()
        .set({
            margin:1,
            filename: 'test1.pdf',
            image:{
                type:'jpeg',
                quality:0.98
            },
            html2canvas:{
                scale:3,
                letterRendering:true,
            },
            jsPDF:{
                unit:"in",
                format: "a3",
                orientation:'portrait'
            }
        })
        .from(element2pdf)
        .save()
        .catch(err => console.log(err))
    });
});*/