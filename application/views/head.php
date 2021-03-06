<?php

defined('BASEPATH') OR exit('No direct script access allowed');

?>
<!DOCTYPE html>
<html lang="en">
<head>    
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title><?= $title_head ?></title>
    
    <!--CSS-->
    <!--BOOTSTRAP-->
    <link href="<?= base_url("public/css/bootstrap.min.css") ?>" rel="stylesheet" />
    <link href="<?= base_url("public/css/public_comun.css") ?>" rel="stylesheet" />
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
    <script>var baseurl = "<?php print base_url(); ?>"</script>
    
</head>
<body> 