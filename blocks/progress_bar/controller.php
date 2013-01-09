<?php defined('C5_EXECUTE') or die("Access Denied.");
/**
 * BlockController for
 * ProgressBarBlock
 *
 * @author noxstyle <joni.lepisto@noxstyle.info>
 * @package LaunchDate
 */

class ProgressBarBlockController extends BlockController
{
	/**
	 * Progress types
	 */
	const TYPE_AUTO = 1;
	const TYPE_FIXED = 2;

	protected $btDescription = "Progress bar for LaunchDate package";
	protected $btName = 'LaunchDate Progress Bar';
	protected $btTable = 'btProgressBar';
	protected $btInterfaceWidth = "450";
	protected $btInterfaceHeight = "400";

	/**
	 * @var Array $_colorSchemes supported color schemes
	 */
	protected $_colorSchemes = array(
		1 => 'green',
		2 => 'orange',
		3 => 'purple',
		4 => 'teal'
	);

	public function getBlockTypeDescription() {
		return $this->btDescription;
	}

	public function getBlockTypeName() {
		return $this->btName;
	}

	public function edit() {
		$this->_loadConstants();
	}

	public function add() {
		$this->_loadConstants();
	}

	/**
	 * On start method to check holding page auto disable on auto mode
	 */
	public function on_start() {
		if((int)$this->record->progress_type === self::TYPE_AUTO) {
			if($this->record->auto_disable) {

				/**
				 * If the launch date has been has been passed
				 * disable the holding page
				 *
				 * @todo Redirect the user to index if the date has passed?
				 */
				if($this->_getProgress() == 100) {
					Loader::model('launch_date_config', 'launch_date');
					LaunchDateConfig::getInstance()->disable()->save();
					//$this->redirect('/');
				}
			}
		}
	}

	public function on_page_view() {
		$progress = $this->_getProgress().'%%';
		$css = t("<style>
			#bar-%s {width: $progress; -moz-animation:bar 2s ease-out;-webkit-animation:bar 2s ease-out;}
			@-moz-keyframes bar { 0%% { width:0px;} 100%%{ width:$progress;} }
			@-webkit-keyframes bar { 0%%  { width:0px;} 100%%{ width:$progress;} }
		</style>", $this->record->bID);
		$this->addHeaderItem($css);

		$this->set('barClass', $this->_getColorCssClass());
	}

	public function save($args) {
		$type = (int)$args['type'];

		// Block specific data
		$data = array();
		$data['progress_type'] 	= $type;
		$data['bar_color']		= $args['color'];

		switch ($type) {
			case self::TYPE_AUTO:
				$data['start_date'] 	= $args['start-date'];
				$data['end_date']		= $args['end-date'];
				$data['auto_disable'] 	= $args['auto-disable'];
				break;
			case self::TYPE_FIXED:
				$data['progress_amount'] = $args['current-progress'];
				break;			
			default:
				throw new Exception('Wrong type specified for ProgressBarBlockController.');
				break;
		}

		parent::save($data);
	}

	protected function _loadConstants() {
		$this->set('types', $this->_getTypes());
		$this->set('colors', $this->_colorSchemes);
	}

	protected function _getTypes() {
		return array(
			self::TYPE_AUTO => t('Auto'),
			self::TYPE_FIXED => t('Fixed'),
		);
	}

	protected function _getColorCssClass() {
		return 'bar-' . $this->_colorSchemes[$this->record->bar_color];
	}

	protected function _getProgress() {
		switch((int)$this->record->progress_type) {
			case self::TYPE_AUTO:
				$startDate 	= strtotime($this->record->start_date);
				$endDate 	= strtotime($this->record->end_date);

				// Difference between the two defined dates
				$dateDiff	= $endDate - $startDate;

				// Time passed since start
				$timePassed = time() - $startDate;

				// Return the percentage value with 0 decimal percision half rounded up
				$progress = round(($timePassed / $dateDiff) * 100);
				if($progress >= 100)
					return 100;

				return $progress;
				break;
			case self::TYPE_FIXED:
				return (float)$this->record->progress_amount;
				break;
			default:
				return 0;
				break;
		}
	}
}