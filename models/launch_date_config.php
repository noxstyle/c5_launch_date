<?php defined('C5_EXECUTE') or die("Access Denied.");
/**
 * 
 * Config for LaunchDate Package
 *
 * Configuration keys:
 * is_enabled - Whether the holding page is enabled or not
 * page_path  - the path for the page to be used as the holding page
 *
 * @author noxstyle <joni.lepisto@noxstyle.info>
 * @package LaunchDate
 */

class LaunchDateConfig
{
	/**
	 * Constant for default holding page path
	 */
	const DEFAULT_PAGE_PATH = '/coming_soon';

	/**
	 * @var Boolean $isEnabled holding page in use 
	 */
	protected $isEnabled;

	/**
	 * @var String $pagePath path for holding page
	 */
	protected $pagePath;

	private static $_instance;
	private static $_cacheKey = 'launchDateDbRes';
	private $_config;

	private function __construct() { $this->load(); }
	private function __clone() {}

	public static function getInstance() {
		if(!self::$_instance) {
			self::$_instance = new LaunchDateConfig;
		}

		return self::$_instance;
	}

	/**
	 * Enables holding page
	 */
	public function enable() {
		$this->isEnabled = true;
		return $this;
	}

	/**
	 * Disables holding page
	 */
	public function disable() {
		$this->isEnabled = false;
		return $this;
	}

	public function isEnabled() {
		return $this->isEnabled ? true : false;
	}

	/**
	 * Gets path for the holding page
	 * @return String
	 */
	public function getPagePath() {
		return $this->pagePath;
	}

	/**
	 * Gets Page instance for the holding page
	 * @return Page
	 */
	public function getHoldingPage() {
		if(!is_null($this->getPagePath()))
			return Page::getByPath($this->getPagePath());

		return Page::getByPath(self::DEFAULT_PAGE_PATH);
	}

	/**
	 * Sets path for the holding page config
	 * @param String $path
	 */
	public function setPagePath($path) {
		$this->pagePath = $path;
		return $this;
	}

	/**
	 * Saves the config values
	 */
	public function save() {
		$db = Loader::db();
		$rec = array(
			array(
				'key' 	=> 'is_enabled',
				'value' => $this->isEnabled
			),
			array(
				'key'	=> 'page_path',
				'value'	=> $this->getPagePath(),
			),
		);

		$db->Execute('truncate table LaunchDateConfig');

		foreach($rec as $record) {
			$db->Execute("insert into LaunchDateConfig (`key`,`value`) values ('{$record['key']}', '{$record['value']}')");
		}

		$this->_clearCache();
		return $this;
	}

	/**
	 * Loads config values
	 */
	public function load() {

		if(LAUNCH_DATE_ENABLE_CACHE && Cache::get('launchDateDbRes', false) !== false) {
			$res = Cache::get(self::$_cacheKey, false);			
		} else {
			$res = Loader::db()->Execute('select * from LaunchDateConfig')->GetArray();

			if(LAUNCH_DATE_ENABLE_CACHE) {
				Cache::set(self::$_cacheKey, false, $res);
			}
		}

		foreach($res as $k) {
			switch($k['key']) {
				case 'is_enabled':
					$this->isEnabled = (bool)$k['value'];
					break;
				case 'page_path':
					$this->pagePath = $k['value'];
					break;
				default:
					break;
			}
		}

		return $this;
	}

	protected function _clearCache() {
		Cache::delete(self::$_cacheKey, false);
	}
}