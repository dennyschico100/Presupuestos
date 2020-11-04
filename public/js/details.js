
const url = "http://localhost:8081/Presupuestos/detallepresupuestocontroller/getDetail";

function random_rgba() {
    var o = Math.round, r = Math.random, s = 255;
    return 'rgba(' + o(r() * s) + ',' + o(r() * s) + ',' + o(r() * s) +  ')';
}


getData();

async function getData() {
    const response = await fetch(url);
    const data = await response.json();
    console.log(data.data);
    asignData(data.data);
}

function asignData(data) {
    

    var size = Object.keys(data).length;
    //console.log('datos: ' + size);

    const xLabels = [];
    const yValues = [];
    const colors = [];

    data.forEach(function (data) {
        xLabels.push(data.nombre);
        yValues.push(data.monto_total);
    });

    for (let index = 0; index < size; index++) {
        colors.push(random_rgba());
    }

    //console.log(xLabels);
    //console.log(yValues);
    //console.log(colors[0]);

    var ctx = document.getElementById('graphic').getContext('2d');
    var chart = myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: xLabels,
            datasets: [{
                label: 'Proyectos pendientes',
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


