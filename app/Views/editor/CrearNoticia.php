<?php echo $this->extend('plantillas/layeoutAnonimo');?>
<?php echo $this->section('linkCss');?>
<link rel="stylesheet" href="<?php echo base_url('styles/crearNoticia.css');?>">
<?php echo $this->endSection();?>
<?php echo $this->section('contenido');?>
<div class="grid-x formContainer">
  <div class="cell small-1"></div>
  <div class="cell small-10 celdaFormulario">
    <h1>Crear Noticia</h1>
    <form action="<?php echo base_url('/registrarse/registrarusuario')?>" method="post">
    
    </form>
  </div>
  <div class="cell small-1"></div>

<?php echo $this->endSection();?>