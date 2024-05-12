<?php echo $this->extend('plantillas/layeoutEditor');?>
<?php echo $this->section('linkCss');?>
<link rel="stylesheet" href="<?php echo base_url('styles/editarNoticia.css');?>">
<?php echo $this->endSection();?>
<?php echo $this->section('contenido');?>
    <h1>Editor de Noticias</h1>
    <a href='#' class='button secondary buttonVolver'>Volver</a> 
<div class="grid-x formContainer">
  <div class="cell small-1"></div>
  <div class="cell small-10 celdaFormulario">
    <h1>Editar Noticia</h1>
    <form action="<?php echo base_url('/editarnoticia/editar/' .  $valuesNoticia['ID'])?>" method="post" enctype="multipart/form-data">
      <div class="grid-x grid-padding-x">
        <div class="small-7 medium-5 cell">
          <label for="titulo" class="">Titulo de noticia:
            <input type="text" id="titulo" name="titulo" value="<?php echo $valuesNoticia['titulo'];?>">
          </label>
        </div>
        <div class="small-5 cell">
          <p class="error"><?php echo validation_show_error('titulo');?></p>
        </div>
      </div>
      <div class="grid-x grid-padding-x">
        <div class="small-7 medium-4 cell">
          <label for="imagen" class="">Imagen de noticia (opcional):
            <img src="<?php echo base_url($valuesNoticia['urlImagen']);?>" alt="">
            <input type="file" id="imagen" name="imagen" accept="image/png, image/jpeg, image/jpg">
          </label>
        </div>
        <div class="small-5 cell">
          <p class="error"><?php echo validation_show_error('imagen');?></p>
        </div>
      </div>
      <div class="grid-x grid-padding-x">
        <div class="small-7 medium-6 cell">
          <label for="descripcion" class="">Descripcion de noticia:
            <textarea name="descripcion" id="descripcion" cols="30" rows="10"><?php echo $valuesNoticia['descripcion'];;?></textarea>
          </label>
        </div>
        <div class="small-5 cell">
          <p class="error"><?php echo validation_show_error('descripcion');?></p>
        </div>
      </div>
      <div class="grid-x grid-padding-x">
        <div class="small-7 medium-5 cell">
            <label for="categoria" class="">Categoria:</label>
            <select name="IDcategoria">
                <?php
                    foreach ($categorias as $categoria) {
                        if($categoria['ID'] == $valuesNoticia['IDcategoria']){
                            echo "<option value=".$categoria['ID']." selected>".$categoria['nombre'] . "</option>";
                        }else{
                            echo "<option value=".$categoria['ID'].">".$categoria['nombre'] . "</option>";
                        }
                    }
                ?>
                <!-- <option value=1>Editor</option>
                <option value=2>Validador</option>
                <option value=3>Editor/Validador</option> -->
            </select>
        </div>
        <div class="small-5 cell">
          <p class="error"><?php echo validation_show_error('categoria');?></p>
        </div>
      </div>
      <div class="errorContainer">
        <?php
          if(isset($error)){
            echo "<p class='error'>". $error ."</p>";
          }
        ?>
      </div>
      <div class="grid-x grid-padding-x">
        <div class="small-4 cell"></div>
        <div class="small-4 cell">
            <label for="validar" class="submit button success expanded">Guardar Cambios</label>
            <input type="submit" id="validar" name="validar" class="hide">
        </div>
        <div class="small-4 cell"></div>
      </div>
    </form>
  </div>
  <div class="cell small-1"></div>
</div>
<?php echo $this->endSection();?>