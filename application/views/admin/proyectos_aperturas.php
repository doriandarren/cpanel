<div class="col-md-12 text-center">
    <h1>PROYECTOS APERTURAS</h1>
</div> 
<div class="col-md-12">
    <a href="<?= site_url('admin/proyectos_aperturas/nueva') ?>" class="btn btn-success">Nueva</a>
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
                        <th>DESCRIPCION</th>
                        <th>FECHA INICIO</th>
                        <th>FECHA FIN</th>
                        <th>INVERSION</th>
                        <th>GASTOS</th>
                        <th>PROYECTOS ESTATUS ID</th>
                        <th>PROYECTOS DEFINICIONES ID</th>
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
                            <td><?= $row->descripcion ?></td>
                            <td><?= $row->fecha_inicio ?></td>
                            <td><?= $row->fecha_fin ?></td>
                            <td><?= $row->inversion ?></td>
                            <td><?= $row->gastos ?></td>
                            <td><?= $row->des_estatus ?></td>
                            <td><?= $row->des_proyecto ?></td>
                            <td>
                                <a href="<?= site_url('admin/proyectos_aperturas/nueva') . '/' . $row->id ?>" class="btn btn-info">Editar</a>
                                <a href="<?= site_url('admin/proyectos_aperturas/eliminar') . '/' . $row->id ?>" class="btn btn-danger" title="Eliminar" onclick="return confirm('Eliminar este Registro?')">Eliminar</a>
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