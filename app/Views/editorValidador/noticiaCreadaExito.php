<?php echo $this->extend('plantillas/layeoutEditorValidador');?>
<?php echo $this->section('linkCss');?>
 <style>
h1{
    text-align: center;
    font-size: 2rem;
    margin-top: 100px;
}

.botonMisNoticias{
    display: block;
    width: 150px;
    margin: 0 auto;
    margin-top: 20px;
}

.containerIcono{
    text-align: center;
}

.icono{
    font-size: 55px;
    color: green;
}
 </style>
<?php echo $this->endSection();?>
<?php echo $this->section('contenido');?>
<div>
    <h1 class="tituloExito">La noticia fue creada exitosamente</h1>
    <div class="containerIcono"> <i class="bi bi-check-circle-fill icono"></i></div>

    <a href="<?php echo base_url('misnoticias')?>" class="button success botonMisNoticias">Ver mis Noticias</a>
</div>


<?php echo $this->endSection(); ?>