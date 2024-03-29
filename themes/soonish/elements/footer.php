<?php defined('C5_EXECUTE') or die("Access Denied.");
/**
 * Footer element for Soonish C5 template
 * 
 * @author noxstyle <joni.lepisto@noxstyle.info>
 */
$u = new User;
if (Config::get("ENABLE_USER_PROFILES"))
	$userName = '<a href="' . $this->url('/profile') . '">' . $u->getUserName() . '</a>';
else
	$userName = $u->getUserName();
?>
	<div id="bottom"></div>
</div><!-- /wrapper -->

<div id="cd_footer" class="main">

    <span class="powered-by">
    	<a href="http://www.concrete5.org" title="<?php   echo t('concrete5 open source CMS')?>">
    		<?php   echo t('concrete5 Content Management')?>
    	</a>
    </span>

	&copy; <?php echo date('Y')?> <a href="<?php   echo DIR_REL?>/"><?php     echo SITE?></a>.
	<?php echo t('All rights reserved.')?>

	<?php if ($u->isRegistered()): ?>

		<span class="sign-in">
			<?php echo t('Currently logged in as <b>%s</b>.', $userName)?>
			<a href="<?php echo $this->url('/login', 'logout')?>">
				<?php echo t('Sign Out')?>
			</a>
		</span>
	
	<?php else: ?>
		<span class="sign-in">
			<a href="<?php echo $this->url('/login')?>">
				<?php echo t('Sign In to Edit this Site')?>
			</a>
		</span>
	<?php endif; ?>
</div>

<?php Loader::element('footer_required') ?>

</body>
</html>