<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Noticias</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/foundation/foundation.css');?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap-icons-1.11.3/font/bootstrap-icons.css')?>">
    <?php 
        echo $this->renderSection("linkCss");
    ?>
        <style>
        @font-face {
        font-family: FrankRuh;
        src: url("<?php echo base_url('assets/font/FrankRuhlLibre-VariableFont_wght.ttf')?>");
        }

        *, h1, h2, h3{
            font-family: FrankRuh;
        }
    </style>
</head>
<body>
    <div class="top-bar">
    <div class="top-bar-left">
        <ul class="dropdown menu" data-dropdown-menu>
        <li class="menu-text logo"><img src="<?php echo base_url('logo.png')?>" alt="logotipo" class="logoImg" style="width: 80px; "></li>
        <li style="margin-top: 20px;"><a href="<?php echo base_url()?>">Inicio</a></li>
        <li style="margin-top: 20px;"><a href="<?php echo base_url('listarNoticias/1')?>">Últimas Noticias</a></li>
        <li style="margin-top: 20px;">
            <a href="<?php echo base_url('noticiasValidar')?>">Noticias para validar</a>
        </li>
        <li style="margin-top: 20px;"><a href="<?php echo base_url('misValidaciones')?>">Mis validaciones recientes</a></li>
        </ul>
    </div>
    <div class="top-bar-right">
        <ul class="menu">
        <li><a class="button alert" href="http://localhost/noticiasComposer/public/cerrarsesion">Cerrar sesión</a></li>
        </ul>
    </div>
    </div>
      
    <?php 
        echo $this->renderSection("contenido");
    ?>

    <script type="text/javascript" src="<?php echo base_url("assets/foundation/jquery.js"); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url("assets/foundation/foundation.js"); ?>"></script>
    <script>
      $(document).foundation();
    </script>
</body>
</html>