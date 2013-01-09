<?php defined('C5_EXECUTE') or die(_("Access Denied.")); $ifHelper = Loader::helper('concrete/interface');
/**
 * 
 * Single page for dashboard/launch_date
 *
 * @author noxstyle <joni.lepisto@noxstyle.info>
 * @package LaunchDate
 */
 ?>

<?php echo Loader::helper('concrete/dashboard')->getDashboardPaneHeaderWrapper(t('Launch Date'), t('Launch Date Settings.'), false, false);?>

<div class="ccm-pane-body">
	<div class="row">

		<?php if(isset($status)): ?>
			<div class="alert alert-info">
				<?php echo $status ?>
			</div>
		<?php endif; ?>
		
		<div class="span-pane-half">
			<h3><?php echo t('Holding Page Enabled') ?></h3>
			<div class="well">
				<h5><?php echo t('Current status:') ?></h5>

				<div>
					<a href="<?php echo $this->action('toggleLaunchDate', ($is_enabled) ? 0 : 1) ?>"
						id="switch-status" class="<?php echo $is_enabled ? 's-3-on' : 's-3-off' ?>"></a>
				</div>

			</div>
		</div><!-- /span-pane-half -->

		<div class="span-pane-half">
			<h3><?php echo t('Holding Page Theme') ?></h3>
			<div class="well">
				<h5><?php echo t('Currently used theme for holding page') ?></h5>
				<p><span class="label"><?php echo $selected_theme ?></span></p>

				<div>
					<form action="<?php echo $this->action('setTheme') ?>" method="post">
						<label for="theme"><?php echo t('Change theme') ?></label>
						<select name="theme">
							<?php foreach($available_themes as $theme): ?>
								<option value="<?php echo $theme->getThemeID()?>"><?php echo $theme->getThemeName() ?></option>
							<?php endforeach; ?>
						</select>
						<input type="submit" class="btn btn-primary" value="<?php echo t('Set') ?>">
					</form>
				</div>
			</div><!-- /well -->
		</div><!-- /span-pane-half -->

	</div><!-- /row -->

	<div class="row">
		<div class="span-pane-half">
			<h3>Holding Page</h3>
			<div class="well">
				<h5><?php echo t('Currently used holding page') ?></h5>
				<p><span class="label"><?php echo $holding_page ?></span></p>

				<div>
					<form action="<?php echo $this->action('setHoldingPage') ?>" method="post" name="holding-page-form">
						<label for="page-path"><?php echo t('Change holding page') ?></label>
						<select name="page-path">
							<?php foreach($page_list as $page): ?>
								<option value="<?php echo $page->getCollectionPath() ?>" <?php echo ($page->getCollectionName() == $holding_page) ? 'selected' : '' ?>>
									<?php echo $page->getCollectionName() ?>
								</option>
							<?php endforeach; ?>
						</select>
						<input type="submit" class="btn btn-primary" value="<?php echo t('Set') ?>">
					</form>
				</div>

			</div><!-- /well -->
		</div><!-- /span-pane-half -->
	</div><!-- /row -->

</div><!-- ccm-pane-body -->

<div class="ccm-pane-footer"></div>

<script type="text/javascript">
$(document).ready(function(){
	/*$("input[name='launch_date']").datetimepicker({
		'dateFormat': 'yy-mm-dd'
	});*/
});
</script>