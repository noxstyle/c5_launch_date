<?php defined('C5_EXECUTE') or die("Access Denied.");
/**
 * Header element for Soonish C5 template
 * 
 * @author noxstyle <joni.lepisto@noxstyle.info>
 */
?>
<!DOCTYPE html>
<html>
<head>
		
	<!--Stylesheets-->
	<link rel="stylesheet" href="<?php echo $this->getThemePath()?>/main.css">

	<!--HTML5 Shiv-->
	<!--[if lt IE 9]>
			<script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

	<?php Loader::element('header_required') ?>
	
</head>
<body>

	<div id="wrapper">