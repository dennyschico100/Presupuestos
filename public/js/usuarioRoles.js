function mostrarDatos() {

    var jqxhr = $.get(
        "http://localhost:8081/Presupuestos/usuariosRoles/obtenerTodos",
        function (data, status) {
            const datos = JSON.parse(data);
            console.log(datos[0]);
            
            $("#usuario_data").DataTable(
                {
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