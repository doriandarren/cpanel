<div class="container" id="login-block">
    <div class="row">      
        <div class="col-sm-6 col-md-8 col-sm-offset-3 col-md-offset-2">
            <?php if (isset($msj) && count($msj) > 0) { ?>    
                <div class="container">
                    <div class="row" id='transaccion'>    
                        <div class="col-md-4 col-md-offset-2 <?= $msj[0] ?>" role="alert">
                            <?= $msj[1] ?>
                        </div>
                    </div> 
                </div>
                <?php
            }
            ?>            
            <h3 class="animated bounceInDown">Registrese con nosotros!</h3>
            <div class="contenedor clearfix animated rotateInUpRight"> 
                <div class="login-form">                    
                    <?php
                    $attributes = array('name' => 'formx', 
                        'id' => 'formx', 
                        'class' => 'form-horizontal', 
                        'role' => 'form');
                    echo form_open('sing_up/guardar', $attributes);
                    ?> 
                    <input type="hidden" name="id" value="<?= $id ?>">       

                    <div class="form-group <?php
                    if (form_error('nombre')) {
                        echo 'has-error';
                    }
                    ?>">
                        <div class="caja animated rollIn" id="nombre">
                            <input type="text" name="nombre" id="nombre" class="form-control" placeholder="nombre" value="<?= $nombre ?>" required>
                            <?= form_error('nombre'); ?>
                        </div>
                    </div>

                    <div class="form-group <?php
                    if (form_error('acronimo')) {
                        echo 'has-error';
                    }
                    ?>">
                        <div class="caja animated rollIn" id="acronimo">
                            <input type="text" name="acronimo" id="acronimo" class="form-control" placeholder="Usuario" value="<?= $acronimo ?>" required>
                            <?= form_error('acronimo'); ?>
                        </div>
                    </div>

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

                    <div class="form-group <?php
                    if (form_error('clave')) {
                        echo 'has-error';
                    }
                    ?>">
                        <div class="caja animated rollIn" id="clave">
                            <input type="password" name="clave" id="clave" class="form-control" placeholder="Contraseña" value="<?= $clave ?>" required>
                            <?= form_error('clave'); ?>
                        </div>
                    </div>

                    <div class="form-group <?php
                    if (form_error('reclave')) {
                        echo 'has-error';
                    }
                    ?>">
                        <div class="caja animated rollIn" id="reclave">
                            <input type="password" name="reclave" id="reclave" class="form-control" placeholder="Confirma Contraseña" value="<?= $reclave ?>" required>
                            <?= form_error('reclave'); ?>
                        </div>
                    </div>
                    <div class="text-center animated rotateInUpRight">
                        <input type="submit" class="btn btn-red" value="Registrar" >
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
