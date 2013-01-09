<?php    
defined('C5_EXECUTE') or die(_("Access Denied."));
$this->inc('elements/header.php'); // get header file
?>
</head>
<body id="backpage">

<div class="container_12">

	<?php  
	/* This adds 80px when you are logged in to compensate for C5.5's edit bar covering up your site
	* It can be safely removed without consequence.
	* To only have this when a page is being edited, replace line 17 with: if ($c->isEditMode()) { ?>
	*/
      $u = new User();
     
      if ($u->isLoggedIn()) { ?>
        <div style="min-height:80px;"></div>
    <?php  } ?>



	<h1><a href="<?php   echo DIR_REL?>/">

			<?php    
				$block = Block::getByName('My_Site_Name');
				if( $block && $block->bID ) $block->display();
				else echo SITE; // display site title
			?></a>

	</h1>

    <div class="main_nav">
		<?php     $this->inc('elements/nav.php'); // get nav.php ?>
    </div> <!-- close main_nav -->

    <div class="main">
        <?php    
            $a = new Area('Main');
            $a->display($c); // main editable region
        ?>
    </div> <!-- close main -->

    <div class="sidebar">
        <?php    
            $a = new Area('Sidebar');
            $a->display($c); // sidebar editable region
        ?>
    </div> <!-- close sidebar -->

<?php     $this->inc('elements/footer.php'); // get footer.php ?>