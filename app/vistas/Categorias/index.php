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
            <h4>Agregar nueva categoria</h4>
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
                <button type="submit" class="btn btn-primary mb-2">Aceptar</button>
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


<?php require APP_ROOT . '/vistas/inc/footer.php' ?>
<script src="<?php echo URL_ROOT . '/public/js/categories.js'; ?>"></script>