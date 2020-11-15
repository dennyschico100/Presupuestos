<!DOCTYPE html>
<html lang="en" id="target">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.js"></script>
    <title>Generacion de reporte 1.0</title>
    <link rel="stylesheet" href="<?= URL_ROOT; ?>/public/css/reports.css">

</head>

<body>
    <header>
        <div class="logo">
            <img src="<?= URL_ROOT ?>/public/img/Capture.png" alt="">
        </div>
        <div class="report">
            <h3><i>Reporte</i></h3>
        </div>
        <div class="name">
            <h3><i>Cine El Salvador</i></h3>
        </div>
    </header>
    
        <section class="info">
            <div class="row detalles">
                <div class="col">
                    <h2><b>Generar reporte PDF:</b></h2>
                </div>
                <div class="col">
                    <button type="button" onclick="toggleMenu();" id="cmd" class="btn btn-success" value="">Generar PDF</button>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <h4>Nombre del proyecto:</h4>

                </div>
                <div class="col">
                    <p id="title" class="text-dark"></p>
                </div>
                <div class="col">
                    <h4>Estado: </h4>
                </div>
                <div class="col">
                    <p id="status" class="text-dark"></p>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <h4>Descripcion:</h4>

                </div>
                <div class="col">
                    <p id="description" class="text-dark text-justify"></p>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <h4>Categoria:</h4>
                </div>
                <div class="col">
                    <p id="category" class="text-dark"></p>
                </div>
                <div class="col">
                    <h4>Ejecucion:</h4>

                </div>
                <div class="col">
                    <p id="progress" class="text-dark"></p>
                </div>
            </div>
            
            
            <div class="row">
                <div class="col">
                    <h4>Monto Inicial:</h4>
                </div>
                <div class="col">
                    <p id="initialAmount" class="text-dark"></p>
                </div>
                <div class="col">
                    <h4>Monto Actual:</h4>
                </div>
                <div class="col">
                    <p id="actualAmount" class="text-dark"></p>
                </div>
            </div>
        </section>


        <section class="table">
            <div class="row">
                <div class="col-md-11">
                    <table id="tableDetails" class="table">
                        <thead class="thead-dark">
                            <tr>
                                <th>Identificador</th>
                                <th>Item</th>
                                <th>Unidades</th>
                                <th>Precio Unitario</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody id="tableBody">

                        </tbody>
                    </table>
                </div>
            </div>
        </section>
   
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.min.js"></script>


    <script src="<?php echo URL_ROOT . '/public/js/report.js'; ?>"></script>
</body>

</html>