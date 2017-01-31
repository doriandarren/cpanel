<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Panel klarenz! <small>Proyectos</small>
        </h1>        
    </div>
</div>
<!-- /.row -->

<div class="row">
    <div class="col-lg-12 col-md-12">
        <table id="grid"></table>
        <div id="paginacion"></div>
        
        
    </div>
</div>


<!--JS-->
<script src="<?= base_url("public/js/jquery-2.2.0.min.js") ?>"></script> 
<script src="<?= base_url("public/js/jquery-ui.min.js") ?>"></script> 
<script src="<?= base_url("public/js/bootstrap.js") ?>"></script> 
<script src="<?= base_url("public/js/comun.js") ?>"></script>  
<script src="<?= base_url("public/js/jqgrid/grid.locale-es.js") ?>"></script>
<script src="<?= base_url("public/js/jqgrid/jquery.jqgrid.min.js") ?>"></script>
<script src="<?= base_url("public/js/jqgrid/ui.multiselect.js") ?>"></script>

<script type="text/javascript">
    $(document).ready(function () {        
        //define handler for 'editSubmit' event
        var fn_addSubmit=function(response,postdata){            
            var json=response.responseText; //in my case response text form server is "{sc:true,msg:''}"
            var result=eval("("+json+")"); //create js object from server reponse
            return [result.sc,result.msg,null]; 
        }        
        
        var addOptions = {
            url: baseurl + 'admin/proyectos/agregar_proyectos',
            width: 500,
            closeOnEscape: true,
            height: "auto",
            afterSubmit: fn_addSubmit
        };      
        
        
        jQuery("#grid").jqGrid({
            url: baseurl + 'admin/proyectos/buscar_proyectos',
            datatype: 'json',
            mtype: 'POST',
            colNames: ['accions','ID', 'DESCRIPCION', 'INICIO', 'FIN', 'INVERSION', 'ESTATUS', 'PROYECTO'],
            colModel: [
                {name: 'accions', index: 'accions', resizable: false, align: "center", formatter:"actions"},
                {name: 'id', index: 'id', resizable: false, align: "center"},
                {name: 'descripcion', index: 'descripcion', resizable: false, sortable: true, editable:true},
                {name: 'fecha_inicio', index: 'inicio', resizable: false, editable:true},
                {name: 'fecha_fin', index: 'fin', resizable: false, editable:true},
                {name: 'inversion', index: 'inversion', resizable: false, editable:true},
                {name: 'proyectos_estatus_id', index: 'estatus', resizable: false, editable:true},
                {name: 'proyectos_definiciones_id', index: 'proyectos', resizable: false, editable:true}
            ],
            pager: '#paginacion',
            gridview: true,
            rowNum: 10,
            rowList: [15, 30],
            sortname: 'id',
            sortorder: 'asc',
            viewrecords: true,
            editurl: baseurl + 'admin/proyectos/editar_proyectos',
            caption: 'PROYECTOS'
        }).navGrid('#paginacion',
            {add:true, del:false, edit:false},
            null,  // parámetros para la modificación
            addOptions,   // parámetros para el alta
            null // parámetros para la eliminación       
        );
        
    });
 
 

 
 
</script>


<script type="text/javascript">         
    $.jgrid.no_legacy_api = true;
    $.jgrid.useJSON = true;
    var lastSelection;
    </script>

</body>
</html>