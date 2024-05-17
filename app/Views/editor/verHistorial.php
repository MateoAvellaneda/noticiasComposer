<?php echo $this->extend('plantillas/layeoutEditor'); ?>
<?php echo $this->section('linkCss'); ?>
<link rel="stylesheet" href="<?php echo base_url('styles/verHistorial.css'); ?>">
<?php echo $this->endSection(); ?>
<?php echo $this->section('contenido'); ?>
<div class="grid-x formContainer">
    <div class="cell small-1 containerLateral"></div>
    <div class="cell small-10 containerCentral table-scroll">
        <h2>Historial</h2>
        <div class="table-scroll">
            <table class="hover">
                <thead>
                    <tr>
                        <th>Cambio n°</th>
                        <th>Titulo</th>
                        <th width="200">Descripcion</th>
                        <th>Estado</th>
                        <th>Imagen</th>
                        <th>Activo</th>
                        <th>Cambio hecho por</th>
                        <th>Fecha de cambio</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($historial as $hist) {
                        echo "<tr>";
                        echo "<td>" . $hist['numCambio'] . "</td>";
                        echo "<td>" . $hist['titulo'] . "</td>";
                        echo "<td>" . $hist['descripcion'] . "</td>";
                        echo "<td>" . $hist['estado'] . "</td>";
                        if (!empty($hist['urlImagen'])) {
                            echo "<td><img src='" . base_url($hist['urlImagen']) . "'alt='' class='imagenesHistorial'></td>";
                        } else {
                            echo "<td>No tiene</td>";
                        }

                        if ($hist['activo'] == 0) {
                            echo "<td>No</td>";
                        } else {
                            echo "<td>Si</td>";
                        }
                        echo "<td>" . $hist['fullname'] . "</td>";
                        echo "<td>" . $hist['fechaCambio'] . "</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <h2 style="margin-top: 20px;">Motivos de rechazo</h2>
        <div class="table-scroll">
        <table>
            <thead>
                <tr>
                    <th width="200">Rechazo N°</th>
                    <th>Motivo</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $num = 1;
                    foreach ($rechazos as $rechazo) {
                        echo "<tr>";
                        echo "<td>" .$num. "</td>";
                        echo "<td>".$rechazo['motivo'] ."</td>";
                        echo "</tr>";
                        $num++;
                    }
                ?>
            </tbody>
        </table>
        </div>
    </div>
    <div class="cell small-1 containerLateral"></div>
</div>



<?php echo $this->endSection(); ?>