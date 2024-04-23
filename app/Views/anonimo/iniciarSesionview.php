<?php echo $this->extend('plantillas/layeoutAnonimo');?>
<?php echo $this->section('linkCss');?>
<link rel="stylesheet" href="<?php echo base_url('styles/iniciarSesion.css');?>">
<?php echo $this->endSection();?>
<?php echo $this->section('contenido');?>
    <div class="formContainer grid-x">
        <div class="cell small-2"></div>
        <div class="cell small-8 celdaFormulario">
            <h1>Iniciar Sesion</h1>
            <form>
                <div class="grid-x grid-padding-x">
                    <div class="small-3 cell">
                        <label for="right-label" class="text-right">Nombre de usuario:</label>
                    </div>
                    <div class="small-6 cell">
                        <input type="text" id="right-label" placeholder="Fulanito123">
                    </div>
                </div>
                <div class="grid-x grid-padding-x">
                    <div class="small-3 cell">
                        <label for="right-label" class="text-right">Contraseña:</label>
                    </div>
                    <div class="small-6 cell">
                        <input type="password" id="right-label">
                    </div>
                </div>
                <div class="grid-x grid-padding-x">
                    <div class="small-4 cell"></div>
                    <div class="small-4 cell">
                        <label for="subm" class="submit button success expanded">Iniciar Sesion</label>
                        <input type="submit" id="subm" class="hide">
                    </div>
                    <div class="small-4 cell"></div>
                </div>
            </form>
            <div class="grid-x">
                <div class="cell small-3"></div>
                <div class="cell small-6" style="text-align: center;">
                    <a href="" >No tienes una cuenta? Registrate aqui!</a>
                </div>
                <div class="cell small-3"></div>
            </div>
        </div>
        <div class="cell small-2"></div>
    </div>
<?php echo $this->endSection();?>