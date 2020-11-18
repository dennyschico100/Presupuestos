
const HOST = 'http://localhost/practicas/Presupuestos/';

/**
 * Guardando las categorias
 */

var form = document.getElementById('categoriesForm');

form.addEventListener("submit", function (e) {
    e.preventDefault();
    var items = {};

    var formData = new FormData(form);

    if (formData.get('name') != "") {
        if (isNaN(formData.get('name'))) {
            console.log('name: ' + formData.get('name'));

            formData.forEach(function(value, key){
                items[key] = value;
            });

            const data = JSON.stringify(items);

         
            fetch(HOST+'categorias/store',{
                method: "POST",
                body: data
            })
            .then(res => res.json())
            .then(data => console.log(data));
            location.reload();
        }
        else {
            alert('El nombre de una categoria no puede ser un numero');
        }
    } else {
        alert('No puedes estar vacio');
    }

    //console.log('Nombre categoria: '+formData.get('name'));

});

/**
 * Llenado de la tabla
 */

getCategories();
async function getCategories() {
    const response = await fetch(HOST + 'categorias/obtenertodos');
    const data = await response.json();
    fillTable(data);
}

function fillTable(data) {
    const tableRow = document.getElementById('tableBody');

    data.forEach(e => {
        tableRow.innerHTML += ` <tr>
                        
        <td class='v1' >${e.ID_CATEGORIA}</td>
        <td class='v1'>${e.DESCRIPCION}</td>
        <td>editar | eliminar</td>
         </tr>`
    });
}

