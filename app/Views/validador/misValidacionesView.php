<?php echo $this->extend('plantillas/layeoutValidador');?>
<?php echo $this->section('linkCss');?>
<link rel="stylesheet" href="<?php echo base_url('styles/noticiasParaValidar.css');?>">
<?php echo $this->endSection();?>
<?php echo $this->section('contenido');?>
<div class="grid-container">
    <div class="grid-x">
        <div class="cell medium-1"></div>
        <div class="cell medium-10">
        <table class="hover">
            <thead>
              <tr>
                <th width="200">Titulo</th>
                <th width="200">Usuario editor</th>
                <th width="200">Estado</th>
                <th>Opciones</th>
              </tr>
            </thead>
            <tbody>
                <?php
                    foreach($noticias as $noticia){
                        echo "<tr>";
                        echo "<td>" . $noticia['titulo'] . "</td>";
                        echo "<td>" . $noticia['fullname'] . "</td>";
                        echo "<td>" . $noticia['estado'] . "</td>";
                        echo "<td>";
                        echo " <a href=" . "'" . base_url('verNoticia/' . $noticia['ID']) . "'" . "class='button'>Ver Noticia</a> ";
                        echo "<a href=" . "'" . base_url('deshacer/' . $noticia['ID']) . "'" . "class='button warning'>Deshacer ultimo cambio</a> ";
                        echo "</tr>";
                    }
                ?>

            </tbody>
          </table>
        </div>
        <div class="cell medium-1"></div>
    </div>
</div>
<?php echo $this->endSection();?>