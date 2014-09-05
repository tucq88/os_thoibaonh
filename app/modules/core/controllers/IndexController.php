<?php
/**
 * TomatoCMS
 * 
 * LICENSE
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE Version 2 
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-2.0.txt
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@tomatocms.com so we can send you a copy immediately.
 * 
 * @copyright	Copyright (c) 2009-2010 TIG Corporation (http://www.tig.vn)
 * @license		http://www.gnu.org/licenses/gpl-2.0.txt GNU GENERAL PUBLIC LICENSE Version 2
 * @version 	$Id: IndexController.php 2327 2010-04-17 13:49:05Z huuphuoc $
 */

class Core_IndexController extends Zend_Controller_Action 
{
	/**
	 * URL to get the latest version number of TomatoCMS
	 */
	const CHECK_VERSION_API = 'http://api.tomatocms.com/get_version.php';
	
	/* ========== Backend actions =========================================== */
	
	/**
	 * Show dashboard of administration
	 * 
	 * @return void
	 */
	public function dashboardAction() 
	{
		/**
		 * Get the latest version info
		 * Inform if there is newer version
		 * @since 2.0.1 
		 */
		$hasNewerVersion 	= false;
		$latestVersion 		= null;
		try {
			$latestVersion = Tomato_Core_Utility_HttpRequest::getResponse(self::CHECK_VERSION_API);
			if (version_compare(Tomato_Core_Version::getVersion(), $latestVersion, '<')) {
				$hasNewerVersion = true;
			}
		} catch (Exception $ex) {
		}
		$databaseVersion = Tomato_Core_Db_ConnectionFactory::factory()->getVersion();
		
		// List modules with admin tasks
		$modules = array();
		$subDirs = Tomato_Core_Utility_File::getSubDir(TOMATO_APP_DIR.DS.'modules');
		foreach ($subDirs as $dir) {
			if ($dir == 'core') {
				continue;
			}
			$file = TOMATO_APP_DIR.DS.'modules'.DS.$dir.DS.'config'.DS.'about.xml';
			if (!file_exists($file)) {
				continue;
			}
			$xml 		= simplexml_load_file($file);
			$attrs 		= $xml->description->attributes();
			$langKey 	= (string)$attrs['langKey'];
			$desc 		= $this->view->translator($langKey, $dir);
			$item 		= array(
				'name' 			=> strtolower($xml->name),
				'description' 	=> ($desc == $langKey) ? (string) $xml->description : $desc, 
				'tasks' 		=> array(),
			);
			if ($xml->admin) {
				foreach ($xml->admin->task as $task) {
					$attrs 		= $task->attributes();
					$langKey 	= (string)$attrs['langKey'];
					$desc 	 	= $this->view->translator($langKey, $dir);
					$label 		= ($desc == $langKey) ? (string) $attrs['description'] : $desc;
					$item['tasks'][] = array(
						'label' => $label, 
						'link' 	=> (string)$attrs['link'],
					);
				}
			}
			$modules[] = $item;
		}
		
		// Get general information
		$this->view->assign('tomatoVersion', Tomato_Core_Version::getVersion());
		$this->view->assign('phpVersion', phpversion());
		$this->view->assign('mysqlVersion', $databaseVersion);
		$this->view->assign('hasNewerVersion', $hasNewerVersion);
		$this->view->assign('latestVersion', $latestVersion);
		
		$this->view->assign('modules', $modules);
	}
}
