<div class="col-md-12 text-center">
    <h1>OBJETIVOS ESPECIFICOS</h1>
</div> 
<div class="col-md-12">
    <a href="<?= site_url('admin/objetivos_especificos/nueva') ?>" class="btn btn-success">Nueva</a>
</div>

   
<div class="row">         
    <?php
    if ($datos) {
        ?>       
        <div class="col-md-12 table-responsive w-margen-50">                    
            <table class="table" id="mi_tabla">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>ID</th>
                        <th>NOMBRE</th>
                        <th>DESCRIPCION</th>
                        <th>FECHA INICIO</th>
                        <th>FECHA FIN</th>
                        <th>PORCENTAJE AVANCE</th>
                        <th>PROYECTOS ID</th>
                        <th>PROYECTOS ESTATUS ID</th>
                        <th>ACCION</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    foreach ($datos as $row) {
                        ?>
                        <tr>
                            <td><?= $i ?></td>
                            <td><?= $row->id?></td>
                            <td><?= $row->nombre?></td>
                            <td><?= $row->descripcion?></td>
                            <td><?= $row->fecha_inicio?></td>
                            <td><?= $row->fecha_fin?></td>
                            <td><?= $row->porcentaje_avance?></td>
                            <td><?= $row->proyectos_id?></td>
                            <td><?= $row->proyectos_estatus_id?></td>
                            <td>
                                <a href="<?= site_url('admin/objetivos_especificos/nueva') . '/' . $row->id ?>" class="btn btn-info">Editar</a>
                                <a href="<?= site_url('admin/objetivos_especificos/eliminar') . '/' . $row->id ?>" class="btn btn-danger" title="Eliminar" onclick="return confirm('Eliminar este Registro?')">Eliminar</a>
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
