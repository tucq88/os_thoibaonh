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
 * @version 	$Id: HookLoader.php 2075 2010-04-07 08:19:30Z huuphuoc $
 */

class Tomato_Modules_Core_Controllers_Plugin_HookLoader extends Zend_Controller_Plugin_Abstract 
{
	public function preDispatch(Zend_Controller_Request_Abstract $request)
	{
		$conn = Tomato_Core_Db_ConnectionFactory::factory()->getSlaveConnection();
		$targetDao = Tomato_Core_Model_Dao_Factory::getInstance()->setModule('core')->getTargetDao();
		$targetDao->setDbConnection($conn);
		$targets = $targetDao->getTargets();
		if ($targets) {
			foreach ($targets as $target) {
				$hookClass = (null == $target->hook_module || '' == $target->hook_module)
						? 'Tomato_Hooks_'.$target->hook_name.'_Hook'
						: 'Tomato_Modules_'.$target->hook_module.'_Hooks_'.$target->hook_name.'_Hook';
				$hook = new $hookClass();
				if ($hook instanceof Tomato_Core_Hook) {
					Tomato_Core_Hook_Registry::getInstance()->register($target->target_name, array($hook, $target->hook_type));
				}
			}
		}
	}
}
