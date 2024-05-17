<?php echo $this->extend('plantillas/layeoutValidador');?>
<?php echo $this->section('linkCss'); ?>
<link rel="stylesheet" href="<?php echo base_url('styles/verNoticia.css'); ?>">
<?php echo $this->endSection(); ?>
<?php echo $this->section('contenido');?>
<div class="grid-x formContainer">
    <div class="cell small-1 containerLateral"></div>
    <div class="cell small-10 containerCentral">
    <p class="fechaNoticia">
            <?php
                echo $fecha;
            ?>
        </p>
        <p class="categoriaNoticia">
            <?php
                echo $categoria;
            ?>
        </p>
        <h1 class="tituloNoticia">
            <?php echo $titulo;?>
        </h1>
        <?php 
            if(!empty($urlImagen)){
                echo "<div class='imagenContainer' style='background-image:url(" . base_url($urlImagen) .")'> </div>";
            }
        ?>
        <p class="descripcionNoticia">
            <?php
            echo $descripcion;
            ?>
        </p>
    </div>
    <div class="cell small-1 containerLateral"></div>
</div>

<?php echo $this->endSection();?>