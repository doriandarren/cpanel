<div class="container" id="login-block">
    <div class="row">      
        <div class="col-sm-6 col-md-8 col-sm-offset-3 col-md-offset-2"> 
            <h3 class="animated bounceInDown">Recuperación de Contraseña</h3>
            <div class="contenedor clearfix animated rotateInUpRight">  
                <div class="login-form">
                    <?php
                    $attributes = array('name' => 'formx', 'id' => 'formx', 'class' => 'form-horizontal', 'role' => 'form');
                    echo form_open('forgot_password/guardar', $attributes);
                    ?> 
                    <div class="form-group <?php
                    if (form_error('email')) {
                        echo 'has-error';
                    }
                    ?>">
                        <div class="caja animated rollIn" id="email">
                            <input type="text" name="email" id="email" class="form-control" placeholder="Email" value="<?= $email ?>" required>
                            <?= form_error('email'); ?>
                        </div>
                    </div>
                    <div class="text-center animated rotateInUpRight">
                        <input type="submit" class="btn btn-red" value="Enviar" >
                    </div>
                    </form>
                    <div class="login-links"> 
                        <a href="<?= site_url('Autenticacion') ?>">
                            Volver
                        </a>
                        <br />
                    </div> 
                </div>
            </div>
        </div>
    </div>
</div>