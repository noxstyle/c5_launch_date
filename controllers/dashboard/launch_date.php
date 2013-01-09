<?php defined('C5_EXECUTE') or die("Access Denied.");
/**
 * 
 * DashboardLaunchDateController for LaunchDate Package
 *
 * @author noxstyle <joni.lepisto@noxstyle.info>
 * @package LaunchDate
 */

Loader::model('launch_date_config', 'launch_date');

class DashboardLaunchDateController extends Controller
{
	protected $config;

	public function on_start() {
		$this->config = LaunchDateConfig::getInstance();
	}

	public function view() {
		$this->addHeaderItem($this->getToggleSwitchCss());

		$page = $this->_getHoldingPage();
		$theme = PageTheme::getByID($page->getCollectionThemeID());

		// Set current theme and available themes
		$this->set('selected_theme', $theme->getThemeName());
		$this->set('available_themes', PageTheme::getList());

		// Set Data
		$this->set('is_enabled', $this->config->isEnabled());
		$this->set('holding_page', $page->getCollectionName());

		// Filter 'homepage' from the list as '/' is not recognized page path
		$pl = new PageList;
		$pl->filter('p1.cID', 1, '<>');
		$this->set('page_list', $pl->get());
	}

	/**
	 * Toggles LaunchDate package
	 * true -> holding page enabled
	 * false -> holding page disabled
	 * @param Boolean $val
	 */
	public function toggleLaunchDate($val) {
		if($val)
			LaunchDateConfig::getInstance()->enable()->save();
		else
			LaunchDateConfig::getInstance()->disable()->save();

		$this->view();
	}

	/**
	 * Sets theme for holding page
	 * note: all themes must have holding_page.php
	 */
	public function setTheme() {
		$themeID = (int)$this->post('theme');
		$page = Page::getByPath(LaunchDateConfig::getInstance()->getPagePath());
		$theme = PageTheme::getByID($themeID);

		if(is_null($theme))
			throw new Exception('Unable to retrieve theme for given themeID.');

		$page->setTheme($theme);
		$this->view();
	}

	/**
	 * Sets the pagepath for the holding page
	 */
	public function setHoldingPage() {
		$pagePath = $this->post('page-path');
		LaunchDateConfig::getInstance()->setPagePath($pagePath)->save();

		$this->set('status', t('Successfully changed the holding page.'));
		$this->view();
	}

	private function _getHoldingPage() {
		if(!is_null(LaunchDateConfig::getInstance()->getPagePath()))
			return Page::getByPath(LaunchDateConfig::getInstance()->getPagePath());

		return Page::getByPath(LaunchDateConfig::DEFAULT_PAGE_PATH);
	}

	/**
	 * Helper function to display on/off switch on dashboard
	 * @todo move this the fk out of here
	 * @return String
	 */
	protected function getToggleSwitchCss() {
		$spriteUrl = BASE_URL.DIR_REL.'/packages/launch_date/assets/img/sprites3.png';
		return "<style>
			.s-3-off, .s-3-on{
			background: url($spriteUrl) no-repeat;
			display:block;
			}

			.s-3-off{
			background-position: 0 0;
			width: 150px;
			height: 100px;
			}

			.s-3-on{
			background-position: -151px 0;
			width: 150px;
			height: 100px;
			}</style>
		";
	}
}