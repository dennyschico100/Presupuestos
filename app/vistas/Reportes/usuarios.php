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
<style>
.v1 {
  border-left: 1px solid #333;
  height: 50px;
  margin-left: -3px;
  top: 0;
}
</style>
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
                    
                

                </div>
                
            </div>
            <div class="row">
                
            </div>
            
            
            <div class="row">
               
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
                            <th>ID</th>
                                    <th>Nombres</th>
                                    <th>Apellidos</th>
                                    <th>Teléfono</th>
                                    <th width="">Correo</th>
                                    <th width="">Fecha Ingreso</th>
                                    <th width="">Estado</th>
                            </tr>
                        </thead>
                        <tbody id="tableBody">

                        </tbody>
                    </table>
                </div>
            </div>
        </section>
   
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.min.js"></script>


    <script src="<?php echo URL_ROOT . '/public/js/reportUsuarios.js'; ?>"></script>
</body>

</html>