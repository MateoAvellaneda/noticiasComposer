<?php echo $this->extend('plantillas/layeoutEditor');?>
<?php echo $this->section('linkCss'); ?>
<link rel="stylesheet" href="<?php echo base_url('styles/listarNoticias.css'); ?>">
<?php echo $this->endSection(); ?>
<?php echo $this->section('contenido');?>
<div class="grid-x containerr">
    <div class="cell small-1 containerLateral"></div>
    <div class="cell small-10 containerCentral">
        <h1>Últimas Noticias</h1>
        <div class="containerNoticias">
            <?php
                foreach($noticias as $noticia){
                    echo "<a href='".base_url('verNoticia/'. $noticia['ID'])."'>";
                    echo "<div class='noticia'>";
                    echo "<h2>" . $noticia['titulo'] . "</h2>";
                    if(!empty($noticia['urlImagen'])){
                        echo "<div class='imgContainer' style='background-image:url(" . base_url($noticia['urlImagen']) .")'>";
                        echo "</div>";
                    }
                    echo "</div>";
                }
            ?>
        </div>

        <div class="containerPaginador">
                <?php
                    $cantidadPaginas = ceil($cantidadNoticias/6);
                    for($i=1; $i <= $cantidadPaginas; $i++){
                        if($numeroPagina == $i){
                            echo "<a href="."'".base_url('listarNoticias/' . $i)."' class='pagina paginaDesactivada'>" . $i . "</a>"; 
                        }else{
                            echo "<a href="."'".base_url('listarNoticias/' . $i)."' class='pagina'>" . $i . "</a>"; 
                        }
                        
                    }
                ?>
        </div>
    </div>
    <div class="cell small-1 containerLateral"></div>
</div>


<?php echo $this->endSection();?>