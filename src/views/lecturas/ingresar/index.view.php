<?php headers($data); ?>
<link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/lecturas.css">
<section class="p-3">

    <div>
        <h1>Generar Lecturas</h1>
    </div>
    <div class="" id="contenedor-clientes-lectura">
        <div class="bg-dark p-3 rounded d-flex justify-content-between align-items-center">
            <h4 class="text-light">Administración de lecturas</h3>
                <div>
                    <button id="nueva-lectura" class="btn text-light" style="background: var(--color-morado-2);">
                        <i class="fa-solid fa-plus"></i>
                        Nueva Lectura
                    </button>
                </div>
        </div>
        <!-- tabla de lecturas -->
        <div class="">
            <table class="table table-striped bg-light border border-2">
                <thead class="">
                    <th>ID</th>
                    <th>CEDULA</th>
                    <th>CLIENTE</th>
                    <th>FECHA REGISTRO</th>
                    <th>ESTADO</th>
                    <th>ACCION</th>
                </thead>
                <tbody>
                    <?php foreach ($data['clientesActivos'] as $cliente) : ?>
                        <tr>
                            <td id="tabla-id"><?= $cliente->ID_CLIENTE ?></td>
                            <td><?= $cliente->CEDULA ?></td>
                            <td><?= $cliente->NOMBRE . " " . $cliente->APELLIDOS ?> </td>
                            <td><?= $cliente->FECHA_REGISTRO ?></td>
                            <td class="<?= $cliente->ESTADO == "ACTIVO" ? 'text-success' : 'text-warning' ?>"><?= $cliente->ESTADO ?></td>
                            <td> <button id="btn-lectura-ver" class="btn btn-info">
                                    <i class="fa-solid fa-eye"></i>
                                </button>
                                <button id="btn-lectura-editar" class="btn btn-primary">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </button>
                                <button id="btn-lectura-pagar" class="btn btn-success">
                                    <i class="fa-solid fa-money-bill"></i>
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <!-- Registro de lectura -->
    <div class="d-none" id="registro-lectura">
        <div class="bg-dark text-light p-2">
            <h5>Datos de Lectura</h5>
        </div>
        <div class=" border border-1 bg-light p-2">
            <form id="frm-lecturas">
                <input type="text" name="idCliente" id="idCliente" hidden value="">
                <div class="row align-items-center">
                    <div class="col-lg-4">
                        <label for="">Cedula</label>
                        <input type="number" name="cedula" id="cedula" class="form-control" readonly>
                    </div>
                    <div class="col-lg-5">
                        <label for="cliente">Cliente</label>
                        <input type="text" name="cliente" id="cliente" class="form-control" readonly>
                    </div>
                    <div class="col-lg-3 mt-3">
                        <button type="button" id="buscar-cliente-lectura" class="btn bg-warning"><i class="fa-solid fa-search"></i> Buscar</button>
                    </div>
                </div>
                <div class="row  align-items-center">
                    <div class="col-lg-3 form-group">
                        <label for="numero-medidor">Numero Medidor</label>
                        <input type="text" class="form-control" name="numeroMedidor" id="numero-medidor" readonly>
                    </div>
                    <div class="col-lg-3 form-group">
                        <label for="lectura-inicial">Lectura Inicial</label>
                        <input type="number" class="form-control" name="lecturInicial" id="lectura-inicial" value="">
                    </div>
                    <div class="col-lg-3 form-group mt-4">
                        <input type="submit" class="btn btn-success" value="Guardar Consumo">
                    </div>
                </div>
                <div>

                </div>
            </form>
        </div>

        <!--  Buscar cliente  -->
        <div id="registro-lectura-tablas--contenedor" class="d-none">
            <div id="registro-lectura-tablas" class="p-2 bg-light">
                <div class="bg-light p-2 d-flex justify-content-between">
                    <h5>Lista de Clientes</h5>
                    <button class="btn" id="btn-contenedor-buscar-cliente"><i class="fa-solid fa-xmark"></i></button>
                </div>
                <div class="border border-1 p-2">
                    <div class="d-flex gap-2 justify-content-center align-items-center">
                        <label for="buscar-clioentes-lectura">Buscar:</label>
                        <input type="search" class="form-control" id="input-buscar-clientes-lectura">
                    </div>
                    <div>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Cedula</th>
                                    <th>Numero Medidor</th>
                                    <th>Cliente</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody id="tbody-clientes-lecturas">
                                <?php foreach ($data['clientes'] as $cliente) : ?>
                                    <tr>
                                        <td id="buscar-id-cliente-lectura"><?= $cliente->ID_CLIENTE ?></td>
                                        <td id="buscar-cedula-lectura"><?= $cliente->CEDULA ?></td>
                                        <td id="buscar-id-numero-medidor-lectura"><?= $cliente->N_MEDIDOR ?></td>
                                        <td id="buscar-id-nombres-lectura"><?= $cliente->NOMBRE . " " . $cliente->APELLIDOS ?></td>
                                        <td id=""><button id="btn-obtener-cliente-lectura" class="btn btn-primary"><i class="fa-solid fa-rotate-right"></i></button></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Insertar Lecturas -->
    <div id="contenedor-lecturas" class="d-none">

        <div id="contenido-lecturas" class="shadow p-3 mb-5 bg-body rounded">

            <div class="d-flex justify-content-between align-items-center bg-dark text-light p-2 rounded">
                <h5>Registro de lecturas del Servicio</h5>
                <button class="btn text-light" id="lectura-cerrar-ventana">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            <div class="border border-1">
                <div class="m-3 ">
                    <!-- formulario lecturas  -->
                    <form id="frm-lectura" method="POST">
                        <div class="row">
                            <div class="col-lg-6">
                                <label for="consumo">Consumo Anterior</label>
                                <input type="number" class="form-control" name="consumo" id="input-lectura-anterior" value="" readonly>
                            </div>
                            <div class="col-lg-6">
                                <label for="consumo">Lectuara Actual</label>
                                <input type="number" class="form-control" name="lecturaActual" value="" autofocus>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <label for="consumo">Mes</label>
                                <input type="text" class="form-control" name="mes" value="<?= $data['fechas']['mes'] ?? '' ?>" readonly>
                            </div>
                            <div class="col-lg-6">
                                <label for="consumo">Fecha de Registro</label>
                                <input type="text" class="form-control" name="fechaRegistro" value="<?= $data['fechas']['fecha'] ?? '' ?>" readonly>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end align-items-center mt-2 gap-2">
                            <button class="btn btn-danger">Cerrar <i class="fa-solid fa-xmark"></i></button>
                            <button id="btn-frm-lecturas" class="btn btn-primary">Guardar <i class="fa-solid fa-save"></i></button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>




</section>

<script src="<?= BASE_URL ?>/assets/js/lecturas.js"></script>
<?php footers(); ?>