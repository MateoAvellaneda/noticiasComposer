<?php echo $this->extend('plantillas/layeoutEditor');?>
<?php echo $this->section('linkCss');?>
<link rel="stylesheet" href="<?php echo base_url('styles/misNoticias.css');?>">
<?php echo $this->endSection();?>
<?php echo $this->section('contenido');?>

<div class="grid-container contenedorTabs">
  <div class="grid-x">
    <div class="cell medium-3">
      <ul class="vertical tabs" data-tabs id="example-tabs">
        <li class="tabs-title is-active"><a href="#panel1v" aria-selected="true">Todas mis noticias</a></li>
        <li class="tabs-title"><a href="#panel2v">Borrador</a></li>
        <li class="tabs-title"><a href="#panel3v">Listas para validar</a></li>
        <li class="tabs-title"><a href="#panel4v">Descartadas</a></li>
        <li class="tabs-title"><a href="#panel5v">Rechazadas</a></li>
        <li class="tabs-title"><a href="#panel6v">Finalizadas</a></li>
      </ul>
    </div>
    <div class="cell medium-9">
      <div class="tabs-content vertical" data-tabs-content="example-tabs">
        <div class="tabs-panel is-active" id="panel1v">
            <table class="hover">
                <thead>
                    <tr>
                    <th width="230">Titulo</th>
                    <th width="120">Estado</th>
                    <th>Opciones</th>

                    </tr>
                </thead>
                <tbody>
                  <?php 
                  $stringNoticias = ['borrador', 'validar', 'descartadas', 'rechazadas', 'finalizadas'];
                  foreach ($stringNoticias as $value) {
                    foreach ($$value as $noticia) {
                      echo "<tr>";
                      echo "<td>" . $noticia['titulo'] . "</td>";
                      echo "<td>" . $noticia['estado'] . "</td>";
                      echo "<td> 
                        <a href='#' class='button'>Ver Noticia</a> 
                        <a href='#' class='button secondary'>Historial</a> 
                      </td>"; 
                      echo "</tr>";    
                    }
                  } 
                  ?>
                </tbody>
            </table>
        </div>
        <div class="tabs-panel" id="panel2v">
            <table class="hover">
                <thead>
                    <tr>
                    <th width="250">Titulo</th>
                    <th>Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($borrador as $noticia) {
                      echo "<tr>";
                      echo "<td>" . $noticia['titulo'] . "</td>";
                      echo "<td>
                          <a href='#' class='button'>Ver Noticia</a> 
                          <a href="."'".base_url('editarnoticia/'.$noticia['ID']) ."'" . "class='button success'>Editar</a>
                          <a href='#' class='button alert'>Descartar</a> 
                          <a href='#' class='button secondary'>Historial</a> 
                      </td>";
                    }
                      
                    ?>
                    
                </tbody>
            </table>
        </div>
        <div class="tabs-panel" id="panel3v">
          <p>Three</p>
          <p>Check me out! I'm a super cool Tab panel with text content!</p>
        </div>
        <div class="tabs-panel" id="panel4v">
          <p>Four</p>
          <img class="thumbnail" src="assets/img/generic/rectangle-2.jpg">
        </div>
        <div class="tabs-panel" id="panel5v">
          <p>Five</p>
          <p>Check me out! I'm a super cool Tab panel with text content!</p>
        </div>
      </div>
    </div>
  </div>
</div>



<?php echo $this->endSection();?>