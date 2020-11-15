<?php

require APP_ROOT . '/vistas/inc/header.php' ?>

<link rel="stylesheet" href="<?php echo URL_ROOT; ?>/public/css/presupuestos.css">

<!-- 
        graficando
    -->
<section id="target" class="col-md-10 offset-1  content overflow-hidden">
    <div class="row">
        <div class="col">
            <h2><b>Detalles</b></h2>
        </div>
        <div class="col">
            <a href="<?= URL_ROOT . '/ReportController/show?id='.$_GET['id'] ?>"><button type="button" id="cmd2" class="btn btn-success" value="">Generar PDF</button></a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <h6>Nombre del proyecto:</h6>

        </div>
        <div class="col">
            <p id="title" class="text-dark"></p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <h6>Descripcion:</h6>

        </div>
        <div class="col-md-7">
            <p id="description" class="text-dark text-justify"></p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <h6>Categoria:</h6>
        </div>
        <div class="col">
            <p id="category" class="text-dark"></p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <h6>Estado: </h6>
        </div>
        <div class="col">
            <p id="status" class="text-dark"></p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <h6>Ejecucion:</h6>

        </div>
        <div class="col-md-8">
            <p id="progress" class="text-dark"></p>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <h6>Monto Inicial:</h6>
        </div>
        <div class="col">
            <p id="initialAmount" class="text-dark"></p>
        </div>
        <div class="col">
            <h6>Monto Actual:</h6>
        </div>
        <div class="col">
            <p id="actualAmount" class="text-dark"></p>
        </div>
    </div>
    <br><br>
    <div class="row">
        <div class="col-md-11 text-center">
            <h4>Detalle de gastos</h4>
        </div>
    </div>
    <br>
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

    <div class="row">
        <div class="col-md-11">
            <canvas id="graphic">

            </canvas>
        </div>
    </div>
</section>


<?php require APP_ROOT . '/vistas/inc/footer.php' ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.js"></script>
<script src="<?php echo URL_ROOT . '/public/js/details.js'; ?>"></script>