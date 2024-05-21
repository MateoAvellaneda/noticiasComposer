<?php echo $this->extend('plantillas/layeoutEditor'); ?>
<?php echo $this->section('linkCss'); ?>
<link rel="stylesheet" href="<?php echo base_url('styles/misNoticias.css'); ?>">
<script>
        function mostrarError() {
            document.getElementById("botonError").click();
        }
</script>
<?php echo $this->endSection(); ?>
<?php echo $this->section('contenido'); ?>

<div class="grid-container contenedorTabs">
  <div class="grid-x">
    <div class="cell medium-3">
      <ul class="vertical tabs" data-tabs id="example-tabs">
        <li class="tabs-title is-active"><a href="#panel1v" aria-selected="true">Todas mis noticias</a></li>
        <li class="tabs-title"><a href="#panel2v">Borrador</a></li>
        <li class="tabs-title"><a href="#panel3v">Listas para validar</a></li>
        <li class="tabs-title"><a href="#panel4v">Descartadas</a></li>
        <li class="tabs-title"><a href="#panel5v">Rechazadas</a></li>
        <li class="tabs-title"><a href="#panel6v">En corrección</a></li>
      </ul>
    </div>
    <div class="cell medium-9">
      <div class="tabs-content vertical" data-tabs-content="example-tabs">
        <div class="tabs-panel is-active" id="panel1v">
          <table class="hover">
            <thead>
              <tr>
                <th width="230">Título</th>
                <th width="120">Estado</th>
                <th>Opciones</th>

              </tr>
            </thead>
            <tbody>
              <?php
              $stringNoticias = ['borrador', 'validar', 'descartadas', 'rechazadas', 'finalizadas','publicadas'];
              foreach ($stringNoticias as $value) {
                foreach ($$value as $noticia) {
                  echo "<tr>";
                  echo "<td>" . $noticia['titulo'] . "</td>";
                  echo "<td>" . $noticia['estado'] . "</td>";
                  echo "<td> 
                        <a href=" . "'" . base_url('verNoticia/' . $noticia['ID']) . "'" . "class='button'>Ver Noticia</a> 
                        <a href=".base_url('verHistorial/' . $noticia['ID']) ." class='button secondary'>Historial</a> 
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
                <th width="250">Título</th>
                <th>Opciones</th>
              </tr>
            </thead>
            <tbody>
              <?php
              foreach ($borrador as $noticia) {
                echo "<tr>";
                echo "<td>" . $noticia['titulo'] . "</td>";
                echo "<td>
                          <a href=" . "'" . base_url('verNoticia/' . $noticia['ID']) . "'" . "class='button'>Ver Noticia</a> 
                          <a href=" . "'" . base_url('enviarValidar/' . $noticia['ID']) . "'" . "class='button success'>Enviar a validar</a>
                          ";
                echo "<a href=" . "'" . base_url('editarnoticia/' . $noticia['ID']) . "'" . "class='button success'>Editar</a>
                          ";
                if ($noticia['retroceder'] == 1) {
                  echo "<a href=" . "'" . base_url('deshacer/' . $noticia['ID']) . "'" . "class='button warning'>Deshacer ultimo cambio</a>
                            ";
                }
                echo "<a href=" . "'" . base_url('descartar/' . $noticia['ID']) . "'" . "class='button alert'>Descartar</a> ";
                if($noticia['activarDesactivar'] == 1){
                  if($noticia['activo'] == 1){
                    echo "<a href='".base_url('desactivar/' . $noticia['ID'])."' class='button warning'>Desactivar</a> ";
                  }else{
                    echo "<a href='".base_url('activar/' . $noticia['ID'])."' class='button'>Activar</a> ";
                  }
                }
                echo "<a href=".base_url('verHistorial/' . $noticia['ID']) ." class='button secondary'>Historial</a> 
                      </td>";
              }

              ?>

            </tbody>
          </table>
        </div>
        <div class="tabs-panel" id="panel3v">
          <table class="hover">
            <thead>
              <tr>
                <th width="250">Título</th>
                <th>Opciones</th>
              </tr>
            </thead>
            <tbody>
              <?php
              foreach ($validar as $noticia) {
                echo "<tr>";
                echo "<td>" . $noticia['titulo'] . "</td>";
                echo "<td>
                  <a href=" . "'" . base_url('verNoticia/' . $noticia['ID']) . "'" . "class='button'>Ver Noticia</a> ";
                if ($noticia['retroceder'] == 1) {
                  echo "<a href=" . "'" . base_url('deshacer/' . $noticia['ID']) . "'" . "class='button warning'>Deshacer ultimo cambio</a>
                            ";
                }
                if($noticia['activarDesactivar'] == 1){
                  if($noticia['activo'] == 1){
                    echo "<a href='".base_url('desactivar/' . $noticia['ID'])."' class='button warning'>Desactivar</a> ";
                  }else{
                    echo "<a href='".base_url('activar/' . $noticia['ID'])."' class='button'>Activar</a> ";
                  }
                }
                echo "<a href=".base_url('verHistorial/' . $noticia['ID']) ." class='button secondary'>Historial</a> 
                      </td>";
              }

              ?>

            </tbody>
          </table>
        </div>
        <div class="tabs-panel" id="panel4v">
          <table class="hover">
            <thead>
              <tr>
                <th width="250">Título</th>
                <th>Opciones</th>
              </tr>
            </thead>
            <tbody>
              <?php
              foreach ($descartadas as $noticia) {
                echo "<tr>";
                echo "<td>" . $noticia['titulo'] . "</td>";
                echo "<td>
                    <a href=" . "'" . base_url('verNoticia/' . $noticia['ID']) . "'" . "class='button'>Ver Noticia</a> ";
                if ($noticia['retroceder'] == 1) {
                  echo "<a href=" . "'" . base_url('deshacer/' . $noticia['ID']) . "'" . "class='button warning'>Deshacer ultimo cambio</a>
                            ";
                }
                echo "<a href=".base_url('verHistorial/' . $noticia['ID']) ." class='button secondary'>Historial</a> 
                      </td>";
              }

              ?>

            </tbody>
          </table>
        </div>
        <div class="tabs-panel" id="panel5v">
        <table class="hover">
            <thead>
              <tr>
                <th width="250">Título</th>
                <th>Opciones</th>
              </tr>
            </thead>
            <tbody>
              <?php
              foreach ($rechazadas as $noticia) {
                echo "<tr>";
                echo "<td>" . $noticia['titulo'] . "</td>";
                echo "<td>
                    <a href=" . "'" . base_url('verNoticia/' . $noticia['ID']) . "'" . "class='button'>Ver Noticia</a> ";  
                echo "<button class='button warning' data-open='rechazoNoticia".$noticia['ID']."'>Ver Motivo</button> ";
                echo "<a href=".base_url('verHistorial/' . $noticia['ID']) ." class='button secondary'>Historial</a> ";
                if($noticia['corregir'] == 1){
                  echo "<a href=" . "'" . base_url('enviarCorreccion/' . $noticia['ID']) . "'" . "class='button'>Enviar a correccion</a>";
                }
                echo "</td>";
                
                echo "<div class='reveal' id='rechazoNoticia".$noticia['ID']."' data-reveal>
                  <h2>Motivo de rechazo</h2>
                  <p>".$noticia['motivo']."</p>
                  <button class='close-button' data-close aria-label='Close modal' type='button'>
                  <span aria-hidden='true'>&times;</span>
                  </button>
              </div>";
              }

              ?>

            </tbody>
          </table>
        </div>
        <div class="tabs-panel" id="panel6v">
          <table class="hover">
            <thead>
              <tr>
                <th width="250">Título</th>
                <th>Opciones</th>
              </tr>
            </thead>
            <tbody>
              <?php
              foreach ($correccion as $noticia) {
                echo "<tr>";
                echo "<td>" . $noticia['titulo'] . "</td>";
                echo "<td>
                    <a href=" . "'" . base_url('verNoticia/' . $noticia['ID']) . "'" . "class='button'>Ver Noticia</a> ";
                if ($noticia['retroceder'] == 1) {
                  echo "<a href=" . "'" . base_url('deshacer/' . $noticia['ID']) . "'" . "class='button warning'>Deshacer ultimo cambio</a>
                            ";
                }
                echo "<a href=" . "'" . base_url('editarnoticia/' . $noticia['ID']) . "'" . "class='button success'>Editar</a>
                          ";
                echo "<a href=" . "'" . base_url('enviarValidar/' . $noticia['ID']) . "'" . "class='button success'>Enviar a validar</a> ";
                echo "<a href=".base_url('verHistorial/' . $noticia['ID']) ." class='button secondary'>Historial</a>  
                      </td>";
              }

              ?>

            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>


<?php
  if(isset($error)){
    echo "<div class='errorModal' id='modalError'>
      <div class='modalContent'>
      <i class='bi bi-x-lg iconExit' id='exitButton' onclick='cerrarModal()'></i>
      <h2>Error</h2>
      <p>". $error ."</p>
      </div>
    </div>";
  }
?>


<script>
  function cerrarModal() {
      document.getElementById("modalError").style.display = "none";
  }
</script>

<?php echo $this->endSection(); ?>