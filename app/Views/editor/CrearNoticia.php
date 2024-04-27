<?php echo $this->extend('plantillas/layeoutAnonimo');?>
<?php echo $this->section('linkCss');?>
<link rel="stylesheet" href="<?php echo base_url('styles/crearNoticia.css');?>">
<?php echo $this->endSection();?>
<?php echo $this->section('contenido');?>
<div class="grid-x formContainer">
  <div class="cell small-1"></div>
  <div class="cell small-10 celdaFormulario">
    <h1>Crear Noticia</h1>
    <form action="<?php echo base_url('/crearnoticia/guardar')?>" method="post">
      <div class="grid-x grid-padding-x">
        <div class="small-7 medium-5 cell">
          <label for="titulo" class="">Titulo de noticia:
            <input type="text" id="titulo" name="titulo">
          </label>
        </div>
        <div class="small-5 cell">
          <p class="error">asdasdsadsa</p>
        </div>
      </div>
      <div class="grid-x grid-padding-x">
        <div class="small-7 medium-4 cell">
          <label for="imagen" class="">Imagen de noticia (opcional):
            <input type="file" id="imagen" name="imagen">
          </label>
        </div>
        <div class="small-5 cell">
          <p class="error">asdasdsadsa</p>
        </div>
      </div>
      <div class="grid-x grid-padding-x">
        <div class="small-7 medium-6 cell">
          <label for="descripcion" class="">Descripcion de noticia:
            <textarea name="descripcion" id="descripcion" cols="30" rows="10"></textarea>
          </label>
        </div>
        <div class="small-5 cell">
          <p class="error">asdasdsadsa</p>
        </div>
      </div>
      <div class="grid-x grid-padding-x">
        <div class="small-7 medium-5 cell">
            <label for="categoria" class="">Categoria:</label>
            <select name="categoria">
                <option value=1>Editor</option>
                <option value=2>Validador</option>
                <option value=3>Editor/Validador</option>
            </select>
        </div>
        <div class="small-5 cell">
          <p class="error">asdasdsadsa</p>
        </div>
      </div>
      <div class="grid-x grid-padding-x">
        <div class="small-2 cell">
            <label for="activado" class="">Activar noticia:</label>
            <input type="checkbox" class="switch-input" name="activado" id="Si-No" value=1>
            <label for="Si-No" class="switch-paddle">
              <span class="switch-active" aria-hidden="true">Si</span>
              <span class="switch-inactive" aria-hidden="true">No</span>
            </label>
        </div>
        <div class="small-10 cell">
          <p class="error">asdasdsadsa</p>
        </div>
      </div>
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

<?php echo $this->endSection();?>