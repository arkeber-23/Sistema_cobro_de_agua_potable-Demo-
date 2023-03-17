<?php headers($data); ?>
<section class="p-3">
    <div class="mb-2" style="border-bottom: 2px solid #18122B;">
        <h1 class="fs-1">Clientes</h1>
    </div>
    <div class="bg-dark p-3 rounded d-flex justify-content-between align-items-center">
        <h4 class="text-light">Administración de Clientes</h3>
            <div>
                <!--BOTON NUEVO CLEINTE---->
                <button class="btn text-light" id='buton' style="background: var(--color-morado-0);">
                    <i class="fa-solid fa-plus me-3"></i>
                    Nuevo Cliente
                </button>
            </div>
    </div>
    <!--NUEVO CLIENTES---->
    <form id="frmCliente">
        <div class="row gap-1 nuevo_cliente d-none">
            <div class="col-lg-5">
                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" id="nombre" class="form-control">
                </div>

                <div class="mt-3 form-group">
                    <label for="nombreC">Cedula</label>
                    <input type="text" name="cedula" maxlength="10" minlength="10" id="cedula" class="form-control">
                </div>
                <div class="mt-3 form-group">
                    <label for="correo">Correo</label>
                    <input type="email" name="correo" id="correo" class="form-control">
                </div>
                <div class="mt-3 form-group">
                    <label for="telefono">Telefono</label>
                    <input type="text" name="telefono" maxlength="10" minlength="10" id="telefono" class="form-control">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="apellidos">Apellidos</label>
                    <input type="text" name="apellidos" id="apellidos" class="form-control">
                </div>
                <div class="mt-3 form-group">
                    <label for="barrio">Barrio</label>
                    <select class="form-select" name="barrio" id="barrio">
                        <option select value="0">Selecione un barrio</option>
                        <?php foreach ($data['barrios'] as $barrio) : ?>
                            <option value="<?= $barrio->ID_BARRIO; ?>"><?= $barrio->NOMBRE_BARRIO; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mt-3 form-group">
                    <label for="n_medidor">N&uacute;mero Medidor</label>
                    <input type="text" name="n_medidor" id="n_medidor" class="form-control">
                </div>
                <div class="d-flex justify-content-between mt-4 text-center">
                    <div class="">
                        <input type="submit" class="btn btn-primary" value="Guardar">
                        </input>
                    </div>
                    <div class="">
                        <button id="btnCancelar" class="btn btn-danger">
                            Cancelar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <div id="contenedor_botones" class="d-flex justify-content-end align-items-center mt-5">
        <!--BUSCADOR-->
        <div class="d-flex">
            <input class="form-control" type="number" name="buscador" minlength="10" maxlength="10" id="input-buscar-cliente" placeholder="Buscar por cedula">
        </div>
    </div>
    <!----TABLA-->
    <table id="tabla_cliente" class="table table-striped text-center mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellidos</th>
                <th>Cedula</th>
                <th>Barrio</th>
                <th>
                    Acci&oacute;n
                </th>
            </tr>
        </thead>
        <tbody id="tBody">
            <?php foreach ($data['clientes'] as $cliente) : ?>
                <tr>
                    <td><?= $cliente->ID_CLIENTE ?></td>
                    <td><?= $cliente->NOMBRE ?></td>
                    <td><?= $cliente->APELLIDOS ?></td>
                    <td><?= $cliente->CEDULA ?></td>
                    <td><?= $cliente->NOMBRE_BARRIO ?></td>
                    <td>
                        <a href="/ruta/clientes/editar/<?= $cliente->ID_CLIENTE ?>" class="btn btn-primary"><i class="fa-solid fa-pen-to-square"></i></a>
                        |
                        <button class="btn btn-danger" id="btnEliminarCliente"><i class="fa-solid fa-trash"></i></button>
                    </td>

                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</section>
<script src="<?= BASE_URL ?>/assets/js/clientes.js" type="module"></script>
<?php footers(); ?>