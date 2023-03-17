<?php headers($data) ?>
<section class="p-3">
    <table class="tabla-plantilla">
        <thead>
            <tr>
                <th colspan="3">
                    <h1 class="titulo">Planilla de Clientes</h1>
                </th>
                <th colspan="2" style="text-align: center;"><span>Fecha: <?= date('d-m-Y') ?></span></th>
            </tr>
            <tr>
                <th>Nombre</th>
                <th>Apellidos</th>
                <th>Barrio</th>
                <th>Lectura</th>
                <th>Novedad</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data['clientes'] as $cliente) : ?>
                <tr class="clientes">
                    <td><?= $cliente->NOMBRE ?></td>
                    <td><?= $cliente->APELLIDOS ?></td>
                    <td><?= $cliente->NOMBRE_BARRIO ?></td>
                    <td></td>
                    <td></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</section>

<style>
   .header {
    display: none;
}
.tabla-plantilla {
    width: 100%;
    text-align: center;
}


th,
td {
    border: 1px solid black;
}

.titulo {
    font-family: Arial, Helvetica, sans-serif;
    font-style: normal;
}

thead>tr th {
    font-size: 1.5rem;
}


.clientes {
    text-align: center;
}

.clientes td {
    font-size: 1.2rem;
}



</style>

<?php footers($data); ?>