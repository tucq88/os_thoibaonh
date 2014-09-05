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
 * @version 	$Id: ConnectionFactory.php 2365 2010-04-17 19:40:47Z huuphuoc $
 * @since		2.0.5
 */

class Tomato_Core_Db_ConnectionFactory
{
	/**
	 * @return Tomato_Core_Db_ConnectionAbstract
	 */
	public static function factory()
	{
		$config 	= Tomato_Core_Config::getConfig();
		$adapter 	= $config->db->adapter;
		$class 		= 'Tomato_Core_Db_Adapter_'.$adapter.'_Connection';
		if (!class_exists($class)) {
			throw new Exception('Does not support '.$adapter.' connection');
		}
		$instance = new $class($adapter);
		return $instance;
	}
}
