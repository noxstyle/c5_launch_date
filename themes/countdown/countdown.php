<?php    
defined('C5_EXECUTE') or die(_("Access Denied."));
$this->inc('elements/header.php'); // get header file
?>

        <div class="container_12">
            <div id="cd_logo" class="main">
                <?php    
                    $a = new Area('CD Logo');
                    $a->display($c); 
                ?>
            </div>
	        <div id="cd_header" class="main">
                <?php    
                    $a = new Area('CD Header');
                    $a->display($c); 
                ?>
            </div>
	        <div id="holder_wrapper" class="main">
		            <div id="cd_main" class="main">
			        <?php
				    $a = new Area('CD Main');
				    $a->display($c);
			        ?>
			    </div>
			    <div id="cd_timer" class="main">
				<?php
				    $a = new Area('CD Timer');
			            $a->display($c);
				?>
			    </div>
			</div>
	        <div id="cd_mainplus" class="main">
                <?php    
                    $a = new Area('CD MainPlus');
                    $a->display($c); 
                ?>
            </div>
	        <div id="cd_social" class="main">
                <?php    
                    $a = new Area('CD Social');
                    $a->display($c); 
                ?>
            </div>
        
        </div>

<?php     $this->inc('elements/footer.php'); // get footer.php ?>