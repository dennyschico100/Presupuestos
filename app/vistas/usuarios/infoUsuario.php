<?php  require APP_ROOT.'/vistas/inc/header.php' ?>
<link rel="stylesheet" href="<?php echo URL_ROOT; ?>/public/css/usuarioListar.css">

<div style="border:0px solid green;" class="container-fluid">

    <section class="col-md-12  content overflow-hidden">

        <div id="resultados_ajax"></div>

        <h2  class="text-center"><b>EDITA TU PERFIL </b> </h2>
        
        <div class="row">
            <div class="col-md-12">

                <div class="box">



                    <!-- /.box-header -->
                    <!-- centro -->
                    <div id="main" style="border:px solid red;" class="panel-body table-responsive">



                    </div>

                    <!--Fin centro -->
                </div><!-- /.box -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </section><!-- /.content -->
</div>

<!--Fin-Contenido-->
<div id="div-form">

</div>
<div class="modal fade col-md-6 offset-md-3" id="box-error">

    <div class="modal-dialog" role="document">
        <div id="modal-ventana" class="modal-content">
            <div class="col-md-12">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Mensaje Importante !</h5>
                    <button id="btn-cerrar" class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span class="text-white" aria-hidden="true">
                            <h3>X</h3>
                        </span>
                    </button>
                </div>
            </div>
            <div id="mensaje-respuesta" class="modal-body"></div>

        </div>
    </div>
</div>
<div id="usuarioModal" class="">


    <div class="modal-dialog">

        <form method="POST" name="fmrusuario" id="usuario_form">

            <div class="modal-content">

                <div class="modal-header">

                    

                    <div class="container">
                        

                    </div>

                </div>


                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-6 form-group ">
                            <label>Nombres</label>
                            <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Nombres"
                                pattern="^[a-zA-Z_áéíóúñ\s]{0,30}$" />
                            <span class="text-danger  campo-requerido"><strong></strong></span>

                            <br />




                        </div>
                        <div class="col-md-6 form-group">
                            <label>Apellidos</label>
                            <input type="text" name="apellido" id="apellido" class="form-control"
                                placeholder="Apellidos" pattern="^[a-zA-Z_áéíóúñ\s]{0,30}$" />
                            <span class="text-danger  campo-requerido"><strong></strong></span>

                            <br /></div>

                    </div>
                    <div class="row">
                        <div class="col-md-6 form-group ">
                            <label>Correo</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="Correo"
                                required="required" />
                            <span class="text-danger  campo-requerido"><strong></strong></span>

                            <br />

                        </div>
                        <div class="col-md-6 form-group ">
                            <label>Numero de Dui</label>
                            <input type="text" name="dui" id="dui" class="form-control" placeholder="00000000-0" />
                            <span class="text-danger  campo-requerido"><strong></strong></span>

                            <br />


                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 form-group ">
                            <label>Sexo</label>
                            <select class="form-control" id="sexo" name="sexo">
                                <option value="0">-- Selecciona el sexo --</option>
                                <option value="1" selected>Femenino</option>
                                <option value="2">Masculino</option>

                            </select>
                            <span class="text-danger  campo-requerido"><strong></strong></span>

                        </div>

                        <!-- pattern="^[a-zA-Z_áéíóúñ\s]{0,30}$"/ -->

                        <div class="col-md-6 form-group ">
                            <label>Teléfono</label>
                            <input type="text" name="telefono" id="telefono" class="form-control" placeholder="Teléfono"
                                pattern="[0-9]{0,15}" />
                            <span class="text-danger  campo-requerido"><strong></strong></span>

                        </div>
                    </div>


                    <!--LISTA DE PERMISOS-->



                    <!--FIN LISTA DE PERMISOS-->


                </div>


                <div class="container">
                    <div class="row ">

                        <div class="col-md-6">
                            <input type="hidden" name="password1" value="presupuestos012456789">
                            <button type="submit" name="action" id="btnGuardar" class="btn btn-success pull-left"
                                value="Add"><i class="fa fa-floppy-o" aria-hidden="true"></i> Guardar</button>
                        </div>
                        <div class="col-md-6">
                            <button type="button" onclick="  limpiar()" class="btn btn-danger"
                                data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i> Cancelar</button>
                        </div>


                    </div>
                </div>



            </div>


        </form>


    </div>

</div>

<div>

    <?php require APP_ROOT . '/vistas/inc/footer.php' ?>


    <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>

    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>

    <script src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>
<?php $session_value=(isset($_SESSION['user_id_presupuestos']))?$_SESSION['user_id_presupuestos']:''; ?>
<script type="text/javascript">
    var IdUsuarioSesion='<?php echo $session_value;?>';
    
</script>

    <script src="<?php echo URL_ROOT . '/public/js/usuarioPerfil.js'; ?>"></script>