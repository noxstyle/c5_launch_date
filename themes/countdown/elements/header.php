<?php   defined('C5_EXECUTE') or die(_("Access Denied.")); ?>
<!DOCTYPE html>
<html lang="<?php   echo LANGUAGE?>">
<head>
<?php   Loader::element('header_required'); ?>
<link href="<?php   echo $this->getThemePath(); ?>/css/reset.css" rel="stylesheet" type="text/css" />
<link href="<?php   echo $this->getThemePath(); ?>/css/text.css" rel="stylesheet" type="text/css" />
<link href="<?php   echo $this->getThemePath(); ?>/css/960.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" media="screen" type="text/css" href="<?php   echo $this->getStyleSheet('main.css')?>" />
<link rel="stylesheet" media="screen" type="text/css" href="<?php   echo $this->getStyleSheet('typography.css')?>" />
<!--[if IE 8]>
<link href="<?php   echo $this->getThemePath(); ?>/css/ie8.css" rel="stylesheet" type="text/css" />
<![endif]-->
<!--[if lte IE 7]>
<link href="<?php   echo $this->getThemePath(); ?>/css/ie7.css" rel="stylesheet" type="text/css" />
<![endif]-->
<!--[if IE 6]>
<link href="<?php   echo $this->getThemePath(); ?>/css/ie6.css" rel="stylesheet" type="text/css" />
<![endif]-->
<body>
    <div id="c5wrapcd" class="wrapper">