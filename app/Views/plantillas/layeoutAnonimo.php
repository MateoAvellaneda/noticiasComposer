<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Noticias</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/foundation/foundation.css');?>">
    <?php 
        echo $this->renderSection("linkCss");
    ?>
</head>
<body>
    <div class="top-bar">
    <div class="top-bar-left">
        <ul class="dropdown menu" data-dropdown-menu>
        <li class="menu-text">Site Title</li>
        <li>
            <a href="#">One</a>
            <ul class="menu vertical">
            <li><a href="#">One</a></li>
            <li><a href="#">Two</a></li>
            <li><a href="#">Three</a></li>
            </ul>
        </li>
        <li><a href="#">Two</a></li>
        <li><a href="#">Three</a></li>
        </ul>
    </div>
    <div class="top-bar-right">
        <ul class="menu">
        <li><a class="button success" href="http://localhost/noticiasComposer/public/iniciarsesion" style="margin-right:3px ;">Iniciar sesion</a></li>
        <li><a class="button success" href="http://localhost/noticiasComposer/public/registrarse">Registrarse</a></li>
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