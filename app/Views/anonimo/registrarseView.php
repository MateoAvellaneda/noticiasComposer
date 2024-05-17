<?php echo $this->extend('plantillas/layeoutAnonimo');?>
<?php echo $this->section('linkCss');?>
<link rel="stylesheet" href="<?php echo base_url('styles/registrarse.css');?>">
<?php echo $this->endSection();?>
<?php echo $this->section('contenido');?>
<div class="grid-x formContainer">
  <div class="cell small-2"></div>
  <div class="cell small-8 celdaFormulario">
    <h1>Formulario de registro</h1>
    <form action="<?php echo base_url('/registrarse/registrarusuario')?>" method="post">
        <div class="grid-x grid-padding-x">
            <div class="small-3 cell">
                <label for="nickname" class="text-right">Nombre de usuario:</label>
            </div>
            <div class="small-6 cell">
                <input type="text" id="nickname" name="nickname" placeholder="Fulanito123" value="<?php echo set_value("nickname"); ?>">
            </div>
        </div>
        <div class="grid-x grid-padding-x">
            <div class="small-12 cell">
                <p class="text-center error"><?php echo validation_show_error('nickname');?></p>
            </div>
        </div>
        <div class="grid-x grid-padding-x">
            <div class="small-3 cell">
                <label for="pass" class="text-right">Contraseña:</label>
            </div>
            <div class="small-6 cell">
                <input type="password" id="pass" name="pass">
            </div>
        </div>
        <div class="grid-x grid-padding-x">
            <div class="small-12 cell">
                <p class="text-center error"><?php echo validation_show_error('pass');?></p>
            </div>
        </div>
        <div class="grid-x grid-padding-x">
            <div class="small-3 cell">
                <label for="pass2" class="text-right">Confirmar contraseña:</label>
            </div>
            <div class="small-6 cell">
                <input type="password" id="pass2" name="pass2">
            </div>
        </div>
        <div class="grid-x grid-padding-x">
            <div class="small-12 cell">
                <p class="text-center error"><?php echo validation_show_error('pass2');?></p>
            </div>
        </div>
        <div class="grid-x grid-padding-x">
            <div class="small-3 cell">
                <label for="email" class="text-right">Correo Electrónico:</label>
            </div>
            <div class="small-6 cell">
                <input type="email" id="email" name="email" value="<?php echo set_value("email"); ?>">
            </div>
        </div>
        <div class="grid-x grid-padding-x">
            <div class="small-12 cell">
                <p class="text-center error"><?php echo validation_show_error('email');?></p>
            </div>
        </div>
        <div class="grid-x">
            <div class="small-6 cell">
                <div class="grid-x grid-padding-x float-right">
                        <div class="small-3 cell">
                            <label for="nombre" class="text-right">Nombre:</label>
                        </div>
                        <div class="small-8 cell">
                            <input type="text" id="nombre" name="nombre" value="<?php echo set_value("nombre"); ?>">
                        </div>
                </div>
            </div>
            <div class="small-6 cell">
                <div class="grid-x grid-padding-x">
                        <div class="small-3 cell">
                            <label for="apellido" class="text-right">Apellido:</label>
                        </div>
                        <div class="small-6 cell">
                            <input type="text" id="apellido" name="apellido" value="<?php echo set_value("apellido"); ?>">
                        </div>
                </div>
            </div>
        </div>
        <div class="grid-x grid-padding-x">
            <div class="small-12 cell">
                <p class="text-center error"><?php echo validation_show_error('nombre');?></p>
            </div>
        </div>
        <div class="grid-x grid-padding-x">
            <div class="small-12 cell">
                <p class="text-center error"><?php echo validation_show_error('apellido');?></p>
            </div>
        </div>
        <div class="grid-x grid-padding-x">
            <div class="small-3 cell">
                <label for="rol" class="text-right">Rol:</label>
            </div>
            <div class="small-6 cell">
                <select name="rol">
                    <option value=1>Editor</option>
                    <option value=2>Validador</option>
                    <option value=3>Editor/Validador</option>
                </select>
            </div>
        </div>
        <div class="grid-x grid-padding-x">
            <div class="small-12 cell">
                <p class="text-center error"><?php echo validation_show_error('rol');?></p>
            </div>
        </div>
        <div class="grid-x grid-padding-x">
            <div class="small-4 cell"></div>
            <div class="small-4 cell">
                <label for="subm" class="submit button success expanded">Registrarse</label>
                <input type="submit" id="subm" class="hide">
            </div>
            <div class="small-4 cell"></div>
        </div>
    </form>
  </div>
  <div class="cell small-2"></div>
</div>
<?php echo $this->endSection();?>
