'use strict'
console.log('crear transacciones');

const baseUrl = 'http://localhost:8081/Presupuestos';

var originSelector = document.getElementById('origin');
var destinySelector = document.getElementById('destiny');

var originAmount = document.getElementById('originAmount');
var destinyAmount = document.getElementById('destinyAmount');
var form = document.getElementById('transaction_form');

categories();

async function categories() {
    const data = await fetch(baseUrl + '/presupuestos/obtenerTodos');
    const budgets = await data.json();
    console.log(budgets);
    origin(budgets);
    destiny(budgets);
}

function origin(budgets) {
    const selector = document.getElementById('origin');
    budgets.forEach(element => {
        let option = document.createElement('option');
        option.setAttribute('value', element.ID_PRESUPUESTO);
        option.innerHTML = element.NOMBRE_PRESUPUESTO;
        selector.appendChild(option);
    });
    //console.log(budgets.MONTO_ACTUAL);
}

function destiny(budgets) {
    const selector = document.getElementById('destiny');
    budgets.forEach(element => {
        let option = document.createElement('option');
        option.setAttribute('value', element.ID_PRESUPUESTO);
        option.innerHTML = element.NOMBRE_PRESUPUESTO;
        selector.appendChild(option);
    });
}

originSelector.addEventListener("change", () => {
    const id = originSelector.value;
    setValuesOrigin(id);
});

destinySelector.addEventListener("change", () => {
    const id = destinySelector.value;
    setValuesDestiny(id);
});

async function setValuesOrigin(id) {
    originAmount.value = 0;
    const data = await fetch(baseUrl + '/presupuestos/obtenerPresupuesto?id_presupuesto=' + id);
    const budgets = await data.json();
    console.log(budgets.MONTO_ACTUAL);
    originAmount.innerHTML = budgets.MONTO_ACTUAL;
}

async function setValuesDestiny(id) {
    destinyAmount.value = 0;
    const data = await fetch(baseUrl + '/presupuestos/obtenerPresupuesto?id_presupuesto=' + id);
    const budgets = await data.json();
    console.log(budgets.MONTO_ACTUAL);
    destinyAmount.innerHTML = budgets.MONTO_ACTUAL;
}



form.addEventListener('submit', function (e) {
    e.preventDefault();
    var items = {};
    console.log('datos: ');

    var formData = new FormData(form);
    console.log('origen: ' + formData.get('origin'));
    console.log('destino: ' + formData.get('destiny'));
    console.log('monto: ' + formData.get('amount'));
    console.log('descripcion: ' + formData.get('description'));

    if (Number(formData.get('origin')) >= 1 && Number(formData.get('destiny')) >= 1) {
        validationsValues(Number(formData.get('origin')), Number(formData.get('destiny')), Number(formData.get('amount'))).then(function (value) {
            if (value) {
                alert('listo ' + value);

                formData.forEach(function (value, key) {
                    items[key] = value;
                });

                const data = JSON.stringify(items);
                console.log(data);

                fetch(baseUrl + '/transacciones/guardar', {
                    method: 'POST',
                    body: data
                }).then(
                    res => res.text()
                ).then(
                    data => console.log(data)
                );
                //limpiar los datos despues de enviarlos
                reset();
                //console.clear();


            }
            else {
                alert('no listo ' + value);
            }

        });

    } else {
        alert('el origen y el destino deben seleccionarse');
    }

});

async function validationsValues(idOrigin, idDestiny, amount) {

    const data0 = await fetch(baseUrl + '/presupuestos/obtenerPresupuesto?id_presupuesto=' + idOrigin);
    const data1 = await fetch(baseUrl + '/presupuestos/obtenerPresupuesto?id_presupuesto=' + idDestiny);

    const resp0 = await data0.json();
    const resp1 = await data1.json();

    if (selectorValidation(resp0, resp1, amount)) {
        return true;
    }
    else {
        return false;
    }


}

function selectorValidation(idOrigin, idDestiny, amount) {
    console.log('from validations');
    console.log(idOrigin);
    console.log(idDestiny);

    if (idOrigin.ID_PRESUPUESTO == idDestiny.ID_PRESUPUESTO) {
        alert('el origen no puede ser el mismo destino');
        console.log('es false');
        return false;
    } else {
        if (amountValidation(idOrigin.MONTO_ACTUAL)) {
            //recalcular aqui
            recalc(idOrigin, idDestiny, amount);
            return true;
        }
    }
}

function amountValidation(originAmount) {
    console.log('amount validation ' + originAmount);

    originAmount = Number(originAmount);
    var amountCant = document.getElementById('amount').value;

    if (!isNaN(amountCant) && amountCant != "") {
        if (originAmount == 0) {
            alert('no se cuentan con fondos');
        } else {
            if (amountCant >= originAmount) {
                alert('el monto solicitado no puede ser mayor que monto de origen');
                resetAmount();
                console.log('es false');
                return false;
            } else {

                return true;
            }
        }

    } else {
        alert('Ingresa un monto valido');
        resetAmount();
        return false;
    }
}

function recalc(origin, destiny, amount) {
    console.log('recalculando datos');
    console.log(origin);
    console.log(destiny);
    console.log(amount);

    var newOrigin = { id: Number(origin.ID_PRESUPUESTO), monto: Number(origin.MONTO_ACTUAL) - amount };

    const dataOrigen = JSON.stringify(newOrigin);
    console.log(dataOrigen);

    //actualizando el origen
    fetch(baseUrl + '/transacciones/updateOrigin', {
        method: 'POST',
        body: dataOrigen
    }).then(
        res => res.text()
    ).then(
        data => console.log(data)
    );


    var newDestiny = { id: Number(destiny.ID_PRESUPUESTO), monto: Number(destiny.MONTO_ACTUAL) + amount };

    const dataDestiny = JSON.stringify(newDestiny);
    console.log(newDestiny);
    //actualizando el origen
    fetch(baseUrl + '/transacciones/updateDestiny', {
        method: 'POST',
        body: dataDestiny
    }).then(
        res => res.text()
    ).then(
        data => console.log(data)
    );
    console.log(Number(destiny.MONTO_ACTUAL) + amount);
}


function reset() {
    $('#origin').val('');
    $('#destiny').val('');
    $('#amount').val('');
    $('#description').val('');
    originAmount.innerHTML = "0";
    destinyAmount.innerHTML = "0";
}

function resetAmount() {
    $('#amount').val('');
}

