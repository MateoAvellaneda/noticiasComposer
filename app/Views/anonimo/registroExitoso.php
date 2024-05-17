<?php echo $this->extend('plantillas/layeoutAnonimo');?>
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

    <h1 class="tituloExito">Su cuenta de usuario se registro correctamente</h1>
    <div class="containerIcono"> <i class="bi bi-check-circle-fill icono"></i></div>
    <a href="<?php echo base_url('iniciarsesion')?>" class="button success botonMisNoticias">Iniciar Sesion</a>

<?php echo $this->endSection(); ?>