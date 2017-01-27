<div class="col-md-12 text-center">
    <h1>USUARIOS TIPOS</h1>
</div> 
<div class="col-md-12">
    <a href="<?= site_url('admin/usuarios_tipos/nueva') ?>" class="btn btn-success">Nueva</a>
</div>

   
<div class="row">         
    <?php
    if ($datos) {
        ?>       
        <div class="col-md-12 table-responsive w-margen-50">                    
            <table class="table" id="mi_tabla">
                <thead>
                    <tr>
<th>#</th><th>ID</th><th>DESCRIPCION</th><th>ESTATUS</th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    foreach ($datos as $row) {
                        ?>
                        <tr>
<td><?= $i ?></td><td><?= $row->id?></td><td><?= $row->descripcion?></td><td><?= $row->estatus?></td><td>
                                <a href="<?= site_url('admin/usuarios_tipos/nueva') . '/' . $row->id ?>" class="btn btn-info">Editar</a>
                                <a href="<?= site_url('admin/usuarios_tipos/eliminar') . '/' . $row->id ?>" class="btn btn-danger" title="Eliminar" onclick="return confirm('Eliminar este Registro?')">Eliminar</a>
                            </td>
            
                        </tr>                      
                        <?php
                        $i++;
                    }
                ?>        
            </tbody>                        
        </table>                    
    </div>
    <?php } ?>
</div>
