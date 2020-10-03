<?php  require APP_ROOT.'/vistas/inc/header.php' ?>
<div style="border:0px solid green;" class="container-fluid">
    <style>
    #usuarioModal {
        
    }

    .show-box {
        transform: translate(0);
        border: 0px solid yellow;
        position: absolute;
        top: 0%;
        right: 45%;
        animation: move 2s ease-out;
        height:150vh;
        
        opacity:1;
        z-index:999; 
        
    }

    .show-opacity-box{
        opacity:0.5;
        
        z-index:100;
        
    } 
    
    #btn-cerrar{
        font-size:30px;

    }
    
    .caja{
    position: fixed;
    top: -120px;
    left: 50%;
    z-index: 1050;
    margin 0 auto;
    width: 100%;
    height: 100%;
    overflow: hidden;
    outline: 0
    }

    .hide-form{
        opacity:0;
        display:none;
    }

    .show-form{
        opacity:1;
        top:0;
        left:18%;
        position: absolute;
        overflow: auto;
        height: auto;
  
    }


    span{
        
        height:100px;
    }
    #modal-ventana{
        
        background-color:#ff8a50;
        color:#fff;

    }
    #box-error{
        left:-13.5%;
    }
    #div-form{
            

    }

    .div-form-show{
        height: 100%;
    width: 100%;
    background-color: #333;
    opacity: 0.5;
    position:absolute;
    }
    @keyframes move {
        0% {
            rotate(0deg);

            transform: translate(0%, 90%) rotate(0deg);
            opacity: 1;


        }

        80% {
            transform: translate(0%, 0%) rotate(0deg);


        }

        100% {
            transform: translate(0%, -0%) rotate(0deg);
            opacity: 1;

        }

    }
    </style>
    <section class="col-md-12  content overflow-hidden">

        <div id="resultados_ajax"></div>

        <h2>Listado de Usuarios</h2>

        <div class="row">
            <div class="col-md-12">
                <button ckass="btn btn-success" id="mostrar">MOSTRAR</button>
                <div class="box">
                    

                    <div class="box-header with-border">
                        <h1 class="box-title">
                            <button class="btn btn-primary btn-lg" id="add_button" onclick="limpiar()"
                                ><i class="fa fa-plus"
                                    aria-hidden="true"></i> Nuevo Usuario</button></h1>
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body table-responsive">

                        <table id="usuario_data" class=" table table-bordered table-striped">

                            <thead>

                                <tr>

                                    <th>Nombres</th>
                                    <th>Apellidos</th>
                                    <th>Teléfono</th>
                                    <th width="20%">Correo</th>
                                    <th width="12%">Fecha Ingreso</th>
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
<div class="modal fade col-md-6 offset-md-3" id="box-error" >

<div class="modal-dialog" role="document">
                           <div  id="modal-ventana"  class="modal-content">
                               <div class="col-md-12">
                               <div class="modal-header">
                                   <h5 class="modal-title" id="exampleModalLabel">Mensjae Importante !</h5>
                                   <button id="btn-cerrar" class="close" type="button" data-dismiss="modal"
                                       aria-label="Close">
                                       <span  class="text-white" aria-hidden="true"><h3>X</h3></span>
                                   </button>
                               </div>
                               </div>
                               <div id="mensaje-respuesta" class="modal-body"></div>
                               
                           </div>
                       </div>
                       </div>
<!--FORMULARIO VENTANA MODAL-->
<div id="usuarioModal" class="fade ">
    
                       
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
                        <br />

                        <label>Apellidos</label>
                        <input type="text" name="apellido" id="apellido" class="form-control" placeholder="Apellidos"
                            pattern="^[a-zA-Z_áéíóúñ\s]{0,30}$" />
                        <br />
                    </div>
                    <div class="col-md-10 form-group ">
                        <label>Correo</label>
                        <input type="email" name="email" id="email" class="form-control" placeholder="Correo"
                            required="required" />
                        <br />

                    </div>
                    <div class="col-md-10 form-group ">
                        <label>Numero de Dui</label>
                        <input type="text" name="dui" id="dui" class="form-control" placeholder="00000000-0" />
                        <br />

                    </div>

                    <div class="col-md-6 form-group ">
                        <label>Sexo</label>
                        <select class="form-control" id="sexo" name="sexo">
                            <option value="0">-- Selecciona el sexo --</option>
                            <option value="1" selected>Femenino</option>
                            <option value="2">Masculino</option>

                        </select>
                    </div>


                    <div class="col-md-6 form-group ">


                        <label>Cargo</label>
                        <select class="form-control" id="cargo" name="cargo">
                            <option value="">-- Selecciona cargo --</option>
                            <option value="1" selected>Tesorero</option>
                            <option value="0">Analista presupesto</option>
                            <option value="0">Jefe Presupuesto</option>

                        </select>
                    </div>
            

                    <!-- pattern="^[a-zA-Z_áéíóúñ\s]{0,30}$"/ -->



                    <div class="col-md-6 form-group ">
                        <label>Teléfono</label>
                        <input type="text" name="telefono" id="telefono" class="form-control" placeholder="Teléfono"
                            pattern="[0-9]{0,15}" />
                        
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

                    <input type="hidden" name="password1" value="dfjkfjñjdu798789327482u87987ñ`ñp+'¡0">
                    <button type="submit" name="action" id="btnGuardar" class="btn btn-success pull-left" value="Add"><i
                            class="fa fa-floppy-o" aria-hidden="true"></i> Guardar</button>

                    <button type="button" onclick="" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"
                            aria-hidden="true"></i> Cerrar</button>



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