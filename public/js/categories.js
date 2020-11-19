
const HOST = 'http://localhost/practicas/Presupuestos/';

/**
 * Guardando las categorias
 */

var form = document.getElementById('categoriesForm');

function save() {

    form.addEventListener("submit", function (e) {
        e.preventDefault();
        var items = {};

        var formData = new FormData(form);

        if (formData.get('name') != "") {
            if (isNaN(formData.get('name'))) {
                console.log('name: ' + formData.get('name'));

                formData.forEach(function (value, key) {
                    items[key] = value;
                });

                const data = JSON.stringify(items);


                fetch(HOST + 'categorias/store', {
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
}

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
        <td><a onClick="setData(${e.ID_CATEGORIA});"><i class="fas fa-pencil-alt"></i></a> | <a onClick="setDestroy(${e.ID_CATEGORIA});" data-toggle="modal" data-target="#exampleModalCenter"><i class="fas fa-trash"></i></a></td>
         </tr>`
    });
}

/**
 * Editando un registros
 */


async function setData(id) {
    const response = await fetch(HOST + 'categorias/show?id=' + id);
    const data = await response.json();

    document.getElementById('title').innerHTML = "Actualizando una categoria";
    document.getElementById('name').value = data.DESCRIPCION;
    document.getElementById('submit').innerHTML = "Editar";
    document.getElementById('submit').setAttribute("onClick", `update(${id})`);

}

function update(id) {

    form.addEventListener("submit", function (e) {
        e.preventDefault();
        var items = {};

        var formData = new FormData(form);

        if (formData.get('name') != "") {
            if (isNaN(formData.get('name'))) {
                console.log('name: ' + formData.get('name'));

                items['id'] = id;
                items['name'] = formData.get('name')

                const data = JSON.stringify(items);


                fetch(HOST + 'categorias/update', {
                    method: "PUT",
                    body: data
                })
                    .then(res => res.text())
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
}

/**
 * eliminando los registros
 * 
 * 
 */

function setDestroy(id) {

    console.log(id);

    document.getElementById('delete').setAttribute("onClick", `destroy(${id})`);
}

function destroy(id) {
    fetch(HOST + 'categorias/delete?id=' + id, {
        method: 'DELETE',
    })
        .then(res => res.json())
        .then(() => location.reload());
}