<<<<<<< HEAD
<?php  require APP_ROOT.'/vistas/inc/header.php' ?>
<link rel="stylesheet" href="<?php echo URL_ROOT; ?>/public/css/registroPresupuesto.css">
<link rel="stylesheet" href="<?php echo URL_ROOT; ?>/public/css/usuarioListar.css">
=======
<?php require APP_ROOT . '/vistas/inc/header.php' ?>
<link rel="stylesheet" href="<?php echo URL_ROOT; ?>/public/css/registroPresupuesto.css">
>>>>>>> graficas1

<div style="border:0px solid green;" class="container-fluid">

    <section class="col-md-12  content overflow-hidden">

        <div id="resultados_ajax"></div>

        <h2><b>Registrar Presupuesto</b> </h2>
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
<<<<<<< HEAD
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

=======
<div class="modal fade  " id="eliminarModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
>>>>>>> graficas1
        </div>
    </div>
</div>

<!-- FIN MODAL DEL ELIMINAR USUARIO-->
<!--FORMULARIO USUARIO VENTANA MODAL-->
<div class="container">
    <div id="transaccionModal" class="row">

        <div style="border:px solid red;" class="col-md-12">

            <form method="POST" name="fmrusuario" id="asignaciones_form">

                <div class="modal-content">

                    <div class="modal-header">

                        <button type="button" id="btnAdd" class="close" data-dismiss="modal">
                            <i class="fas fa-plus"></i>
                        </button>

                        <div class="container">
                            <h4 class="modal-title"></h4>

                        </div>
<<<<<<< HEAD
                       
                    </div>
                    <div class="col-md-2 form-group ">
                                
                                <label>Destino</label>
                                <select class="form-control" id="destino" name="origen">
                                    <option selected value="" >-Asignar a -</option>
                                                                      
                                </select>
                                <span class="text-danger  campo-requerido"><strong></strong></span>

                        </div>
                        <div class="col-md-10"></div>



                    <div   id="tblPresupuesto" style="border:px solid aqua;" class="modal-body">
=======

                    </div>
                    <div class="col-md-2 form-group ">

                        <label>Destino</label>
                        <select class="form-control" id="destino" name="origen">
                            <option selected value="">-Asignar a -</option>

                        </select>
                        <span class="text-danger  campo-requerido"><strong></strong></span>

                    </div>
                    <div class="col-md-10"></div>



                    <div id="tblPresupuesto" style="border:px solid aqua;" class="modal-body">
>>>>>>> graficas1
                        <div class="row">

                            <div class="col-md-4 form-group ">
                                <label>Descripcion </label>
                                <textarea name="descripcionGasto" class="form-control descripcionGasto" id="exampleFormControlTextarea1" rows="1"></textarea>

                                <span class="text-danger  campo-requerido"><strong></strong></span>

                            </div>

                            <div class="col-md-1 form-group ">
<<<<<<< HEAD
                         
                            </div>
                            <div class="col-md-2 form-group ">
                                <label>Unidades</label>
                                <input type="number" min="1" name="unidades" id=""
                                    class="form-control unidades" placeholder="$0" />
=======

                            </div>
                            <div class="col-md-2 form-group ">
                                <label>Unidades</label>
                                <input type="number" min="1" name="unidades" id="" class="form-control unidades" placeholder="$0" />
>>>>>>> graficas1
                                <span class="text-danger  campo-requerido"><strong></strong></span>
                                <br />
                            </div>
                            <div class="col-md-2 form-group ">
                                <label>Monto</label>
<<<<<<< HEAD
                                <input type="number"min="1" name="montoAsignado" id="" class="montoAsignado form-control"
                                    placeholder="00000000" />
=======
                                <input type="number" min="1" name="montoAsignado" id="" class="montoAsignado form-control" placeholder="00000000" />
