<?php echo $this->extend('plantillas/layeoutEditorValidador'); ?>
<?php echo $this->section('linkCss'); ?>
<link rel="stylesheet" href="<?php echo base_url('styles/noticiasParaValidar.css'); ?>">
<?php echo $this->endSection(); ?>
<?php echo $this->section('contenido'); ?>
<div class="grid-container">
  <div class="grid-x">
    <div class="cell medium-1"></div>
    <div class="cell medium-10">
      <div class="grid-container">
        <div class="grid-x">
          <div class="cell medium-3">
            <ul class="vertical tabs" data-tabs id="example-tabs">
              <li class="tabs-title is-active"><a href="#panel1v" aria-selected="true">Para validar</a></li>
              <li class="tabs-title"><a href="#panel2v">Validaciones del sistema</a></li>
            </ul>
          </div>
          <div class="cell medium-9">
            <div class="tabs-content vertical" data-tabs-content="example-tabs">
              <div class="tabs-panel is-active" id="panel1v">
                <table class="hover">
                  <thead>
                    <tr>
                      <th width="200">Titulo</th>
                      <th width="200">Usuario editor</th>
                      <th>Opciones</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    foreach ($noticias as $noticia) {
                      echo "<tr>";
                      echo "<td>" . $noticia['titulo'] . "</td>";
                      echo "<td>" . $noticia['fullname'] . "</td>";
                      echo "<td>";
                      echo " <a href=" . "'" . base_url('verNoticia/' . $noticia['ID']) . "'" . "class='button'>Ver Noticia</a>  ";
                      echo "<a href=" . "'" . base_url('publicar/' . $noticia['ID']) . "'" . "class='button success'>Publicar</a> ";
                      echo "<button class='button alert' data-open='formRechazarModal' onclick='guardarValor(" . $noticia['ID'] . ")'>Rechazar</button>";
                      echo "</tr>";
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
                    foreach ($sistema as $noticia) {
                      echo "<tr>";
                      echo "<td>" . $noticia['titulo'] . "</td>";
                      echo "<td>";
                      echo " <a href=" . "'" . base_url('verNoticia/' . $noticia['ID']) . "'" . "class='button'>Ver Noticia</a>  ";
                      echo "<a href=" . "'" . base_url('despublicar/' . $noticia['ID']) . "'" . "class='button alert'>Despublicar</a> ";
                      echo "<button class='button alert' data-open='formRechazarModal' onclick='guardarValor(" . $noticia['ID'] . ")'>Rechazar</button>";
                      echo "</tr>";
                    }
                    ?>

                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
    <div class="cell medium-1"></div>
  </div>
</div>

<div class="reveal" id="formRechazarModal" data-reveal>

  <form action="<?php echo base_url('rechazar'); ?>" method="post" style="margin-top: 25px;">
    <input type="text" id="inputIdNoticia" name="idNoticia" style="display: none;">
    <label for="motivo">Motivo de rechazo (opcional)</label>
    <textarea name="motivo" id="motivo" rows="6"></textarea>
    <input type="submit" class="button success" value="Enviar">
  </form>

  <button class="close-button" data-close aria-label="Close modal" type="button">
    <span aria-hidden="true">&times;</span>
  </button>
</div>


<script>
  function guardarValor(valor) {
    var inputCampo = document.getElementById("inputIdNoticia");
    inputCampo.value = valor;
  }
</script>

<?php echo $this->endSection(); ?>