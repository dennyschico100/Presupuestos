<?php

require APP_ROOT . '/vistas/inc/header.php' ?>

<link rel="stylesheet" href="<?php echo URL_ROOT; ?>/public/css/presupuestos.css">

<!-- 
        graficando
    -->
<section class="col-md-10  content overflow-hidden">
    <h2><b>Graficando</b> </h2>
    <div class="row">
        <div class="col-md-10">
            Nombre del proyecto:
        </div>
        <div class="col-md-10">
            <canvas id="graphic">

            </canvas>
        </div>
    </div>
</section>


<?php require APP_ROOT . '/vistas/inc/footer.php' ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.js"></script>
<script src="<?php echo URL_ROOT . '/public/js/details.js'; ?>"></script>