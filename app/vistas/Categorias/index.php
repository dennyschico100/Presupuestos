<?php require APP_ROOT . '/vistas/inc/header.php' ?>

<section class="col-md-12 content overflow-hidden h-25">

    <div class="row">
        <div class="col">
            <h2>
                Categorias
            </h2>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col">
            <h4 id="title">Agregar nueva categoria</h4>
        </div>
    </div>
    <div class="row offset-1">
        <form id="categoriesForm" class="form-inline">
            <div class="form-group mb-2">
                <label for="name">Nombre categoria:</label>
            </div>
            <div class="form-group mx-sm-3 mb-2">
                <input type="text" name="name" id="name">
            </div>
            <div class="">
                <button type="submit" id="submit" onclick="save();" class="btn btn-primary mb-2">Aceptar</button>
            </div>
        </form>
    </div>

    <div class="row mt-4">
        <div class="col">
            <h4>Categorias existentes</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-md-10">
            <table id="categoriesTable" class="table">
                <thead class="thead-dark">
                    <th>Indentificador</th>
                    <th>Nombre</th>
                    <th>Opciones</th>
                </thead>
                <tbody id="tableBody">

                </tbody>
            </table>
        </div>
    </div>

</section>

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Seguro que deseas eliminar este registro?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Los registros eliminados no puedran ser recuperados! debes proceder con cuidado.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
        <button id="delete" type="button"  class="btn btn-danger" >Eliminar</button>
      </div>
    </div>
  </div>
</div>

<?php require APP_ROOT . '/vistas/inc/footer.php' ?>
<script src="<?php echo URL_ROOT . '/public/js/categories.js'; ?>"></script>