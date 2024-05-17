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
        .responsive-blog-footer {
            background: #4a4a4a;
            padding: 3rem 3rem;
            color: white;
            margin-top: 40px;
        }

        @media screen and (max-width: 39.9375em) {
            .responsive-blog-footer h4 {
                font-size: 1.5rem;
            }
        }

        .responsive-blog-footer p {
            color: #8a8a8a;
        }

        .responsive-blog-footer .mailing-list {
            margin-bottom: 1.5rem;
        }

        .responsive-blog-footer .mailing-container {
            margin-bottom: 2rem;
        }

        .responsive-blog-footer .about-section,
        .responsive-blog-footer .tag-section {
            margin-bottom: 2rem;
        }

        .responsive-blog-footer .about-section a,
        .responsive-blog-footer .tag-section a {
            color: #1779ba;
        }

        .responsive-blog-footer .subscribe-button {
            background-color: #1779ba;
        }

        .responsive-blog-footer .subscribe-button:hover {
            background-color: #146aa3;
            transition: color 0.3s ease-in;
        }

        .responsive-blog-footer .fa-chevron-circle-up {
            font-size: 3rem;
            color: #8a8a8a;
        }

        .responsive-blog-footer .fa-chevron-circle-up:hover {
            color: #b0b0b0;
            transition: color 0.3s ease-in;
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

<footer class="responsive-blog-footer">
        <div class="row">
            <div class="medium-8 columns small-order-2 medium-order-1 about-container">
                <div class="row">
                    <div class="hide-for-small-only medium-4 columns about-section">
                        <img src="<?php echo base_url('logo.png') ?>" alt="logotipo" class="logoImg" width="150px">
                    </div>
                    <div class="medium-8 columns about-section">
                        <h4>Sobre nosotros</h4>
                        <p>Nosotros nos dedicamos a proporcionar a nuestros lectores una cobertura noticiosa oportuna, precisa y perspicaz. Nuestra misión es mantenerte informado sobre los eventos y tendencias que dan forma a nuestro mundo, desde noticias de última hora y análisis profundos hasta reportajes especiales y opiniones de expertos.</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script type="text/javascript" src="<?php echo base_url("assets/foundation/jquery.js"); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url("assets/foundation/foundation.js"); ?>"></script>
    <script>
      $(document).foundation();
    </script>
</body>
</html>