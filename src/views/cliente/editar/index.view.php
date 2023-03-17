<?php headers($data); ?>
<section class="p-3">
    <div class="border-0 border-bottom border-primary mb-2">
        <h1 class="fs-1">Editar cliente</h1>
    </div>
    <form id="frmCliente">
        <input type="number" hidden value="<?= $data['id'] ?? '' ?>" name="idCliente">
        <div class="row gap-1 nuevo_cliente">
            <div class="col-lg-5">
                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" id="nombre" class="form-control" value=" <?= $data['cliente']->NOMBRE ?? '' ?>">
                </div>

                <div class="mt-3 form-group">
                    <label for="nombreC">Cedula</label>
                    <input type="text" name="cedula" minlength="10" maxlength="10" id="cedula" class="form-control" value=" <?= $data['cliente']->CEDULA ?? '' ?>">
                </div>
                <div class="mt-3 form-group">
                    <label for="correo">Correo</label>
                    <input type="email" name="correo" id="correo" class="form-control" value=" <?= $data['cliente']->CORREO ?? '' ?>">
                </div>
                <div class="mt-3 form-group">
                    <label for="telefono">Telefono</label>
                    <input type="text" name="telefono" minlength="10" maxlength="10" id="telefono" class="form-control" value=" <?= $data['cliente']->TELEFONO ?? '' ?>">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="apellidos">Apellidos</label>
                    <input type="text" name="apellidos" id="apellidos" class="form-control" value=" <?= $data['cliente']->APELLIDOS ?? '' ?>">
                </div>
                <div class="mt-3 form-group">
                    <label for="barrio">Barrio</label>
                    <select class="form-select" name="barrio" id="barrio">
                        <option select value="0">Selecione un barrio</option>
                        <?php foreach ($data['barrios'] as $barrio) :
                            if ($data['cliente']->ID_BARRIO == $barrio->ID_BARRIO) :
                        ?>
                                <option selected value="<?= $barrio->ID_BARRIO; ?>"><?= $barrio->NOMBRE_BARRIO; ?></option>
                            <?php else : ?>
                                <option value="<?= $barrio->ID_BARRIO; ?>"><?= $barrio->NOMBRE_BARRIO; ?></option>
                        <?php
                            endif;
                        endforeach; ?>
                    </select>
                </div>
                <div class="mt-3 form-group">
                    <label for="n_medidor">N&uacute;mero Medidor</label>
                    <input type="text" name="n_medidor" id="n_medidor" class="form-control" value=" <?= $data['cliente']->N_MEDIDOR ?? '' ?>">
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
</section>
<script src="<?= BASE_URL ?>/assets/js/editar.js"></script>

</script>
<?php footers(); ?>