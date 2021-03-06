<?php require APP_ROOT . '/vistas/inc/header.php' ?>
<link rel="stylesheet" href="<?php echo URL_ROOT; ?>/public/css/transaccion.css">

<div style="border:0px solid green;" class="container-fluid">

    <section class="col-md-12  content overflow-hidden">

        <div id="resultados_ajax"></div>

        <h2><b>Nueva Asignacion</b> </h2>

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
</div><!-- /.content-wrapper -->

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

<!--INICIO MODAL DEL ELIMINAR USUARIO -->
<div class="modal fade  " id="eliminarModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Aviso Importante</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div id="mensaje-respuesta-eliminar" class="modal-body"> Estas a punto de eliminar este registro .</div>
            <div id="div-botones" class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                <a class="btn btn-primary text-white" id="btnEliminar">Eliminar</a>
            </div>
        </div>
    </div>
</div>

<!-- FIN MODAL DEL ELIMINAR USUARIO-->
<!--FORMULARIO USUARIO VENTANA MODAL-->
<div class="container">
    <div id="transaccionModal" class="row">

        <div style="border:px solid red;" class="col-md-6">

            <form method="POST" name="fmrusuario" id="asignaciones_form">

                <div class="modal-content">

                    <div class="modal-header">

                        <button type="button" id="btnClose" class="close" data-dismiss="modal"></button>

                        <div class="container">
                            <h4 class="modal-title"></h4>

                        </div>

                    </div>


                    <div style="border:px solid aqua;" class="modal-body">
                        <div class="row">

                            <div class="col-md-6 form-group ">
                                <label>Tipo </label>
                                <select class="form-control" id="tipoAsignacion" name="tipoAsignacion">
                                    <option selected value="">-- Selecciona el Tipo --</option>
                                    <option value="1">Global</option>
                                    <option value="2">Asignar a Area </option>

                                </select>
                                <span class="text-danger  campo-requerido"><strong></strong></span>

                            </div>


                            <div class="col-md-6 form-group ">


                                <label>Origen</label>
                                <select class="form-control" id="origen" name="origen">
                                    <option selected value="">-Presupuesto origen-</option>

                                </select>
                                <span class="text-danger  campo-requerido"><strong></strong></span>

                            </div>

                        </div>
                        <div class="row">

                            <div class="col-md-6 form-group ">
                                <label>Monto Dispobible</label>
                                <input type="number" min="1" name="montoDisponible" id="montoDisponible"
                                    class="form-control" placeholder="$0" />
                                <span class="text-danger  campo-requerido"><strong></strong></span>
                                <br />
                            </div>
                            <div class="col-md-6 form-group ">
                                <label>Destino</label>
                                <select class="form-control" id="destino" name="destino">
                                    <option value="">Categoria destino -</option>


                                </select>

                                <span class="text-danger" id="error-categorias">
                                    <span class="text-danger  campo-requerido"><strong></strong></span>

                            </div>
                        </div>
                        <div class="row">

                            <div class="col-md-6 form-group ">
                                <label>Monto</label>
                                <input type="text" name="montoAsignado" id="montoAsignado" class="form-control"
                                    placeholder="00000000" />
                                <span class="text-danger  campo-requerido"><strong></strong></span>
                                <strong>

                                    <span class="text-danger" id="error-monto">

                                    </span>
                                </strong>
                                <br />

                            </div>
                        </div>



                        <!-- pattern="^[a-zA-Z_áéíóúñ\s]{0,30}$"/ -->

                        <!--LISTA DE PERMISOS-->

                        <div class="form-group">

                            <div class="col-lg-6">

                                <ul style="list-style:none;" id="permisos">


                                </ul>

                            </div>

                        </div>

                        <!--FIN LISTA DE PERMISOS-->


                    </div>


                    <div class="modal-footer">

                        <input type="hidden" name="password1" value="presupuestos012456789">
                        <button type="submit" name="action" id="btnGuardar" class="btn btn-success pull-left"
                            value="Add"><i class="fa fa-floppy-o" aria-hidden="true"></i> Guardar</button>

                        <button type="button" onclick="  limpiar()" class="btn btn-danger" data-dismiss="modal"><i
                                class="fa fa-times" aria-hidden="true"></i> Cerrar</button>



                    </div>



                </div>


            </form>


        </div>
        <div style="border:2px solid yellow;" class="col-md-6">

            <div id="spinner" class="">
                <div></div>
                <div></div>
                <div></div>
                <div></div>
            </div>

            <div id="r">

            </div>
        </div>


    </div>

</div>
<div>

    <?php require APP_ROOT . '/vistas/inc/footer.php' ?>


    <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>

    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>

    <script src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>

    <script src="<?php echo URL_ROOT . '/public/js/transaccion.js'; ?>"></script>