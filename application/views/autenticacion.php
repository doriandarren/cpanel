<!-- start Login box -->
<div class="container" id="login-block">
    <div class="row">
        <div class="col-sm-6 col-md-4 col-sm-offset-3 col-md-offset-4">
            <h3 class="animated bounceInDown">Login</h3>
            <div class="login-box clearfix animated flipInY">
                <div class="login-logo">
                    <a href="#"><img src="<?= base_url()."public/img/login-logo.png"?>" alt="Company Logo" /></a>
                </div> 
                <hr />
                <div class="login-form">
                    <div class="alert alert-error hide">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <h4>Error!</h4>
                        Your Error Message goes here
                    </div>
                    <?php
                    $attributes = array('name' => 'formx',
                        'id' => 'formx',
                        'class' => 'form-horizontal formular');
                    echo form_open('Autenticacion/autenticar', $attributes);
                    ?>
                        
                        <div class="form-group <?php
                        if (form_error('usuario')) {
                            echo 'has-error';
                        }
                        ?>">
                            <input type="text" name="usuario" class="form-control" placeholder="Usuario" value="<?= $usuario ?>" required autofocus>
                        <?= form_error('usuario'); ?>
                        </div>
                        <div class="form-group <?php
                        if (form_error('pass')) {
                            echo 'has-error';
                        }
                        ?>">
                            <input type="password" name="pass" class="form-control" placeholder="Contraseña" value="<?= $pass ?>" required>
                        <?= form_error('pass'); ?>
                        </div>
                        
                        <button type="submit" class="btn btn-red">Login</button> 
                    </form>	
                    <div class="login-links"> 
                        <a href="<?= site_url('forgot_password') ?>">
                            Olvidó su Contraseña?
                        </a>
                        <br />
                        <a href="<?= site_url('sing_up') ?>">
                            Crea una cuenta <strong>Sign Up</strong>
                        </a>
                    </div>      		
                </div> 			        	
            </div>
        </div>
    </div>
</div>









