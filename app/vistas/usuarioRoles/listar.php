<?php require APP_ROOT . '/vistas/inc/header.php' ?>

<div style="border:0px solid green;" class="container-fluid">

    <section class="col-md-12  content overflow-hidden">

        <div id="resultados_ajax"></div>

        <h2>Listado de Usuarios</h2>

        <div class="row">
            <div class="col-md-12">

                <div class="box">


                    <div class="box-header with-border">
                        <h1 class="box-title">
                            <button class="btn btn-primary btn-lg" id="add_button" onclick="limpiar()"><i
                                    class="fa fa-plus" aria-hidden="true"></i> Nuevo Usuario</button></h1>
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body table-responsive">

                        <table id="usuario_data" class=" table table-bordered table-striped">

                            <thead>

                                <tr>

                                    <th>ID</th>
                                    <th>Nombres</th>
                                    <th>Apellidos</th>
                                    <th>Email</th>
                                    <th width="20%">Rol</th>
                                    
                                    <th  >Editar</th>
                                    
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
</div><!-- /.content-wrapper -->




<div>


<?php  require APP_ROOT.'/vistas/inc/footer.php' ?>

<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>

<script src="
https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js
"></script>

<script src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>


<script src="<?php echo URL_ROOT.'/public/js/usuarioRoles.js';?>"></script>