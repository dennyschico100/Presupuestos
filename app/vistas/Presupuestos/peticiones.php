<?php
require APP_ROOT . '/vistas/inc/header.php' ?>
<link rel="stylesheet" href="<?php echo URL_ROOT; ?>/public/css/usuarioListar.css">

<div style="border:0px solid green;" class="container-fluid">

    <section class="col-md-12  content overflow-hidden">

        <div id="resultados_ajax"></div>

        <h2>Listado de Presupuestos</h2>

        <div class="row">
            <div class="col-md-12">

                <div class="box">


                    <div class="box-header with-border">
                        <h1 class="box-title">

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
                                    <th>Nombre</th>
                                    <th width="20%">Descripcion</th>
                                    <th>Monto Solicitado</th>
                                    <th>Estado Solicitante</th>
                                    <th width="17%">Fecha Solicitud</th>
                                    <th width="5%">Editar</th>


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
<div id="usuarioModal" class="fade hide-form">


    <div class="modal-dialog">

        <form method="POST" name="fmrusuario" id="usuario_form">

            <div class="modal-content">

                <div class="modal-header">

                    <button type="button" id="btnClose" class="close" data-dismiss="modal">&times;</button>

                    <div class="container">
                        <h4 class="modal-title">Agregar Usuario</h4>

                    </div>

                </div>


                <div class="modal-body">

                    <div class="col-md-10 form-group ">
                        <label>NOMBRE PRESUPUESTO </label>
                        <input type="text" name="NOMBRE_PRESUPUESTO" id="NOMBRE_PRESUPUESTO" class="form-control"
                            placeholder=""  />
                        <span class="text-danger  campo-requerido"><strong></strong></span>

                        <br />


                        <label>Descripcion Presupuesto</label>
                        <input type="text" name="DESCRIPCION_PRESUPUESTO" id="DESCRIPCION_PRESUPUESTO"
                            class="form-control" placeholder="" pattern="^[a-zA-Z_áéíóúñ\s]{0,30}$" />
                        <span class="text-danger  campo-requerido"><strong></strong></span>

                        <br />

                    </div>

                    <div class="col-md-5 form-group ">

                        <label>Monto Solicitado</label>

                        <input type="number" name="MONTO_INICIAL" id="MONTO_INICIAL" class="form-control" />
                        <span class="text-danger  campo-requerido"><strong></strong></span>

                        <br />
                    </div>

                    <div class="col-md-6 form-group ">
                        <label>Estado</label>

                        <select class="form-control" id="ESTADO" name="ESTADO">
                            <option value=""  >-- Selecciona el estado --</option>
                            <option value="enProceso" selected>En Proceso</option>
                            <option value="denegado">Denegar</option>
                            <option value="aprobado">Aprobar</option>

                        </select>
                        <span class="text-danger  campo-requerido"><strong></strong></span>

                    </div>



                    <!-- pattern="^[a-zA-Z_áéíóúñ\s]{0,30}$"/ -->

                    <div class="col-md-6 form-group ">
                        <label>Solicitante</label>
                        <input type="text" name="USUARIO_CREA" id="USUARIO_CREA" class="form-control"
                            placeholder="" pattern="[0-9]{0,15}" />
                        <span class="text-danger  campo-requerido"><strong></strong></span>

                    </div>


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
                    <button type="submit" name="action" id="btnGuardar" class="btn btn-success pull-left" value="Add"><i
                            class="fa fa-floppy-o" aria-hidden="true"></i> Guardar</button>

                    <button type="button" onclick="  cerrarFormulario()" class="btn btn-danger" data-dismiss="modal"><i
                            class="fa fa-times" aria-hidden="true"></i> Cerrar</button>



                </div>



            </div>


        </form>


    </div>

</div>



<div>

    <?php require APP_ROOT . '/vistas/inc/footer.php' ?>


    <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>

    <script src="
  https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js
    "></script>

    <script src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>

    <script src="<?php echo URL_ROOT . '/public/js/presupuestosEnProceso.js'; ?>"></script>