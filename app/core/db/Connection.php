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
 * @version 	$Id: Connection.php 2051 2010-04-06 09:06:18Z huuphuoc $
 */

/**
 * @deprecated Due to its usage in 2.0.4 and earlier version
 * From 2.0.5 version and later, you should use methods provided by Tomato_Core_Db_ConnectionFactory class
 */
class Tomato_Core_Db_Connection
{
	/**
	 * Support master connection type
	 * 
	 * @return mixed
	 */
	public static function getMasterConnection() 
	{
		return Tomato_Core_Db_ConnectionFactory::factory()->getMasterConnection();
	}
	
	/**
	 * Support slave connection type
	 * 
	 * @return mixed
	 */
	public static function getSlaveConnection() 
	{
		return Tomato_Core_Db_ConnectionFactory::factory()->getSlaveConnection();
	}
	
	/**
	 * Get database table prefix
	 * 
	 * @since 2.0.3
	 * @return string
	 */
	public static function getDbPrefix() 
	{
		return Tomato_Core_Db_ConnectionFactory::factory()->getDbPrefix();
	}
}
