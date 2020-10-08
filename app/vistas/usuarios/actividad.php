<?php require APP_ROOT . '/vistas/inc/header.php' ?>
<section class="col-md-12  content overflow-hidden">

<div id="resultados_ajax"></div>

<h2>Historial de sessiones</h2>

<div class="row">
    <div class="col-md-12">

        <div class="box">


           <?php
           $date = "2020-10-06";
 
           //Convert the date string into a unix timestamp.
           $unixTimestamp = strtotime($date);
            
           //Get the day of the week using PHP's date function.
           $dayOfWeek = date("l", $unixTimestamp);
            
           //Print out the day that our date fell on.
           echo $date . ' fell on a ' . $dayOfWeek;
           
           ?>
            <!-- /.box-header -->
            <!-- centro -->
            <div class="panel-body table-responsive">

                <table id="usuario_data" class=" table table-bordered table-striped">

                    <thead>

                        <tr>

                            <th>ID</th>
                            <th>Nombres</th>
                            <th>Apellidos</th>
                            <th>Teléfono</th>
                            <th width="20%">Correo</th>
                            <th width="17%">Fecha Ingreso</th>
                            <th width="10%">Estado</th>
                            <th width="5%">Editar</th>
                            <th width="2%">Eliminar</th>



                        </tr>
                    </thead>

                    <tbody>


                    </tbody>


                </table>

            </div>

            <!--Fin centro -->
        </div><!-- /.box -->
    </div><!-- /.col -->
</div><!-- /.row -->
</section><!-- /.content -->




<div>

<?php  require APP_ROOT.'/vistas/inc/footer.php' ?>


<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>

<script src="
https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js
"></script>

<script src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>


<?php $session_value=(isset($_SESSION['user_id_presupuestos']))?$_SESSION['user_id_presupuestos']:''; ?>
<script type="text/javascript">
    var IdUsuarioSesion='<?php echo $session_value;?>';
    
</script>


<script src="<?php echo URL_ROOT.'/public/js/registroActividadUsuarios.js';?>"></script>
