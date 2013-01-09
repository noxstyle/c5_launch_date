<?php     defined('C5_EXECUTE') or die(_("Access Denied.")); ?>       
	<div class="nav_container">
		<?php     
			$a = new Area('Header Nav');
			$a->display($c); // main auto nav
			/* You can also embed this so that it isn't editable by using this code: http://pastie.org/2282530 */
		?>
	</div> <!-- close nav_container -->