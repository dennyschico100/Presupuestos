<?php require APP_ROOT . '/vistas/inc/header.php' ?>
<link rel="stylesheet" href="<?php echo URL_ROOT; ?>/public/css/usuarioListar.css">

<div class="container h-100">
    <div class="row">
        <div class="col col-8">
            <h2>Transacciones</h2>
            <div class="modal fade col-md-6 offset-md-3" id="box-error">
                <div class="modal-dialog" role="document">
                    <div id="modal-ventana" class="modal-content">
                        <div class="col-md-12">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Mensaje Importante !</h5>
                                <button id="btn-cerrar" class="close" type="button" data-dismiss="modal"
                                    aria-label="Close">
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
            <div class="card">
                <div class="card-body">
                    <form id="transaction_form">
                        <div class="row">
                            <div class="form-group col-6    ">
                                <label for="origin">Origen: </label>
                                <select name="origin" id="origin" class="form-control">
                                    <option value="">selecciona una opcion </option>
                                </select>
                            </div>
                            <div class="form-group col-6 ">
                                <label for="destiny">Destino: </label>
                                <select name="destiny" id="destiny" class="form-control">
                                    <option value="">selecciona una opcion </option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-1">
                                <label for=""> Disponible</label>
                            </div>
                            <div class="col-5 text-center">
                                <h3 id="originAmount">0</h3>
                            </div>
                            <div class="col-1">
                                <label for="">Disponible</label>
                            </div>

                            <div class="col-5 text-center">

                                <h3 id="destinyAmount">0</h3>
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-6">
                                <label for="amount">Monto solicitado</label>
                            </div>
                            <div class="col-6">
                                <input type="text" name="amount" id="amount" class="form-control"
                                    placeholder="Digita el monto">
                            </div>

                        </div>
                        <div class="row">
                            <div class="form-group col-12">
                                <label for="description">Descripcion:</label>
                                <input type="text" class="form-control" name="description" id="description"
                                    placeholder="Justifica esta transaccion">
                            </div>
                        </div>



                        <div class="d-flex flex-row-reverse">
                            <div class="p-2 bd-highlight">
                                <button type="submit" class="btn btn-success ">Transferir</button>
                                <button type="button" onclick="reset();" class="btn btn-danger ">Cancelar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>

<?php require APP_ROOT . '/vistas/inc/footer.php' ?>
<script src="<?php echo URL_ROOT . '/public/js/transactions.js'; ?>"></script>