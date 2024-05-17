<?php echo $this->extend('plantillas/layeoutEditorValidador'); ?>
<?php echo $this->section('linkCss'); ?>
<link rel="stylesheet" href="<?php echo base_url('styles/noticiasParaValidar.css'); ?>">
<?php echo $this->endSection(); ?>
<?php echo $this->section('contenido'); ?>
<div class="grid-container">
  <div class="grid-x">
    <div class="cell medium-1"></div>
    <div class="cell medium-10">
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
            echo " <a href='#' class='button'>Ver Noticia</a> ";
            echo "<a href=" . "'" . base_url('publicar/' . $noticia['ID']) . "'" . "class='button success'>Publicar</a> ";
            echo "<button class='button alert' data-open='formRechazarModal' onclick='guardarValor(".$noticia['ID'].")'>Rechazar</button>";
            echo "</tr>";
          }
          ?>

        </tbody>
      </table>
    </div>
    <div class="cell medium-1"></div>
  </div>
</div>

<div class="reveal" id="formRechazarModal" data-reveal>
        
<form action="<?php echo base_url('rechazar');?>" method="post" style="margin-top: 25px;" >
  <input type="text" id="inputIdNoticia" name="idNoticia">
  <label for="motivo">Motivo rechazo (opcional)</label>
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