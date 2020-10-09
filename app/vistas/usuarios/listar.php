<?php  require APP_ROOT.'/vistas/inc/header.php' ?>
<link rel="stylesheet" href="<?php echo URL_ROOT; ?>/public/css/usuarioListar.css">

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
<div class="modal fade  " id="eliminarModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Aviso Importante</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div  id="mensaje-respuesta-eliminar"  class="modal-body"> Estas  a punto de eliminar este registro .</div>
        <div  id="div-botones" class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
          <a class="btn btn-primary text-white"  id="btnEliminar"  >Eliminar</a>
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
                        <label>Nombres</label>
                        <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Nombres"
                            pattern="^[a-zA-Z_áéíóúñ\s]{0,30}$" />
                        <span class="text-danger  campo-requerido"><strong></strong></span>

                        <br />


                        <label>Apellidos</label>
                        <input type="text" name="apellido" id="apellido" class="form-control" placeholder="Apellidos"
                            pattern="^[a-zA-Z_áéíóúñ\s]{0,30}$" />
                        <span class="text-danger  campo-requerido"><strong></strong></span>

                        <br />

                    </div>
                    <div class="col-md-10 form-group ">
                        <label>Correo</label>
                        <input type="email" name="email" id="email" class="form-control" placeholder="Correo"
                            required="required" />
                        <span class="text-danger  campo-requerido"><strong></strong></span>

                        <br />

                    </div>
                    <div class="col-md-10 form-group ">
                        <label>Numero de Dui</label>
                        <input type="text" name="dui" id="dui" class="form-control" placeholder="00000000-0" />
                        <span class="text-danger  campo-requerido"><strong></strong></span>

                        <br />


                    </div>

                    <div class="col-md-6 form-group ">
                        <label>Sexo</label>
                        <select class="form-control" id="sexo" name="sexo">
                            <option value="0">-- Selecciona el sexo --</option>
                            <option value="1" selected>Femenino</option>
                            <option value="2">Masculino</option>

                        </select>
                        <span class="text-danger  campo-requerido"><strong></strong></span>

                    </div>


                    <div class="col-md-6 form-group ">

    
                        <label>Cargo</label>
                        <select class="form-control" id="cargo" name="rol">
                            <option value="">-- Selecciona cargo --</option>
                            
                            <option value="1">Analista presupesto</option>
                            <option value="3">Jefe Presupuesto</option>
                            <option value="4" selected>Tesorero</option>


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

                    <input type="hidden" name="password1"  value="presupuestos012456789">
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

    <?php  require APP_ROOT.'/vistas/inc/footer.php' ?>


    <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>

    <script src="
  https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js
    "></script>

    <script src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>


    <script src="<?php echo URL_ROOT.'/public/js/usuarios.js';?>"></script>