>>>>>>> graficas1
                                <span class="text-danger  campo-requerido"><strong></strong></span>
                                <strong>

                                    <span class="text-danger" id="error-monto">

                                    </span>
                                </strong>
                                <br />

                            </div>
                            <div class="col-md-1"></div>

                            <div class="col-md-2 form-group ">
                                <label>Total</label>
<<<<<<< HEAD
                                   
                                <label  class="totalFila form-control" for="">$</label>
=======

                                <label class="totalFila form-control" for="">$</label>
>>>>>>> graficas1

                                <strong>

                                    <span class="text-danger" id="error-monto">

                                    </span>
                                </strong>
                                <br />

                            </div>

                        </div>

<<<<<<< HEAD
                           
                       
=======


>>>>>>> graficas1

                        <!-- pattern="^[a-zA-Z_áéíóúñ\s]{0,30}$"/ -->

                        <!--LISTA DE PERMISOS-->

<<<<<<< HEAD
                     
=======

>>>>>>> graficas1

                        <!--FIN LISTA DE PERMISOS-->


                    </div>
<<<<<<< HEAD
                   <div  class="modal-body">
                   <div  class="row">
                            <div class="col-md-1"><label for=""><h3>Total </h3></label></div>
                            <div class="col-md-9"></div>
                            <h3><div id="montoTotalPresupuesto" class="col-md-1">$0</div>
                            </h3>
                            <div class="col-md-1"></div>
                            
                            <hr style="width:100%; border:1px solid #037e8c;  margin:2px" />
                            
                    </div>
                   </div>
=======
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-1"><label for="">
                                    <h3>Total </h3>
                                </label></div>
                            <div class="col-md-9"></div>
                            <h3>
                                <div id="montoTotalPresupuesto" class="col-md-1">$0</div>
                            </h3>
                            <div class="col-md-1"></div>

                            <hr style="width:100%; border:1px solid #037e8c;  margin:2px" />

                        </div>
                    </div>
>>>>>>> graficas1

                    <!-- FIN DE LA TABLA PREUPUESTOS -->
                    <div class="modal-footer">
                        <!--
                         <input type="hidden" name="password1" value="presupuestos012456789">
                       

                        -->
<<<<<<< HEAD
                        <button type="submit" name="action" id="btnGuardar" class="btn btn-success pull-left"
                            value="Add"><i class="fa fa-floppy-o" aria-hidden="true"></i> Guardar</button>

                        <button type="button" onclick="  limpiar()" class="btn btn-danger" data-dismiss="modal"><i
                                class="fa fa-times" aria-hidden="true"></i> Cerrar</button>
=======
                        <button type="submit" name="action" id="btnGuardar" class="btn btn-success pull-left" value="Add"><i class="fa fa-floppy-o" aria-hidden="true"></i> Guardar</button>

                        <button type="button" onclick="  limpiar()" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i> Cerrar</button>
>>>>>>> graficas1



                    </div>



                </div>


            </form>


        </div>
<<<<<<< HEAD
  


    </div>

</div>
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
=======



    </div>

</div>
<div>

    <?php require APP_ROOT . '/vistas/inc/footer.php' ?>
>>>>>>> graficas1


    <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>

    <script src="
  https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js
    "></script>

    <script src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js">
    </script>
<<<<<<< HEAD
<?php $session_value=(isset($_SESSION['user_id_presupuestos']))?$_SESSION['user_id_presupuestos']:''; ?>
<script type="text/javascript">
    var IdUsuarioSesion='<?php echo $session_value;?>';
    
</script>

<script src="<?php echo URL_ROOT.'/public/js/registroPresupuesto.js';?>"></script>
=======
    <?php $session_value = (isset($_SESSION['user_id_presupuestos'])) ? $_SESSION['user_id_presupuestos'] : ''; ?>
    <script type="text/javascript">
        var IdUsuarioSesion = '<?php echo $session_value; ?>';
    </script>

    <script src="<?php echo URL_ROOT . '/public/js/registroPresupuesto.js'; ?>"></script>
>>>>>>> graficas1
