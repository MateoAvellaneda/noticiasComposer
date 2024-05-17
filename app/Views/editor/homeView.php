<?php echo $this->extend('plantillas/layeoutEditor'); ?>
<?php echo $this->section('linkCss'); ?>
<style>
    .imagenLogoGrande {
        width: 350px;
    }

    .textoBienvenida {
        margin-top: 35px;
        margin-bottom: 35px;
        text-align: center;
    }

    .contenedorImangen {
        text-align: center;
    }

    .textoHome{
        margin: 50px 30px;
        font-size: 1.1rem;
    }
</style>
<?php echo $this->endSection(); ?>
<?php echo $this->section('contenido'); ?>
<h1 class="textoBienvenida">Bienvenido al portal de noticias</h1>
<div class="contenedorImangen">
    <img src="<?php echo base_url('/logo.png') ?>" alt="" class="imagenLogoGrande">
</div>
<p class="textoHome">En nuestra empresa, reconocemos la importancia de mantener a nuestro equipo informado y conectado. Por eso, te damos la bienvenida a nuestra plataforma de noticias internas, donde encontrarás las últimas actualizaciones, eventos y logros de nuestra empresa.

    Nos esforzamos por mantener una comunicación transparente y abierta con todos nuestros empleados. Aquí, podrás acceder a información clave sobre proyectos en curso, cambios organizacionales, anuncios de nuevos productos, reconocimientos a colegas destacados y más.</p>

<?php echo $this->endSection(); ?>