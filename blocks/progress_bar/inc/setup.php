<?php defined('C5_EXECUTE') or die("Access Denied.");
/**
 * Block Setup for
 * ProgressBarBlock
 *
 * @author noxstyle <joni.lepisto@noxstyle.info>
 * @package LaunchDate
 */

$al = Loader::helper('concrete/asset_library');
$ah = Loader::helper('concrete/interface');

if(!isset($progress_type))
	$progress_type = ProgressBarBlockController::TYPE_AUTO;
?>

<div class="ccm-ui" id="progress-setup">

	<h3 style="margin-bottom:15px"><?php echo t('Options for the progress bar')?></h3>
	
	<!-- General Settings
	================================= -->	
	<label for="type"><?php echo t('Progress Bar Type')?></label>
	<select name="type">
		<?php foreach($types as $typeKey => $typeName): ?>
			<option value="<?php echo $typeKey ?>" <?php echo (isset($progress_type) && $progress_type == $typeKey) ? 'selected' : '' ?>>
				<?php echo $typeName ?>
			</option>
		<?php endforeach; ?>
	</select>

	<br><br>

	<label for="color"><?php echo t('Color Scheme')?></label>
	<select name="color">
		<?php foreach($colors as $key => $color): ?>
			<option value="<?php echo $key ?>" <?php echo (isset($bar_color) && $bar_color == $color) ? 'checked' : '' ?>>
				<?php echo ucfirst($color) ?>
			</option>
		<?php endforeach; ?>
	</select>	

	<br><br>

	<!-- Automode settings
	================================= -->
	<div id="settings-auto" <?php echo ($progress_type != ProgressBarBlockController::TYPE_AUTO) ? 'style="display:none"' : '' ?>>

		<input type="checkbox" name="auto-disable" value="1" style="float:left">
		<label for="auto-disable">&nbsp;<?php echo t('Auto Disable')?></label>

		<label for="start-date"><?php echo t('Start Date')?></label>
		<input type="text" name="start-date" class="date" value="<?php echo (isset($start_date)) ? $start_date : '' ?>">

		<br><br>

		<label for="end-date"><?php echo t('End Date')?></label>
		<input type="text" name="end-date" class="date" value="<?php echo (isset($end_date)) ? $end_date : '' ?>">

	</div><!-- /settings-auto -->


	<!-- Fixed mode settings
	================================= -->
	<div id="settings-fixed" <?php echo ($progress_type != ProgressBarBlockController::TYPE_FIXED) ? 'style="display:none"' : '' ?>>
		
		<label for="current-progress"><?php echo t('Current Progress')?></label>
		<input type="text" name="current-progress" value="<?php echo (isset($progress_amount)) ? $progress_amount : '' ?>">

	</div><!-- /settings-fixed -->

</div>
