<?php echo $this->extend('plantillas/layeoutEditorValidador');?>
<?php echo $this->section('linkCss');?>
<link rel="stylesheet" href="<?php echo base_url('styles/crearNoticia.css');?>">
<?php echo $this->endSection();?>
<?php echo $this->section('contenido');?>
<div class="grid-x formContainer">
  <div class="cell small-1"></div>
  <div class="cell small-10 celdaFormulario">
    <h1>Crear Noticia</h1>
    <form action="<?php echo base_url('/crearnoticia/guardar')?>" method="post" enctype="multipart/form-data">
      <div class="grid-x grid-padding-x">
        <div class="small-7 medium-5 cell">
          <label for="titulo" class="">Título de la noticia:
            <input type="text" id="titulo" name="titulo" value="<?php echo set_value("titulo"); ?>">
          </label>
        </div>
        <div class="small-5 cell">
          <p class="error"><?php echo validation_show_error('titulo');?></p>
        </div>
      </div>
      <div class="grid-x grid-padding-x">
        <div class="small-7 medium-4 cell">
          <label for="imagen" class="">Imagen de la noticia (opcional):
            <input type="file" id="imagen" name="imagen" accept="image/png, image/jpeg, image/jpg">
          </label>
        </div>
        <div class="small-5 cell">
          <p class="error"><?php echo validation_show_error('imagen');?></p>
        </div>
      </div>
      <div class="grid-x grid-padding-x">
        <div class="small-7 medium-6 cell">
          <label for="descripcion" class="">Descripción de la noticia:
            <textarea name="descripcion" id="descripcion" cols="30" rows="10"><?php echo set_value("descripcion"); ?></textarea>
          </label>
        </div>
        <div class="small-5 cell">
          <p class="error"><?php echo validation_show_error('descripcion');?></p>
        </div>
      </div>
      <div class="grid-x grid-padding-x">
        <div class="small-7 medium-5 cell">
            <label for="categoria" class="">Categoría:</label>
            <select name="categoria">
                <?php
                    foreach ($categorias as $categoria) {
                            echo "<option value=".$categoria['ID'].">".$categoria['nombre'] . "</option>";
                        
                    }
                ?>
            </select>
        </div>
        <div class="small-5 cell">
          <p class="error"><?php echo validation_show_error('categoria');?></p>
        </div>
      </div>
      <?php
        if(isset($error)){
          echo "<p class='error'>. $error .</p>";
        }
      ?>
      <div class="grid-x grid-padding-x">
        <div class="small-4 cell"></div>
        <div class="small-4 cell">
          <label for="borrador" class="submit button success">Guardar en borrador</label>
          <input type="submit" id="borrador" name="borrador" class="hide">
          <label for="validar" class="submit button success">Enviar a validar</label>
          <input type="submit" id="validar" name="validar" class="hide">
        </div>
        <div class="small-4 cell"></div>
      </div>
    </form>
  </div>
  <div class="cell small-1"></div>
</div>
<?php echo $this->endSection();?>