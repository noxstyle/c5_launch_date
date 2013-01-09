<?php defined('C5_EXECUTE') or die(_("Access Denied."));
/**
 *
 * Launch Date holding page for C5
 *
 * @TODO: Theres no on_theme_update (or anything similar for that matter)
 * event for C5 so find a way to reset the holding page theme to
 * the currently selected theme after the global theme is changed
 *
 * @author noxstyle <noxstyle@noxstyle.info>
 * @author Ekko <ekkooffice@gmail.com>
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @package LaunchDate
 * @version 1.0
 */
class LaunchDatePackage extends Package {

	protected $pkgHandle = 'launch_date';
	protected $appVersionRequired = '5.3';
	protected $pkgVersion = '0.9.0.0';
	
	public function getPackageName() {
		return t("Launch Date");
	}

	public function getPackageDescription() {
		return t("Enables the usage of holding/coming soon page where the traffic is
			directed until the given launch date or manually disabled.");
	}

	public function on_start() {
		global $u;
		Loader::model('launch_date_config', $this->pkgHandle);
		$config = LaunchDateConfig::getInstance();
		$holdingPageHandle = $config->getPagePath();

		if(	$config->isEnabled() AND !$u->isLoggedIn()) {

			/*
			 * Get request path and match it against login*, themes* and the holding page
			 */
			$requestPath = Request::get()->getRequestPath();

			if(	strpos($requestPath, 'themes/') === false
				AND strpos($requestPath, 'login/') === false
				AND $requestPath !== 'login'
				AND $requestPath !== substr($holdingPageHandle, 1)) {

					// Redirect the user to holding page
					Controller::redirect($holdingPageHandle);
			}
		}

		// Get or define cache
		if (!defined('LAUNCH_DATE_ENABLE_CACHE')) {
			define('LAUNCH_DATE_ENABLE_CACHE', true);
		}
	}
	
	public function install() {
		$pkg = parent::install();
		
		// Install theme(s) and set the default theme to $theme
		PageTheme::add('countdown', $pkg);
		$theme = PageTheme::add('soonish', $pkg);

		// Install block types
		BlockType::installBlockTypeFromPackage('progress_bar', $pkg);

		// Create the holding page
		Loader::model('page');
		Loader::model('collection_types');

		// Create new page type for holding page
		$ct = CollectionType::add(array('ctHandle' => 'holding_page', 'ctName' => 'Holding Page'), $pkg);
		
		// Get the 'homepage'
		$p = Page::getByID(1);

		// Create a 'Coming Soon' page
		$page = $p->add($ct, array(
			'pkgID' => $pkg->getPackageID(),
			'cName'	=> 'Coming Soon',
			'cHandle' => 'coming_soon'
		));
		$page->setTheme($theme);

		/*
		 * Install single pages
		 */
		Loader::model('single_page');

		$def = SinglePage::add('/dashboard/launch_date', $pkg);
		$def->update(array('cName' => t('Launch Date'), 'cDescription' => t('Launch Date Config')));

		$this->post_install();
	}

	/**
	 * Drop the config table on uninstall
	 * Remove 'Coming soon' page
	 */
	public function uninstall() {
		Loader::model('page');
		Loader::model('launch_date_config', 'launch_date');

		$db = Loader::db();
		$db->Execute('drop table LaunchDateConfig');

		/**
		 * Deletes the holding page
		 * should moveToTrash() or deactivate() be called instead to preserve
		 * the collection object in case one should want to re-enable the holding page?
		 */
		$p = Page::getByPath(LaunchDateConfig::getInstance()->getPath());
		$p->delete();

		parent::uninstall();
	}

	/**
	 * Sets the default configuration values for the package
	 */
	public function post_install() {
		$db = Loader::db();
		$sqls = array(
			"insert into LaunchDateConfig (`key`,`value`) values ('is_enabled', false);",
			"insert into LaunchDateConfig (`key`,`value`) values ('page_path', '/coming_soon');",
		);

		foreach($sqls as $sql) {
			$db->Execute($sql);
		}
	}
}