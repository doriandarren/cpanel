<?php

defined('BASEPATH') OR exit('No direct script access allowed');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title><?= $title_head?></title>
    
    <!--CSS-->
    <link href="<?= base_url("public/css/bootstrap.min.css") ?>" rel="stylesheet" />
    <link href="<?= base_url("public/css/sb-admin.css")?>" rel="stylesheet" type="text/css"/>
    <link href="<?= base_url("public/font-awesome/css/font-awesome.css")?>" rel="stylesheet" type="text/css"/>
    
    <!--PERSONALIZADOS-->
    <?php   
    if (isset($css)) {
        foreach ($css as $file) {?>
    <link href="<?= base_url("public/css/{$file}.css") ?>" rel="stylesheet" />
        <?php }
    }    
    ?>    
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->    
    <script>var baseurl = "<?php print base_url(); ?>";</script>    
</head>
<body>
<!-- /#wrapper -->
<div id="wrapper">
    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <a class="navbar-brand" href="<?= site_url('admin/principal') ?>">ADMIN</a>
        </div>
        <!-- Top Menu Items -->
        <ul class="nav navbar-right top-nav">
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-envelope"></i> <b class="caret"></b></a>
                <ul class="dropdown-menu message-dropdown">
                    <li class="message-preview">
                        <a href="#">
                            <div class="media">
                                <span class="pull-left">
                                    <img class="media-object" src="http://placehold.it/50x50" alt="">
                                </span>
                                <div class="media-body">
                                    <h5 class="media-heading"><strong>John Smith</strong>
                                    </h5>
                                    <p class="small text-muted"><i class="fa fa-clock-o"></i> Yesterday at 4:32 PM</p>
                                    <p>Lorem ipsum dolor sit amet, consectetur...</p>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li class="message-preview">
                        <a href="#">
                            <div class="media">
                                <span class="pull-left">
                                    <img class="media-object" src="http://placehold.it/50x50" alt="">
                                </span>
                                <div class="media-body">
                                    <h5 class="media-heading"><strong>John Smith</strong>
                                    </h5>
                                    <p class="small text-muted"><i class="fa fa-clock-o"></i> Yesterday at 4:32 PM</p>
                                    <p>Lorem ipsum dolor sit amet, consectetur...</p>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li class="message-preview">
                        <a href="#">
                            <div class="media">
                                <span class="pull-left">
                                    <img class="media-object" src="http://placehold.it/50x50" alt="">
                                </span>
                                <div class="media-body">
                                    <h5 class="media-heading"><strong>John Smith</strong>
                                    </h5>
                                    <p class="small text-muted"><i class="fa fa-clock-o"></i> Yesterday at 4:32 PM</p>
                                    <p>Lorem ipsum dolor sit amet, consectetur...</p>
                                </div>
                            </div>
                        </a>
                    </li>
                    
                    <li class="message-footer">
                        <a href="#">Read All New Messages</a>
                    </li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bell"></i> <b class="caret"></b></a>
                <ul class="dropdown-menu alert-dropdown">
                    <li>
                        <a href="#">Alert Name <span class="label label-default">Alert Badge</span></a>
                    </li>
                    <li>
                        <a href="#">Alert Name <span class="label label-primary">Alert Badge</span></a>
                    </li>
                    <li>
                        <a href="#">Alert Name <span class="label label-success">Alert Badge</span></a>
                    </li>
                    <li>
                        <a href="#">Alert Name <span class="label label-info">Alert Badge</span></a>
                    </li>
                    <li>
                        <a href="#">Alert Name <span class="label label-warning">Alert Badge</span></a>
                    </li>
                    <li>
                        <a href="#">Alert Name <span class="label label-danger">Alert Badge</span></a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="#">View All</a>
                    </li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?= $this->session->userdata('usuario') ?> <b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="<?= site_url('admin/Usuario') ?>"><i class="fa fa-fw fa-user"></i> Perfil</a>
                    </li>
                    <li>
                        <a href="<?= site_url('admin/Usuario/inbox') ?>"><i class="fa fa-fw fa-envelope"></i> Inbox</a>
                    </li>
                    <li>
                        <a href="<?= site_url('admin/Usuario/configuracion') ?>"><i class="fa fa-fw fa-gear"></i> Configuración</a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="<?= site_url('autenticacion/logout') ?>"><i class="fa fa-fw fa-power-off"></i> Salir</a>
                    </li>
                </ul>
            </li>
        </ul>
        <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav side-nav">
                <li class="active">
                    <a href="<?= site_url('admin/principal') ?>"><i class="fa fa-fw fa-dashboard"></i> Inicio</a>
                </li>
                <li>
                    <a href="javascript:;" data-toggle="collapse" data-target="#use"><i class="fa fa-fw fa-arrows-v"></i> Usuarios <i class="fa fa-fw fa-caret-down"></i></a>
                    <ul id="use" class="collapse">                        
                        <li>
                            <a href="<?= site_url('admin/usuarios') ?>">Ver</a>
                        </li>
                        <li>
                            <a href="<?= site_url('admin/usuarios_tipos') ?>">Tipos Usuarios</a>
                        </li>
                    </ul>
                </li>  
                <li>
                    <a href="javascript:;" data-toggle="collapse" data-target="#proy"><i class="fa fa-fw fa-building"></i> Proyectos <i class="fa fa-fw fa-caret-down"></i></a>
                    <ul id="proy" class="collapse">
                        <li>
                            <a href="<?= site_url('admin/proyectos') ?>">Proyectos</a>
                        </li>
                        <li>
                            <a href="<?= site_url('admin/proyectos_aperturas') ?>">Apertura</a>
                        </li>                        
                        <li>
                            <a href="<?= site_url('admin/proyectos_estatus') ?>">Estatus</a>
                        </li>
                        <li>
                            <a href="<?= site_url('admin/proyectos/actuales') ?>">Actuales</a>
                        </li>
                    </ul>
                </li>                
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </nav>
    
    <!--EMPIEZA EL CONTENIDO-->
    <div id="page-wrapper">
        <div class="container-fluid">
    
    
<?php
if (isset($msj) && count($msj)>0) { ?>    
    <div class="row" id='transaccion'>    
        <div class="col-md-4 col-md-offset-4 <?= $msj[0] ?>" role="alert">
            <?= $msj[1] ?>
        </div>
    </div>  
<?php    
}
?>

<?php
if (isset($msj_static) && count($msj_static)>0) { ?>    
    <div class="row">    
        <div class="col-md-4 col-md-offset-4 <?= $msj_static[0] ?>" role="alert">
            <?= $msj_static[1] ?>
        </div>
    </div>  
<?php    
}
?>