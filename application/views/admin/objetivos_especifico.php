<div class="row">
    <div class="col-md-12 text-center">
        <h1>OBJETIVOS ESPECIFICO</h1>
    </div>
</div>           
<div class="row">
    <div class="panel panel-info">
        <div class="panel-heading">
            FORMULARIO DE REGISTRO
        </div>
        <div class="panel-body"><?php
            $attributes = array('name' => 'formx',
                'id' => 'formx',
                'class' => 'form-horizontal formular',
                'role' => 'form');
            echo form_open('admin/objetivos_especificos/guardar/', $attributes);
            ?>
            <input type="hidden" name="id" value="<?= $id ?>">
            <div class="form-group">
                <label for="nombre" class="control-label col-sm-2">Nombre</label>
                <div class="col-sm-4">
                    <input type="text" name="nombre" id="nombre" 
                           class="form-control" value="<?= $nombre ?>" placeholder="nombre">
                </div><?= form_error('nombre'); ?>
            </div>
            <div class="form-group">
                <label for="descripcion" class="control-label col-sm-2">Descripcion</label>
                <div class="col-sm-4">
                    <input type="text" name="descripcion" id="descripcion" 
                           class="form-control" value="<?= $descripcion ?>" placeholder="descripcion">
                </div><?= form_error('descripcion'); ?>
            </div>
            <div class="form-group">
                <label for="fecha_inicio" class="control-label col-sm-2">Fecha Inicio</label>
                <div class="col-sm-4">
                    <input type="datetime" name="fecha_inicio" id="fecha_inicio" 
                           class="form-control" value="<?= $fecha_inicio ?>" placeholder="fecha_inicio">
                </div><?= form_error('fecha_inicio'); ?>
            </div>
            <div class="form-group">
                <label for="fecha_fin" class="control-label col-sm-2">Fecha Fin</label>
                <div class="col-sm-4">
                    <input type="datetime" name="fecha_fin" id="fecha_fin" 
                           class="form-control" value="<?= $fecha_fin ?>" placeholder="fecha_fin">
                </div><?= form_error('fecha_fin'); ?>
            </div>
            <div class="form-group">
                <label for="porcentaje_avance" class="control-label col-sm-2">Porcentaje Avance</label>
                <div class="col-sm-4">
                    <input type="text" name="porcentaje_avance" id="porcentaje_avance" 
                           class="form-control" value="<?= $porcentaje_avance ?>" placeholder="porcentaje_avance">
                </div><?= form_error('porcentaje_avance'); ?>
            </div>
            <div class="form-group">
                <label for="proyectos_id" class="col-sm-2 control-label">proyectos</label> 
                <div class="col-sm-4">
                    <select name="proyectos_id" class="form-control" id="proyectos_id">
                        <?php
                        echo "<option value=''>Seleccione</option>";
                        foreach ($lista_proyectos as $rows) {
                            if (proyectos_id == $rows->id) {
                                echo "<option value=" . $rows->id . " selected>" . $rows->descripcion . "</option>";
                            } else {
                                echo "<option value=" . $rows->id . ">" . $rows->descripcion . "</option>";
                            }
                        }
                        ?>
                    </select>
            <?php echo form_error('proyectos_id'); ?>
                </div>
            </div>
            <div class="form-group">
                <label for="proyectos_estatus_id" class="col-sm-2 control-label">proyectos estatus</label> 
                <div class="col-sm-4">
                    <select name="proyectos_estatus_id" class="form-control" id="proyectos_estatus_id">
                        <?php
                        echo "<option value=''>Seleccione</option>";
                        foreach ($lista_proyectos_estatus as $rows) {
                            if (proyectos_estatus_id == $rows->id) {
                                echo "<option value=" . $rows->id . " selected>" . $rows->descripcion . "</option>";
                            } else {
                                echo "<option value=" . $rows->id . ">" . $rows->descripcion . "</option>";
                            }
                        }
                        ?>
                    </select>
            <?php echo form_error('proyectos_estatus_id'); ?>
                </div>
            </div>
            <div class="col-sm-4 col-sm-offset-6">
                <button type="submit" id="consultar" class="btn btn-primary">Guardar</button>
            </div>
            </form>

        </div>
    </div>
</div>

